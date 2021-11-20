<?php 
$startDate = $_SESSION["date"];
$startds = $_SESSION["date"];
$facilityID = $_SESSION["facilityID"];
$startDate = strtotime("$startDate");
$conn = connect();

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
// echo "$closehrs";

$spot_str = $openhours;
$spot_time = $openhrs;
$spot_list ="";


// echo $startds;
// echo $spot_str;
// echo "rowcount". $rowcount;

while($spot_time <= $closehrs){
    $spot_str = date("h:i:s",$spot_time);
    $sql = "SELECT timeslot 
    FROM appointment
    WHERE facilityID = $facilityID AND date = '$startds' AND timeslot ='$spot_str' AND deleted_ = 0;";
    $result = mysqli_query($conn,$sql);
    $rowcount = (int) mysqli_num_rows($result);

    // echo $startds;
    // echo $spot_str;
    // echo "rowcount". $rowcount;

    if($rowcount == 0){
        $spot_list =  "<option value='' > $spot_str </option>" . $spot_list;
        // $_SESSION['timeslot'] = $spot_str;
        break;
    }
   
 
    $spot_time = $spot_time + $intervalTime;
    $result->free();
}
 
if($spot_list == ''){
    $_SESSION["date"] = date("Y-m-d",($startDate + 86400));
    echo("<script>window.location.reload();</script>");
}
//  $_SESSION['timeslot'] = $spot_str;
$conn->close();

if (isset($_POST['add_appointment'])) {
    $conn = connect();
    $personID = $_POST['personID'];
    $facilityID = $_POST['facilityID'];
    $doseNum = $_POST['dosenum'];
    $date = $_POST['date'];
    $timeslot = $_SESSION['timeslot'];
    echo $timeslot;
    $sql = "INSERT INTO appointment
      VALUES ($personID,'$facilityID','$date','$timeslot','$doseNum',0);";
   
     if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  if (mysqli_query($conn, $sql)) {
   echo "New record created successfully";
 } else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 }
     $conn->close();
    set_message("APPOINTMENT CREATED");
    echo("<script>location.href = 'index.php?appointment';</script>");
    exit();
  }
// 
// while($spot_time <= $closehrs){
//     $spot_str = date("h:i:s",$spot_time);
//     $sql = "SELECT timeslot 
//     FROM appointment
//     WHERE facilityID = $facilityID AND date = '$startds' AND timeslot ='$spot_str';";
//     $result = mysqli_query($conn,$sql);
//     $rowcount = (int) mysqli_num_rows($result);
    
//     if($rowcount >= 0){
//         $spot_list =  "<option value='$spot_str' disabled> $spot_str </option>" . $spot_list;
//     }
//     else if($rowcount == 0){
//         $spot_list =  "<option value='$spot_str' > $spot_str </option>" . $spot_list;
//     }
 
//     $spot_time = $spot_time + $intervalTime;
// }


// print_r($_SESSION);
// $_SESSION["date"] = date("Y-m-d",($startDate + 86400));
// print_r($_SESSION);
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
                    <input type="text" name="personID" placeholder="Person ID" value="<?php echo $_SESSION["personID"]; ?>" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="facilityID">Facility ID</label>
                    <input type="text"  name="facilityID" placeholder="Facility ID" value="<?php echo $_SESSION["facilityID"]; ?>" required>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="dosenum">Dose Number</label>
                    <input type="text"  name="dosenum" placeholder="Dose Number" value="<?php echo $_SESSION["doseNum"]; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="date">Date</label>
                    <input type="date" class="input-medium search-query" onkeypress="return false" name="date" value = "<?php echo $_SESSION["date"]; ?>" required>
                </div>
                <!-- <div class="col-lg-4 mb-3"> -->
                <select class="form-select form-select-lg mb-3" name = "<?php echo $_SESSION["timeslot"]; ?>" aria-label=".form-select-lg example">
                   <option selected>Choose a Timeslot</option>
                  <?php echo $spot_list; ?>
                </select>
                <!-- </div> -->
            </div>
         <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                      <input type="submit" name="add_appointment" class="btn btn-dark pull-right" value="Add appointment" >
                </div>
            </div>
        </form>    
    </div>
</div>
