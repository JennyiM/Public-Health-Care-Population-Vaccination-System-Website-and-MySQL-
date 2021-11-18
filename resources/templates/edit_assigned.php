<?php

if(isset($_GET['SSN'])){
   
    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $SSN = (int)$_GET['SSN'];
    $employee_ID = (int)$_GET['employee_ID'];
    $facilityID = (int)$_GET['facilityID'];
    $query = "SELECT SSN,employee_ID,startDate,endDate,facilityID,hourly_rate FROM assigned WHERE SSN = $SSN  AND employee_ID = $employee_ID AND facilityID = $facilityID;";
    if($result = $mysqli-> query($query)){
        while ($row = $result->fetch_assoc()){
            $SSN = $row["SSN"];
            $employee_ID = $row["employee_ID"];
            $startDate = $row["startDate"];
            $endDate = $row["endDate"];
            $facilityID = $row["facilityID"];
            $hourly_rate = $row["hourly_rate"];
        }
            
    }

    if(isset($_POST['update_assigned'])){
            
        $SSN = $_POST["SSN"];
        $employee_ID = $_POST["employee_ID"];
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];
        $facilityID = $_POST["facilityID"];
        $hourly_rate = $_POST["hourly_rate"];
      
        $sql = "UPDATE assigned
                SET SSN = $SSN, employee_ID = $employee_ID, startDate = '$startDate', endDate = '$endDate', facilityID = $facilityID, hourly_rate=$hourly_rate 
                WHERE SSN = $SSN AND employee_ID = $employee_ID AND facilityID = $facilityID;";

        if (mysqli_query($conn, $sql)) {
            echo "Update successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
     
        set_message("Record updated");
        echo("<script>location.href = 'index.php?assigned';</script>");
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
                <li class="breadcrumb-item"><a href="index.php?assigned">assigned</a></li>
                <li class="breadcrumb-item active" aria-current="page">assigned information</li>
            </ol>
        </nav>
        <!--  assigned information-->
        <h4>Edit information</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="SSN">SSN</label>
                    <input type="text" name="SSN" placeholder="SSN" value="<?php echo $SSN; ?>"  >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="employee_ID">employee_ID</label>
                    <input type="text"  name="employee_ID" placeholder="employee_ID" value="<?php echo $employee_ID; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="startDate">startDate</label>
                    <input type="text" name="startDate" placeholder="startDate"  value="<?php echo $startDate; ?>" >
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="endDate">endDate</label>
                    <input type="text" name="endDate" placeholder="endDate" value="<?php echo $endDate; ?>"  >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="facilityID">facilityID</label>
                    <input type="text"  name="facilityID" placeholder="facilityID" value="<?php echo $facilityID; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="hourly_rate">hourly_rate</label>
                    <input type="text" name="hourly_rate" placeholder="hourly_rate"  value="<?php echo $hourly_rate; ?>" >
                </div>
            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Delete</a>
                      <input type="submit" name="update_assigned" class="btn btn-dark pull-right" value="Update changes" >
                </div>
            </div>
        </form>
    </div>
</div>
