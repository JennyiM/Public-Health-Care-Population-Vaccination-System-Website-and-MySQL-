<?php

function search_appointment($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $personID = (int) $a;
  $query = "SELECT person.personID, person.firstName, person.lastName, facility.address, facility.facilityID, appointment.doseNumber
            FROM person, facility, appointment
            Where person.personID = $personID
                AND person.deleted_ = 0
                AND appointment.personID = $personID
                AND appointment.deleted_ = 0 
                AND appointment.facilityID = facility.facilityID
                AND facility.deleted_ = 0;";
 
  if($result = $mysqli-> query($query)){
    while ($row = $result->fetch_assoc()){
        $personID = $row["personID"];
        $firstName = $row["firstName"];
        $lastName = $row["lastName"];
        $middleInitial = '';
        $facilityID = $row["facilityID"];
        $address = $row["address"];
        $doseNumber = $row["doseNumber"];

      $personlist = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$personID}</td>
          <td row="cell">{$firstName}</td>
          <td row="cell">{$lastName}</td>
          <td row="cell">{$middleInitial}</td>
          <td row="cell">{$address}</td>
          
          <td>
              <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?performingform&id=$personID&facilityID=$facilityID&doseNumber=$doseNumber'">Confirm</button>
          </td> 
      </tr> 
      
      
      DELIMETER;
    
      echo $personlist;

    //是不是要让已经接种过的appointment消失
    //UPDATE appointment SET deleted_ = 1 WHERE appointment.personID  appointment.facilityID
    

    }
    $result->free();
    
  }
}

?>



<div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--users information-->
            <!--    breadcrumb link-->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?perform_vaccine">Perform a vaccine</a></li>
                    <li class="breadcrumb-item active" aria-current="page">With appointment</li>
                </ol>
            </nav>
           
            <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-5 mb-2">
                    <label for="personID">Person ID</label>
                    <input type="text" name="personID" placeholder="Person ID"  required>
                    <label for="firstName">First name</label>
                    <input type="text" name="firstName" placeholder="First name"  >
                    <label for="lastName">Last name</label>
                    <input type="text" name="lastName" placeholder="Last name"  >
                    <label for="middleInitil">Middle initial</label>
                    <input type="text" name="middleInitil" placeholder="Middle initial" >
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_appointment" class="btn btn-dark pull-right" value="Search an appointment" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>            
           
        </form>
            <table class="table table-hover" role="table">
                <thead role="rowgroup">
                <tr role="row">
                    <th scope="col" role="columnheader">Person ID</th>
                    <th scope="col" role="columnheader">First name</th>
                    <th scope="col" role="columnheader">Last name</th>
                    <th scope="col" role="columnheader">Middle initial</th>
                    <th scope="col" role="columnheader">Location</th>
                </tr>
                </thead>
                <tbody role="rowgroup">
                  
                <?php 
                $personID = 0;
                  if (isset($_POST['search_appointment'])) {
                      $personID = (int) $_POST['personID'];

                  }
                
                search_appointment($personID); 
                
                
                ?>
              
                </tbody>
            </table>
</div>
</div>
