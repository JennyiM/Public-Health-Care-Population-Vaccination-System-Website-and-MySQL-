<?php 

if(isset($_GET['id'])){
    //edit_person($_GET['id']);
    //verify_province($_GET['provinceName']);
    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $provinceName = $_GET['id'];
    
    $queryA = "SELECT * FROM province Where province.provinceName = $provinceName;";
    if($result = $mysqli-> query($queryA)){
        while ($row = $result->fetch_assoc()){
            $provinceName = $row["provinceName"];
            $provStartDate = $row["provStartDate"];
            $vacAgeGroup = $row["vacAgeGroup"];
        }
            
    }
    

    if(isset($_POST['update_province'])){
            
        $provinceName = $_POST['provinceName'];
        $provStartDate = $_POST['provStartDate'];
        $vacAgeGroup = $_POST['vacAgeGroup'];

                
        $sql = "UPDATE province
                SET provStartDate = '$provStartDate', vacAgeGroup = $vacAgeGroup
                WHERE province.provinceName = '$provinceName';";



        if (mysqli_query($conn, $sql)) {
            echo "Update successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
     
        set_message("Record updated");
        //redirect("index.php?province");
        echo("<script>location.href = 'index.php?province';</script>");
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
                <li class="breadcrumb-item"><a href="index.php?province">province</a></li>
                <li class="breadcrumb-item active" aria-current="page">province information</li>
            </ol>
        </nav>
        <!--  province information-->
        <h4>Edit information</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="provinceName">Province Name</label>
                    <input type="text" name="provinceName" placeholder="Province Name" value="<?php echo $provinceName; ?>"  >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="provStartDate">Province Start Date</label>
                    <input type="text"  name="provStartDate" placeholder="Province Start Date" value="<?php echo $provStartDate; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="vacAgeGroup">Vaccination Age Group</label>
                    <input type="text" name="vacAgeGroup" placeholder="Vaccine Age Group" aria-describedby="inputGroupPrepend3" value="<?php echo $vacAgeGroup; ?>" >
                </div>
            </div>
    
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="update_province" class="btn btn-dark pull-right" value="Update changes" >
                </div>
            </div>
        </form>
    </div>
</div>


