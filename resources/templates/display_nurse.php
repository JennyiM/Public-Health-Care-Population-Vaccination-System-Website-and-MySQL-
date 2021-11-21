<?php 
function display_nurse($d,$f){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $date = $d;
  $facilityID = $f;

$query = "SELECT assigned.employee_ID, person.firstName, person.lastName, person.email, assigned.hourly_rate
FROM assigned, person, public_worker
WHERE assigned.SSN = public_worker.SSN
			AND public_worker.personID = person.personID
			AND public_worker.title = 'Nurse'
			AND assigned.facilityID = $f
			AND '$d' NOT BETWEEN assigned.startDate AND assigned.endDate
ORDER BY assigned.hourly_rate ASC;";

  if($result = $mysqli-> query($query)){
    while ($row = $result->fetch_assoc()){
      $employee_ID = $row["employee_ID"];
      $firstName = $row["firstName"];
      $lastName = $row["lastName"];
      $email = $row["email"];
      $hourly_rate = $row["hourly_rate"];

      $display_nurse = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$employee_ID}</td>
          <td row="cell">{$firstName}</td>
          <td row="cell">{$lastName}</td>
          <td row="cell">{$email}</td>
          <td row="cell">{$hourly_rate}</td>
      </tr> 
      DELIMETER;
      echo $display_nurse;
    }
    $result->free();
  }
}
?>
<div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?facility_information">Facility Information</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Display Nurse</li>
                </ol>
            </nav>
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="date">Date</label>
                    <input type="text" name="date" placeholder="(YYYY-MM-DD)"  required>
                </div>

                <div class="col-lg-4 mb-3">
                    <label for="date">Facility ID</label>
                    <input type="text" name="facilityID" placeholder="facility ID"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search" class="btn btn-dark pull-right" value="Search" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>
        </form>
<table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">Employee ID</th>
                    <th scope="col" role="columnheader">First Name</th>
                    <th scope="col" role="columnheader">Last Name</th>
                    <th scope="col" role="columnheader">Email</th>
                    <th scope="col" role="columnheader">Hourly Rate</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                <?php 
                $date = "";
                $facilityID = 0;
                  if (isset($_POST['search'])) {
                      $date = $_POST['date'];
                      $facilityID = (int)$_POST['facilityID'];
                      display_nurse($date,$facilityID); 
                  }
                ?>
                </tbody>
            </table>
</div>