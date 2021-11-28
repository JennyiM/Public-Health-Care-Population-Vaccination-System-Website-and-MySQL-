<?php 

if (isset($_POST['add_appointment_check'])) {
    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $personID = $_POST['personID'];
    $facilityID = $_POST['facilityID'];
    $doseNum =$_POST["dosenum"];
    $date = $_POST['date'];

    $sql = "SELECT * 
    FROM appointment
    WHERE personID = $personID  AND doseNumber = $doseNum AND deleted_ = 0;";
    $result = mysqli_query($conn,$sql);
    $rowcount = (int) mysqli_num_rows($result);
    
    if($rowcount == 0){
        $sql1= "SELECT groupID FROM age_group WHERE (SELECT birthDate FROM person WHERE personID = $personID) BETWEEN startDate AND endDate;";
        $sql2= "SELECT vacAgeGroup FROM province WHERE provinceName = (SELECT province FROM facility WHERE facilityID = $facilityID);";
        $sql3 ="SELECT date,doseNumber FROM vaccination WHERE personID = $personID AND doseNumber = 1;";
        $sql4 ="SELECT personID FROM public_worker WHERE personID = $personID;";
        $result1 = mysqli_query($conn,$sql1);
        $row1 =  mysqli_fetch_row($result1);
        $ageGroup_person = (int) $row1[0];
        $result2 = mysqli_query($conn,$sql2);
        $row2 =  mysqli_fetch_row($result2);
        $ageGroup_province = (int) $row2[0];
        if($result3 = $mysqli-> query($sql3)){
            while ($row = $result3->fetch_assoc()){
                $date_dose1 = $row["date"];
                $dose_1 = $row["doseNumber"];
            }
        }
        $result4 = mysqli_query($conn,$sql4);
        $row4 =  mysqli_fetch_row($result4);
        $personID_p = (int) $row4[0];
        // $row3 =  mysqli_fetch_row($result3);
        // $dose_1 = (int) $row3[0];
        
        $doseNum = (int)$doseNum;
        if($ageGroup_province == 0){
            echo("<script>location.href = 'index.php?appointment';</script>");
                set_message("Right now, it is short of vaccine!");
        }
        else{
            if ($doseNum == 1){
          
                if($ageGroup_person <= $ageGroup_province ||$personID_p != 0){
                $_SESSION["personID"] = $personID;
                $_SESSION["facilityID"] = $facilityID;
                $_SESSION["doseNum"] = $doseNum;
                $_SESSION["date"] = $date;
                // print_r($_SESSION);
                echo("<script>location.href = 'index.php?add_appointment';</script>");
                }
                else if($ageGroup_person > $ageGroup_province) {
                    echo("<script>location.href = 'index.php?appointment';</script>");
                    set_message("The appointment is not available for your age!");
                }
            }
            else if ($doseNum == 2){
               if($dose_1 == '' && $ageGroup_person <= $ageGroup_province){
                echo("<script>location.href = 'index.php?appointment';</script>");
                set_message("Please book an appointment for Dose 1!");
               }
               else if($dose_1 == 1 && $ageGroup_person <= $ageGroup_province){
                $_SESSION["personID"] = $personID;
                $_SESSION["facilityID"] = $facilityID;
                $_SESSION["doseNum"] = $doseNum;
                $date_org = strtotime($date);
                $date_should = strtotime($date_dose1.'+ 14days');
                if ($date_org<= $date_should){
                $_SESSION["date"] = date('Y-m-d',strtotime($date_dose1.'+ 14 days'));
                }
                else{
                    $_SESSION["date"] = $date;
                }
                
                // print_r($_SESSION);
                echo("<script>location.href = 'index.php?add_appointment';</script>");
               }
               else{
                echo("<script>location.href = 'index.php?appointment';</script>");
                set_message("The appointment is not available for your age!");
               }
            }
    
        }
       

    }
    
   else if($rowcount != 0){
        echo("<script>location.href = 'index.php?appointment';</script>");
        set_message("Sorry, you just can make one appointment for each dose!");
    }
    
    $conn->close();
    exit();
  }

?>  
    
    <div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?appointment">Appointment</a></li>
                <li class="breadcrumb-item active" aria-current="page">appointment information</li>
            </ol>
        </nav>
        <!--  appointment information-->
        <h4>add appointment</h4>


        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="personID">Person ID</label>
                    <input type="text" name="personID" placeholder="Person ID"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="facilityID">Facility ID</label>
                    <input type="text"  name="facilityID" placeholder="Facility ID"  required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="dosenum">Dose Number</label>
                    <input type="text"  name="dosenum" placeholder="Dose Number" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="date">Date</label>
                    <input type="date"   value="yyyy-mm-dd" class="input-medium search-query" onkeypress="return false" name="date" placeholder="Date" aria-describedby="inputGroupPrepend3" required>
                </div>
            </div>
         <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                      <input type="submit" name="add_appointment_check" class="btn btn-dark pull-right" value="Check Available" >
                </div>
            </div>
        </form>    
    </div>
</div>
