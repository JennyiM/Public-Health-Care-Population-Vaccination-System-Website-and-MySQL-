<?php

function search_appointment($a,$b){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

  $firstName = $a;
  $lastName = $b;

  $query = "SELECT person.personID, person.firstName, person.lastName, facility.facilityName, facility.facilityID, appointment.doseNumber
            FROM person, facility, appointment
            Where person.firstName = '$firstName'
                AND person.lastName = '$lastName'
                AND person.deleted_ = 0
                AND appointment.personID = person.personID
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
        $facilityName = $row["facilityName"];
        $doseNumber = $row["doseNumber"];

      $personlist = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$personID}</td>
          <td row="cell">{$firstName}</td>
          <td row="cell">{$lastName}</td>
          <td row="cell">{$middleInitial}</td>
          <td row="cell">{$facilityName}</td>
          
          <td>
              <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?performingform&id=$personID&facilityID=$facilityID&doseNumber=$doseNumber'">Confirm</button>
          </td> 
      </tr> 
      
      
      DELIMETER;
    
      echo $personlist;
    

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
                <div class="col-lg-8 mb-2">
                    <label for="firstName">First name</label>
                    <input type="text" name="firstName" placeholder="First name"  require>
                    <label for="lastName">Last name</label>
                    <input type="text" name="lastName" placeholder="Last name" require >
                    <br></br>
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
                if (isset($_POST['search_appointment'])) {
                    
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    search_appointment($firstName,$lastName); 
                    
                }
                
                ?>
              
                </tbody>
            </table>
</div>
</div>
