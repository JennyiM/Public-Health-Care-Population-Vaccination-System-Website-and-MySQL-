<?php 

if(isset($_GET['id'])){
    //edit_infection_type($_GET['id']);
    //verify_infection_type($_GET['id']);
    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $typeID = $_GET['id'];
    
    $queryA = "SELECT * FROM infection_type Where infection_type.typeID = $typeID;";
    if($result = $mysqli-> query($queryA)){
        while ($row = $result->fetch_assoc()){
            $typeID = $row["typeID"];
            $virus_type = $row["virus_type"];
           
        }
            
    }
    

    if(isset($_POST['update_infection_type'])){
            
        $typeID = $_POST['typeID'];
        $virus_type = $_POST['virus_type'];
       

                
        $sql1 = "UPDATE infection_type
                SET virus_type = '$virus_type'
                WHERE infection_type.typeID = $typeID;";



        if (mysqli_query($conn, $sql1)) {
            echo "Update successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
     
        set_message("Record updated");
        //redirect("index.php?infection_type");
        echo("<script>location.href = 'index.php?infection_type&id=$typeID';</script>");
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
                <li class="breadcrumb-item"><a href="index.php?infection_type">infection_type</a></li>
                <li class="breadcrumb-item active" aria-current="page">infection_type information</li>
            </ol>
        </nav>
        <!--  infection_type information-->
        <h4>Edit information</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="typeID">Type ID</label>
                    <input type="text" name="typeID" placeholder="Type ID" value="<?php echo $typeID; ?>"  >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="virus_type">Virus Type</label>
                    <input type="text"  name="virus_type" placeholder="Virus Type" value="<?php echo $virus_type; ?>" >
                </div>
                
            </div>
    
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Cancel</a>
                      <input type="submit" name="update_infection_type" class="btn btn-dark pull-right" value="Update changes" >
                </div>
            </div>
        </form>
    </div>
</div>


