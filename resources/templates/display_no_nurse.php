<?php 
function display_no_nurse($d){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $date = $d;
  $query = "SELECT facilityName, facility.address,facility.phone,capacity,openHours,closeHours
            from facility,public_worker,assigned
            where public_worker.ssn=assigned.ssn 
            and public_worker.title='Nurse'
            and assigned.facilityID=facility.facilityID
            AND '$date'not BETWEEN assigned.startDate 
            and assigned.endDate
            GROUP BY facilityName;";
  if($result = $mysqli-> query($query)){
    while ($row = $result->fetch_assoc()){
      $facilityName = $row["facilityName"];
      $address = $row["address"];
      $phone = $row["phone"];
      $capacity = $row["capacity"];
      $openHours = $row["openHours"];
      $closeHours = $row["closeHours"];

      $display_no_nurse = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$facilityName}</td>
          <td row="cell">{$address}</td>
          <td row="cell">{$phone}</td>
          <td row="cell">{$capacity}</td>
          <td row="cell">{$openHours}</td>
          <td row="cell">{$closeHours}</td>
      </tr> 
      DELIMETER;
      echo $display_no_nurse;
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
                    <li class="breadcrumb-item active" aria-current="page">Display No Nurse</li>
                </ol>
            </nav>
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="date">Date</label>
                    <input type="text" name="date" placeholder="date"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_Date" class="btn btn-dark pull-right" value="Search Date" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>
        </form>
<table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">Facility Name</th>
                    <th scope="col" role="columnheader">Address</th>
                    <th scope="col" role="columnheader">Phone Number</th>
                    <th scope="col" role="columnheader">Capacity</th>
                    <th scope="col" role="columnheader">Open Hour</th>
                    <th scope="col" role="columnheader">Close Hour</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                <?php 
                $date = "";
                  if (isset($_POST['search_Date'])) {
                      $date = $_POST['date'];
                      display_no_nurse($date); 
                  }
                ?>
                </tbody>
            </table>
</div>