<?php 
function display_nurse_performed(){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);


$query = "SELECT person.firstName, person.lastName, person.phone, COUNT(vaccination.employee_ID) AS 'Number_of_Dose'
FROM person, public_worker, vaccination,assigned
WHERE public_worker.title = 'Nurse'
		AND public_worker.personID = person.personID
		AND vaccination.employee_ID = assigned.employee_ID
		AND vaccination.facilityID = assigned.facilityID
		AND assigned.SSN = public_worker.SSN
GROUP BY person.personID
HAVING Number_of_Dose>=20
ORDER BY Number_of_Dose DESC;";

    if($result = $mysqli-> query($query)){
    while ($row = $result->fetch_assoc()){
      $firstName = $row["firstName"];
      $lastName = $row["lastName"];
      $phone = $row["phone"];
      $Number_of_Dose = $row["Number_of_Dose"];

      $display_nurse_performed = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$firstName}</td>
          <td row="cell">{$lastName}</td>
          <td row="cell">{$phone}</td>
          <td row="cell">{$Number_of_Dose}</td>
      </tr> 
      DELIMETER;
      echo $display_nurse_performed;
    }
    $result->free();
  }
}

function display_nurse_byID($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $personID = (int)$a;

$query = "SELECT person.firstName, person.lastName, person.phone, COUNT(vaccination.employee_ID) AS 'Number_of_Dose'
          FROM person, public_worker, vaccination,assigned
          WHERE public_worker.title = 'Nurse'
              AND person.personID = $personID
              AND public_worker.personID = person.personID
              AND vaccination.employee_ID = assigned.employee_ID
              AND vaccination.facilityID = assigned.facilityID
              AND assigned.SSN = public_worker.SSN;";

    if($result = $mysqli-> query($query)){
    while ($row = $result->fetch_assoc()){
      $firstName = $row["firstName"];
      $lastName = $row["lastName"];
      $phone = $row["phone"];
      $Number_of_Dose = $row["Number_of_Dose"];

      $display_nurse_performed = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$firstName}</td>
          <td row="cell">{$lastName}</td>
          <td row="cell">{$phone}</td>
          <td row="cell">{$Number_of_Dose}</td>
      </tr> 
      DELIMETER;
      echo $display_nurse_performed;
    }
    $result->free();
  }

}
?>
<div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?reports">View report</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Display Nurse Performed</li>
                </ol>
            </nav>
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <!--    confirm button-->
                <div class="col-lg-4 mb-3">
                    <label for="personIN">PersonID</label>
                    <input type="text" name="personID" placeholder="Person ID">
                </div>
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="DisplayOne" class="btn btn-dark pull-right" value="Display a nurse" >
                </div>
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="Generate" class="btn btn-dark pull-right" value="Display All" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>
        </form>
<table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">First Name</th>
                    <th scope="col" role="columnheader">Last Name</th>
                    <th scope="col" role="columnheader">Phone</th>
                    <th scope="col" role="columnheader">Number of Dose</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                <?php 
               
                  if (isset($_POST['Generate'])) {
                      display_nurse_performed(); 
                  }
                  
                  if(isset($_POST['DisplayOne'])){
                    display_nurse_byID($_POST['personID']);
                  }
                  
                ?>
                </tbody>
            </table>
</div>