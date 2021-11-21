<?php 
function facility_in_city($a){

  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $query = "SELECT a.facilityID,a.facilityName,a.address,a.type,a.phone,a.capacity,a.`total number of employee`,a.`total number of doses`,b.`total dose in future`
            FROM 
                (SELECT f.facilityID,f.facilityName,f.address,f.type,f.phone,capacity, f.totalNumEmployee AS 'total number of employee',count(vaccination.facilityID) AS 'total number of doses'
                FROM facility f
                LEFT JOIN vaccination on f.facilityID=vaccination.facilityID
                where f.address LIKE '%$a'
                GROUP BY f.facilityID) a
            LEFT JOIN
                (SELECT f.facilityID,f.facilityName,f.address,f.type,f.phone,capacity,f.totalNumEmployee AS 'total number of employee',COUNT(appointment.facilityID) AS 'total dose in future'
                FROM facility f
                LEFT JOIN appointment on appointment.facilityID=f.facilityID
                where f.address LIKE '%$a'
                GROUP BY f.facilityID) b 
            on a.facilityID=b.facilityID
            ORDER BY a.`total number of doses` ASC;";
  if($result = $mysqli-> query($query)){
    while ($row = $result->fetch_assoc()){
      $facilityName = $row["facilityName"];
      $address = $row["address"];
      $phone = $row["phone"];
      $capacity = $row["capacity"];
      $total_number_of_employee = $row["total number of employee"];
      $total_number_of_doses = $row["total number of doses"];
      $total_number_of_doses_future =$row["total dose in future"];

      $facility_in_city = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$facilityName}</td>
          <td row="cell">{$address}</td>
          <td row="cell">{$phone}</td>
          <td row="cell">{$capacity}</td>
          <td row="cell">{$total_number_of_employee}</td>
          <td row="cell">{$total_number_of_doses}</td>
          <td row="cell">{$total_number_of_doses_future}</td>
      </tr> 
      DELIMETER;
      echo $facility_in_city;
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
                    <li class="breadcrumb-item active" aria-current="page">City vaccination report </li>
                </ol>
            </nav>
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="facility">City</label>
                    <input type="text" name="facility" placeholder="facility"  required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_facility" class="btn btn-dark pull-right" value="Search City" >
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
                    <th scope="col" role="columnheader">Total Number of public worker</th>
                    <th scope="col" role="columnheader">Total Number of doses</th>
                    <th scope="col" role="columnheader">Total Number of doses in future</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                <?php 
                $a = "";
                  if (isset($_POST['search_facility'])) {
                      $a = $_POST['facility'];
                    facility_in_city($a); 
                  }
                ?>
                </tbody>
            </table>
</div>