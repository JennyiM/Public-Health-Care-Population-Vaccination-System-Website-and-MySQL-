<?php

if(isset($_GET['SSN'])){
   
    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $SSN = (int)$_GET['SSN'];
    $query = "SELECT SSN,title,personID FROM public_worker WHERE SSN = $SSN;";
    if($result = $mysqli-> query($query)){
        while ($row = $result->fetch_assoc()){
            $SSN = $row["SSN"];
            $title = $row["title"];
            $personID = $row["personID"];
        }
            
    }

    if(isset($_POST['update_public_worker'])){
            
        $SSN = $_POST["SSN"];
        $title = $_POST["title"];
        $personID = $_POST["personID"];
      
        $sql = "UPDATE public_worker
                SET SSN = '$SSN', title = '$title', personID = '$personID' WHERE SSN = $SSN;";

        if (mysqli_query($conn, $sql)) {
            echo "Update successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
     
        set_message("Record updated");
        echo("<script>location.href = 'index.php?public_worker';</script>");
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
                <li class="breadcrumb-item"><a href="index.php?public_worker">public worker</a></li>
                <li class="breadcrumb-item active" aria-current="page">public worker information</li>
            </ol>
        </nav>
        <!--  public_worker information-->
        <h4>Edit information</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="SSN">SSN</label>
                    <input type="text" name="SSN" placeholder="SSN" value="<?php echo $SSN; ?>" readonly >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="title">Title</label>
                    <input type="text"  name="title" placeholder="title" value="<?php echo $title; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="personID">personID</label>
                    <input type="text" name="personID" placeholder="personID"  value="<?php echo $personID; ?>" readonly>
                </div>
            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Delete</a>
                      <input type="submit" name="update_public_worker" class="btn btn-dark pull-right" value="Update changes" >
                </div>
            </div>
        </form>
    </div>
</div>
