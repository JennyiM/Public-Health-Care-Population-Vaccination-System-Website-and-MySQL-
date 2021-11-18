<?php 



if(isset($_GET['lotNumber'])){
    
    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $lotNumber = $_GET['lotNumber'];
    
    $queryA = "SELECT * FROM vaccin_status Where vaccin_status.lotNumber = '$lotNumber';";
    if($result = $mysqli-> query($queryA)){
        while ($row = $result->fetch_assoc()){
            $lotNumber = $row["lotNumber"];
            $type = $row["type"];
            $suspendedDate = $row["suspendedDate"];
            $approvedDate=$row["approvedDate"];
            $status=$row["status"];
        }
            
    }
    

    if(isset($_POST['update_vaccin_type'])){
            
        $lotNumber = $_POST["lotNumber"];
        $type = $_POST["type"];
        $suspendedDate = $_POST["suspendedDate"];
        $approvedDate=$_POST["approvedDate"];
        $status=$_POST["status"];
                
        $sql1 = "UPDATE vaccin_status
                SET type = '$type', suspendedDate = '$suspendedDate',approvedDate='$approvedDate',status='$status'
                WHERE vaccin_status.lotNumber= '$lotNumber';";
            
            
            
        


        if (mysqli_query($conn, $sql1)) {
            echo "Update successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
     
        set_message("Record updated");
        //redirect("index.php?age_group");
        echo("<script>location.href = 'index.php?vaccine_type';</script>");
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
                <li class="breadcrumb-item"><a href="index.php?age_group">Vaccine type</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit vaccine</li>
            </ol>
        </nav>
        <!--  person information-->
        <h4>Edit information</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="lotNumber">lot number</label>
                    <input type="text" name="lotNumber" placeholder="lot number" value="<?php echo $lotNumber; ?>"  >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="type">vaccin type</label>
                    <input type="text"  name="type" placeholder="type" value="<?php echo $type; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="suspendedDate">suspended Date</label>
                    <input type="text" name="suspendedDate" placeholder="suspendede Date" aria-describedby="inputGroupPrepend3" value="<?php echo $suspendedDate; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="approvedDate">approved Date</label>
                    <input type="text"  name="approvedDate" placeholder="approved Date" value="<?php echo $approvedDate; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="status">status</label>
                    <input type="text"  name="status" placeholder="status" value="<?php echo $status; ?>" >
                </div>
            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="update_vaccin_type" class="btn btn-dark pull-right" value="Update changes" >
                </div>
            </div>
        </form>
    </div>
</div>


