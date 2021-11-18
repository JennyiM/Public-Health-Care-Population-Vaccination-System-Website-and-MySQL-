<?php 



if(isset($_GET['id'])){
    //edit_age_group$_GET['id']);
    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $groupID = (int)$_GET['id'];
    
    $queryA = "SELECT * FROM age_group Where age_group.groupID = $groupID;";
    if($result = $mysqli-> query($queryA)){
        while ($row = $result->fetch_assoc()){
            $groupID = $row["groupID"];
            $startdate = $row["startDate"];
            $enddate = $row["endDate"];
          
        }
            
    }
    

    if(isset($_POST['update_age_group'])){
            
        $groupID = $_POST["groupID"];
        $startdate = $_POST["startDate"];
        $enddate = $_POST["endDate"];
                
        $sql1 = "UPDATE age_group
                SET startDate = '$startdate', endDate = '$enddate'
                WHERE age_group.groupID = $groupID;";
            
            
            
        


        if (mysqli_query($conn, $sql1)) {
            echo "Update successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
     
        set_message("Record updated");
        //redirect("index.php?age_group");
        echo("<script>location.href = 'index.php?age_group';</script>");
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
                <li class="breadcrumb-item"><a href="index.php?age_group">Age Group</a></li>
                <li class="breadcrumb-item active" aria-current="page">Age Group information</li>
            </ol>
        </nav>
        <!--  person information-->
        <h4>Edit information</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="groupID">Group ID</label>
                    <input type="text" name="groupID" placeholder="group ID" value="<?php echo $groupID; ?>"  >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="startDate">start Date</label>
                    <input type="text"  name="startDate" placeholder="start Date" value="<?php echo $startdate; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="endDate">end Date</label>
                    <input type="text" name="endDate" placeholder="end Date" aria-describedby="inputGroupPrepend3" value="<?php echo $enddate; ?>" >
                </div>
            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="update_age_group" class="btn btn-dark pull-right" value="Update changes" >
                </div>
            </div>
        </form>
    </div>
</div>


