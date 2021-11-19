<?php

if(isset($_GET['id']) AND isset($_GET['facilityID']) AND isset($_GET['doseNumber'])  ){
    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $personID = (int)$_GET['id'];
    $facilityID = (int)$_GET['facilityID'];
    $doseNumber = (int)$_GET['doseNumber'];
    
    $queryA = "SELECT * FROM person Where person.personID = $personID;";
    if($result = $mysqli-> query($queryA)){
        while ($row = $result->fetch_assoc()){
            $personID = $row["personID"];
            $firstName = $row["firstName"];
            $lastName = $row["lastName"];
        }
            
    }

  
}   

    if(isset($_POST['perform_a_vaccine'])){
            
        $personID = $_POST['personID'];
        $facilityID = $_POST['facilityID'];
        $lotNumber = $_POST['lotNumber'];
        $workingID = $_POST['workingID'];
        $date = $_POST['date'];
        $doseNumber = $_POST['doseNumber'];
        
    
             
        $sql1 = "INSERT INTO vaccination
                    VALUES ($personID,'$lotNumber',$facilityID,$workingID,'$date',$doseNumber,0);";

        $sql2 = "UPDATE appointment
                 SET appointment.deleted_ = 1
                 WHERE appointment.personID = $personID 
                       AND appointment.doseNumber = $doseNumber;";



        if (mysqli_query($conn, $sql1) AND mysqli_query($conn, $sql2)) {
            echo "Record creates successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
     
        set_message("Record created");
        //redirect("index.php?person");
        echo("<script>location.href = 'index.php?perform_vaccine_withapm';</script>");
        exit();
        $conn->close();
    }
?>


    
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?perform_vaccine">Perform Vaccine</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add information</li>
            </ol>
        </nav>
        <!--  person information-->
        <h4>Information form</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="personID">PersonID</label>
                    <input type="text" name="personID" placeholder="personID" aria-describedby="inputGroupPrepend3" value="<?php echo $personID; ?>">
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="firstname">First name</label>
                    <input type="text" name="firstName" placeholder="First name"  value="<?php echo $firstName; ?>">
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="lastname">Last name</label>
                    <input type="text"  name="lastName" placeholder="Last name"  value="<?php echo $lastName; ?>">
                </div>

              
                
            </div>

            
            <div class="form-row">
                
                <div class="col-lg-4 mb-3">
                    <label for="facilityID">facilityID</label>
                    <input type="text"  name="facilityID" placeholder="facilityID" value="<?php echo $facilityID; ?>">
                </div>



                <div class="col-lg-4 mb-3">
                    <label for="lotNumber">lotNumber</label>
                    <input type="text"  name="lotNumber" placeholder="lotNumber" required>
                </div>
                
                
                
                <div class="col-lg-4 mb-3">
                    <label for="workingID">workingID</label>
                    <input type="text"  name="workingID" placeholder="workingID" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="date">date</label>
                    <input type="text"  name="date" placeholder="date" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="doseNumber">doseNumber</label>
                    <input type="text"  name="doseNumber" placeholder="doseNumber" value="<?php echo $doseNumber; ?>">
                </div>
            
            </div>
           
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="perform_a_vaccine" class="btn btn-dark pull-right" value="Perform a vaccine" >
                </div>
            </div>
        </form>
    </div>
</div>
