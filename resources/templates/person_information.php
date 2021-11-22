
<div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
<?php

function search_information($a){
    connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $personID = (int) $a;
    $query = "SELECT * FROM person Where person.personID = $personID AND person.deleted_ = 0;";
    if($result = $mysqli-> query($query)){
      while ($row = $result->fetch_assoc()){
        $personID = $row["personID"];
        $firstName = $row["firstName"];
        $lastName = $row["lastName"];
        $birthDate = $row["birthDate"];

        $personlist =  
       " <tr>
            <td >Name</td>
            <td >{$lastName}, {$firstName}</td>
        </tr>
        <tr>
            <td >DOB</td>
            <td >{$birthDate}</td>
        </tr>   " ;
       
        
        echo "$personlist";
      }
      $result->free();
    }
}


function verify_appointment($a){
    connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $personID = (int) $a;
    $query = "SELECT appointment.date, appointment.timeslot, facility.facilityName, facility.address 
              FROM appointment, facility 
              WHERE appointment.personID = $personID 
                    AND  appointment.facilityID = facility.facilityID
                    AND appointment.deleted_ = 0;";
    
    if($result = $mysqli-> query($query)){
        // $rowcount = mysqli_num_rows($result);
        // if($rowcount != 0){
        //     echo"
        // <tr>
        //     <td>Appointment:</td>
        //     <td></td>
        // </tr>";
        // }
      while ($row = $result->fetch_assoc()){
        $date = $row['date'];
        $timeslot = $row["timeslot"];
        $facilityName = $row["facilityName"];
        $address = $row["address"];   
        
        $appointlist =     
        "<tr>
            <td><span style='font-weight:bold'>Appointment:</span></td>
            <td></td>
        </tr>
        
        <tr>
            <td>Date</td>
            <td>{$date} @ {$timeslot}</td>
        </tr>
        <tr >
            <td>Location</td>
            <td>{$facilityName}</td>
        </tr>
        <tr >
            <td>Address</td>
            <td>{$address}</td>
        </tr>";
        
        
        echo $appointlist;
      }
    $result->free();
    }
  
  
}
function vaccination_result_oversea($a){
    connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $personID = (int) $a;
    $query = "SELECT ov.lotNumber, ov.date, ov.country
              FROM oversea_vaccination ov 
              WHERE ov.personID = $personID;";
    
    if($result = $mysqli-> query($query)){
        $counter = 1;
      while ($row = $result->fetch_assoc()){
       
        $country = $row['country'];
        $lotNumber = $row["lotNumber"];
        $date = $row["date"];
          
        
        $ovvaccinationlist =     
        " 
        <tr>
            <td><span style='font-weight:bold'>Oversear Vaccine Administered Dose #{$counter}:</span></td>
            <td></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>PB COVID-19</td>
        </tr>
        <tr>
            <td>Lot</td>
            <td>{$lotNumber}</td>
        </tr>
        <tr>
            <td>Date</td>
            <td>{$date}</td>
        </tr>
        <tr>
            <td>Location</td>
            <td>{$country}</td>
        </tr>";
        
        
        echo $ovvaccinationlist;
        $counter++;
      }
    $result->free();
    }
  
  
}
function vaccination_result($a){
    connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $personID = (int) $a;
    $query = "SELECT vs.type, v.lotNumber, v.date, f.facilityName
              FROM vaccination v, vaccin_status vs, facility f 
              WHERE v.personID = $personID 
                    AND  v.facilityID = f.facilityID
                    AND v.lotNumber = vs.lotNumber
                    AND v.deleted_ = 0;";
    
    if($result = $mysqli-> query($query)){
        $counter = 1;
      while ($row = $result->fetch_assoc()){
       
        $type = $row['type'];
        $lotNumber = $row["lotNumber"];
        $date = $row["date"];
        $facilityName = $row["facilityName"];   
        
        $vaccinationlist =     
        " 
        <tr>
            <td><span style='font-weight:bold'>Vaccine Administered Dose #{$counter}:</span></td>
            <td></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>PB COVID-19</td>
        </tr>
        <tr>
            <td>Code</td>
            <td>{$type}</td>
        </tr>
        <tr>
            <td>Lot</td>
            <td>{$lotNumber}</td>
        </tr>
        <tr>
            <td>Date</td>
            <td>{$date}</td>
        </tr>
        <tr>
            <td>Location</td>
            <td>{$facilityName}</td>
        </tr>";
        
        
        echo $vaccinationlist;
        $counter++;
      }
    $result->free();
    }
  
  
}

function infection_result($a){
    connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $personID = (int) $a;
    $query = "SELECT ih.startDate, it.virus_type
              FROM infection_history ih, infection_type it
              WHERE ih.personID = $personID 
                    AND ih.infectionType = it.typeID
                    AND it.deleted_ = 0
                    ORDER BY startDate ASC;";
    
    if($result = $mysqli-> query($query)){
        $counter = 1;
      while ($row = $result->fetch_assoc()){
        $date = $row["startDate"];
        $virus = $row["virus_type"];   
        
        $infectionlist =     
        "
        <tr>
            <td><span style='font-weight:bold'>Positive COVID-19 Diagnostic #{$counter}:</span></td>
            <td></td>
        </tr>
        <tr>
            <td>Positive COVID-19 Diagnostic of {$virus} type on</td>
            <td>{$date}</td>
        </tr>";
        
        
        echo $infectionlist;
        $counter++;
      }
    $result->free();
    }
  
  
}


?>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Person information</li>
        </ol>
    </nav>
   <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">

                <div class="col-lg-4 mb-3">
                    <label for="personID">Person ID</label>
                    <input type="text" name="personID" placeholder="Person ID" required>
                </div>
                     <!--    confirm button-->
                <div class="confirm_button col-lg-4 mb-3">
                      <input type="submit" name="search_personID" class="btn btn-dark pull-right" value="Search personID" >
                </div>
            </div>
            <h6 class="bg-success"><?php display_message(); ?></h6>           
        </form>




    <table class="table table-striped">
            
        
        
         
        <?php
        if(isset($_POST['search_personID'])){
            echo"
            <tr>
                <td>Health and Social Services</td>
                <td>Proof of Vaccination against COVID-19</td>
            </tr>";


            $personID =(int) $_POST['personID'];
            //user information
            echo"<tr>
                    <td><span style='font-weight:bold'>User Information:</span></td>
                    <td></td>
                </tr>";
            search_information($personID);
        
            //appointment
            verify_appointment($personID);
            
            //oversea
            vaccination_result_oversea($personID);


            //vaccination history
            vaccination_result($personID);

            //infection history
            infection_result($personID);
        
        }
        
        ?>
    </table>



    </div>
