<?php 
if(isset($_GET['id']) AND isset($_GET['dose'])){

    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $personID = (int)$_GET['id'];
    $doseNum =(int)$_GET['dose'];
    $orginalspot = 
    
    $query = "SELECT * FROM appointment Where personID = $personID AND doseNumber = $doseNum AND deleted_ = 0;";
    if($result = $mysqli-> query($query)){
        while ($row = $result->fetch_assoc()){
            $personID = $row["personID"];
            $facilityID = $row['facilityID'];
            $date = $row['date'];
            $timeslot = $row['timeslot'];
            $doseNum = $row['doseNumber'];
           
        }          
    }


if(isset($_POST['check_available'])){
    $date = $_POST["date"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
   
    $starthrs = strtotime($startTime);
    $endhrs = strtotime($endTime);
    $intervalTime = 1200;
    $intervalDate = 86400;
    $sql_open = "SELECT openHours FROM facility WHERE facilityID = $facilityID;";
    $sql_close = "SELECT closeHours FROM facility WHERE facilityID = $facilityID;";
    $openhours = mysqli_query($conn,$sql_open);
    $row1=  mysqli_fetch_row($openhours);
    $openhours = $row1[0];
    $openhrs = strtotime($openhours);
    
    $closehours = mysqli_query($conn,$sql_close);
    $row2=  mysqli_fetch_row($closehours);
    $closehours = $row2[0];
    $closehrs = strtotime($closehours);

    $spot_str = $openhours;
    $spot_time = $openhrs;
    $spot_list ="";
    // echo $spot_str;
    // echo $spot_time;
    // echo $closehrs;
    // echo $starthrs;
    // echo $endhrs;
    // echo $startTime;
    // echo $endTime;
    // echo "123";
    // print_r($_SESSION);
while($spot_time <= $closehrs && $spot_time <= $endhrs){
    $spot_str = date("h:i:s",$spot_time);
    $sql = "SELECT timeslot 
    FROM appointment
    WHERE facilityID = $facilityID AND date = '$date' AND timeslot ='$spot_str' AND deleted_ = 0;";
    $result = mysqli_query($conn,$sql);
    $rowcount = (int) mysqli_num_rows($result);
    // echo $rowcount;
    
    if($rowcount > 0){
        $spot_list =  "<option value='$spot_str' disabled> $spot_str </option>" . $spot_list;
    }
    if($rowcount == 0){
        $spot_list =  "<option value='$spot_str' > $spot_str </option>" . $spot_list;
    }
    mysqli_free_result($result);
    $spot_time = $spot_time + $intervalTime;
}

}

if(isset($_POST['edit_appointment'])){
            
    $personID = $_POST["personID"];
    $facilityID = $_POST["facilityID"];
    $doseNum = $_POST["dosenum"];
    $date = $_POST["date"]; 
    $timeslot = $_POST["timeslot"];
   
    $sql1 = "UPDATE appointment
            SET personID = '$personID', facilityID = '$facilityID', doseNumber = '$doseNum', date = '$date', timeslot = '$timeslot'
            WHERE personID = $personID AND doseNumber = $doseNum;";

    if (mysqli_query($conn, $sql1)) {
        echo "Update successfully";
    } 
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
 
    set_message("APPOINTMENT UPDATED");
    //redirect("index.php?person");
    echo("<script>location.href = 'index.php?appointment';</script>");
    exit();
}
// echo("<script>window.onload();</script>");
$conn->close();
}

?>  

</script>
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
        <h4>edit appointment</h4>

        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="personID">Person ID</label>
                    <input type="text" name="personID" placeholder="Person ID" value="<?php echo $personID; ?>" readonly>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="facilityID">Facility ID</label>
                    <input type="text"  name="facilityID" placeholder="Facility ID" value="<?php echo $facilityID; ?>" readonly>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="dosenum">Dose Number</label>
                    <input type="text"  name="dosenum" placeholder="Dose Number" value="<?php echo $doseNum; ?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="date">Date</label>
                    <input type="date" class="input-medium search-query" onkeypress="return false" name="date" value = "<?php echo $date; ?>" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="startTime">Start Time</label>
                    <input type="time" id = "appt" class="input-medium search-query" onkeypress="return false" name="startTime"  min ="" max= "" value = " " >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="endTime">End Time</label>
                    <input type="time" id = "appt" class="input-medium search-query" onkeypress="return false" name="endTime"  min ="" max= "" value = " " >
                </div>
            </div>
            <div class="form-row">
            <div class="col-lg-4 mb-3">
            </div>
            <div class="col-lg-4 mb-3">
                <select class="form-select form-select-lg mb-3" name = "timeslot" aria-label=".form-select-lg example">
                   <option selected>Choose a Timeslot</option>
                  <?php echo $spot_list; ?>
                </select>
                </div>
            </div>
         <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                      <input type="submit" name="check_available" class="btn btn-dark pull-right" value="Check available" >
                      <input type="submit" name="edit_appointment" class="btn btn-dark pull-right" value="Edit appointment" >
                </div>
            </div>
        </form>    
    </div>
</div>
