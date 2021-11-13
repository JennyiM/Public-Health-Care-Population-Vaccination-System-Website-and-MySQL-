<?php

if(isset($_GET['id'])){
    //edit_person($_GET['id']);
     
    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $personID = (int)$_GET['id'];
    
    $queryA = "SELECT * FROM person Where person.personID = $personID;";
    if($result = $mysqli-> query($queryA)){
        while ($row = $result->fetch_assoc()){
            $personID = $row["personID"];
            $firstName = $row["firstName"];
            $lastName = $row["lastName"];
            $birthDate = $row["birthDate"];
            $citizenship = $row["citizenship"]; 
            $city = $row["city"];
            $province = $row["province"];
            $address = $row["address"];
            $postCode = $row["postCode"];
            $phone = $row["phone"]; 
            $email = $row["email"];
        }
            
    }
    
    $queryB = "SELECT * FROM out_sys_person Where out_sys_person.personID = $personID;";
    if($result = $mysqli-> query($queryB)){
        while ($row = $result->fetch_assoc()){
            $personID = $row["personID"];
            $passport = $row["passport"];
    
        }
    }

    if(isset($_POST['update_person_out'])){
            
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $birthDate = $_POST['birthDate'];
        $citizenship = $_POST['citizenship'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $address = $_POST['address'];
        $postcode = $_POST['postcode'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $passport = $_POST['passport'];
      
        $sql1 = "UPDATE person
                SET firstName = '$firstname', lastName = '$lastname', birthDate = '$birthDate', citizenship = '$citizenship', city = '$city', province = '$province', address = '$address', postCode =  '$postcode', phone = '$phone', email = '$email'
                WHERE person.personID = $personID;";
            
            
            
        $sql2 = "UPDATE out_sys_person 
                SET passport = '$passport'
                WHERE out_sys_person.personID = $personID;";



        if (mysqli_query($conn, $sql1) AND mysqli_query($conn, $sql2)) {
            echo "Update successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
     
        set_message("Record updated");
        redirect("index.php?person");
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
                <li class="breadcrumb-item"><a href="index.php?person">person</a></li>
                <li class="breadcrumb-item active" aria-current="page">person information</li>
            </ol>
        </nav>
        <!--  person information-->
        <h4>Edit information</h4>
        <form class="user_info" action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="firstname">First name</label>
                    <input type="text" name="firstname" placeholder="First name" value="<?php echo $firstName; ?>"  >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="lastname">Last name</label>
                    <input type="text"  name="lastname" placeholder="Last name" value="<?php echo $lastName; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="birthDate">Date of Birth</label>
                    <input type="text" name="birthDate" placeholder="birthDate" aria-describedby="inputGroupPrepend3" value="<?php echo $birthDate; ?>" >
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="citizenship">Citizenship</label>
                    <input type="text"  name="citizenship" placeholder="Citizenship" value="<?php echo $citizenship; ?>" >
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="city">City</label>
                    <input type="text"  name="city" placeholder="city" value="<?php echo $city; ?>">
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="province">Province</label>
                    <input type="text"  name="province" placeholder="Province"  value="<?php echo $province; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="address">Address</label>
                    <input type="text"  name="address" placeholder="address" value="<?php echo $address; ?>">
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="postcode">Post Code</label>
                    <input type="text"  name="postcode" placeholder="Postcode" value="<?php echo $postCode; ?>">
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="phone">Phone</label>
                    <input type="text"  name="phone" placeholder="Phone" value="<?php echo $phone; ?>" >
                </div>
            </div>
           
            <div class="form-row">
                <div class="col-lg-4 mb-3">
                    <label for="email">Email</label>
                    <input type="text"  name="email" placeholder="Email" value="<?php echo $email; ?>" >
                </div>
            </div>
            
            <div class="form-row">
                
                <div class="col-lg-4 mb-3">
                    <label for="mCardIssueDate">Medical Card Issue Date</label>
                    <input type="text"  name="passport" placeholder="passport" value="<?php echo $passport; ?>" >
                </div>
                
            </div>
            <!--    confirm button-->
            <div class="form-row">
                <div class="confirm_button col-lg-12">
                     <a id="user-id" class="btn btn-danger" href="">Delete</a>
                      <input type="submit" name="update_person_out" class="btn btn-dark pull-right" value="Update changes" >
                </div>
            </div>
        </form>
    </div>
</div>
