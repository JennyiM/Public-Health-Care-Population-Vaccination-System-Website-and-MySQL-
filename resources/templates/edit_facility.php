<?php 
if(isset($_GET['id'])){
    //edit_person($_GET['id']);
    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $facilityID = (int)$_GET['id'];
    
    $queryA = "SELECT * FROM facility Where facility.facilityID = $facilityID;";
    if($result = $mysqli-> query($queryA)){
        while ($row = $result->fetch_assoc()){
            $facilityID = $row["facilityID"];
            $facilityName = $row["facilityName"];
            $type = $row["type"];
            $capacity = $row["capacity"];
            $address = $row["address"]; 
            $phone = $row["phone"];
            $webAddress = $row["webAddress"];
            $managerID = $row["managerID"];
            $totalNumEmployee = $row["totalNumEmployee"];
            $totalNumNurse = $row["totalNumNurse"]; 
            $province = $row["province"];
            $openHours = $row["openHours"];
            $closeHours = $row["closeHours"];
        }
            
    }
   

    if(isset($_POST['update_facility'])){
            
        //$facilityID = $_POST["facilityID"];
        $facilityName = $_POST["facilityName"];
        $type = $_POST["type"];
        $capacity = $_POST["capacity"];
        $address = $_POST["address"]; 
        $phone = $_POST["phone"];
        $webAddress = $_POST["webAddress"];
        $managerID = $_POST["managerID"];
        $totalNumEmployee = $_POST["totalNumEmployee"];
        $totalNumNurse = $_POST["totalNumNurse"]; 
        $province = $_POST["province"];
        $openHours = $_POST["openHours"];
        $closeHours = $_POST["closeHours"];
                
        $sql1 = "UPDATE facility
                SET facilityName = '$facilityName', type = '$type', capacity = '$capacity', address = '$address', phone = '$phone', webAddress = '$webAddress', managerID = '$managerID',
                totalNumEmployee =  '$totalNumEmployee', totalNumNurse = '$totalNumNurse', province = '$province' ,openHours = '$openHours', closeHours = '$closeHours' 
                WHERE facility.facilityID = $facilityID;";

        if (mysqli_query($conn, $sql1)) {
            echo "Update successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
     
        set_message("Record updated");
        //redirect("index.php?person");
        echo("<script>location.href = 'index.php?facility';</script>");
        exit();
    }
    $conn->close();
}

?>

<div class="main col-lg-9 col-md-9 py-3 flex-grow-1 ">
        <!--    breadcrumb link-->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?facility">facility</a></li>
                <li class="breadcrumb-item active" aria-current="page">edit facility</li>
            </ol>
        </nav>
        <!--  person information-->
        <h4>Edit information</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="facilityName">Facility Name</label>
                    <input type="text" name="facilityName" placeholder="Facility name" value="<?php echo $facilityName; ?>"  >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="type">type</label>
                    <input type="text"  name="type" placeholder="type" value="<?php echo $type;?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="capacity">Capacity</label>
                    <input type="text" name="capacity" placeholder="capacity" aria-describedby="inputGroupPrepend3" value="<?php echo $capacity; ?>" >
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="address">Address</label>
                    <input type="text"  name="address" placeholder="address" value="<?php echo $address; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="phone">Phone</label>
                    <input type="text"  name="phone" placeholder="phone" value="<?php echo $phone; ?>">
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="webaddress">WebAddress</label>
                    <input type="text"  name="webAddress" placeholder="webAddress"  value="<?php echo $webAddress; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="managerID">managerID</label>
                    <input type="text"  name="managerID" placeholder="managerID" value="<?php echo $managerID; ?>">
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="totalNumEmployee">totalNumEmployee</label>
                    <input type="text"  name="totalNumEmployee" placeholder="totalNumEmployee" value="<?php echo $totalNumEmployee; ?>">
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="totalNumNurse">totalNumNurse</label>
                    <input type="text"  name="totalNumNurse" placeholder="totalNumNurse" value="<?php echo $totalNumNurse; ?>" >
                </div>
            </div>
           
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="province">province</label>
                    <input type="text"  name="province" placeholder="province" value="<?php echo $province; ?>" >
                </div>
            </div>
            
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="openHours">Open hours</label>
                    <input type="text"  name="openHours" placeholder="openHours" value="<?php echo $openHours; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="closeHours">Close hours</label>
                    <input type="text"  name="closeHours" placeholder="closeHours" value="<?php echo $closeHours; ?>" >
                </div>

            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="update_facility" class="btn btn-dark pull-right" value="Update changes" >
                </div>
            </div>
        </form>
    </div>
</div>


