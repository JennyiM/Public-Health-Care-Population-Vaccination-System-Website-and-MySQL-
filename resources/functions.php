<?php

function connect(){
      $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
      if(!$conn){
          die('connect fail!');
      }
      mysqli_set_charset($conn,DB_SET_CHARSET);
      return $conn;
  }
  
  function set_message($msg)
{

  if (!empty($msg)) {

    $_SESSION['message'] = $msg;
  } else {

    $msg = "";
  }
}


function display_message()
{

  if (isset($_SESSION['message'])) {

    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }
}


function redirect($location)
{

  return header("Location: $location ");
}

//person part
function display_person($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $personID = (int) $a;
  $query = "SELECT * FROM person Where person.personID = $personID;";
  if($result = $mysqli-> query($query)){
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
      
      $personlist = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$personID}</td>
          <td row="cell">{$firstName}</td>
          <td row="cell">{$lastName}</td>
          <td row="cell">{$birthDate}</td>
          <td row="cell">{$citizenship}</td>
          <td row="cell">{$city}</td>
          <td row="cell">{$province}</td>
          <td row="cell">{$address}</td>
          <td row="cell">{$postCode}</td>
          <td row="cell">{$phone}</td>
          <td row="cell">{$email}</td>
         <td>
              <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_person&id={}'">Edit</button>
              <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_person_id={}'">Delete</button>
          </td> 
      </tr> 
      
      DELIMETER;
    
      echo $personlist;
    }
    $result->free();
  }
}

 function add_person_in(){
   if (isset($_POST['add_person_in'])) {
   $conn = connect();
   $query = "SELECT personID FROM person";
   $result = mysqli_query($conn,$query);
   $rowcount =mysqli_num_rows($result);
   $personID = ((int) $rowcount) + 1 ;
   echo $personID;
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
   $medicalCardNum = $_POST['medicalCardNum'];
   $mCardIssueDate = $_POST['mCardIssueDate'];
   $mCardEndDate = $_POST['mCardEndDate'];
   $sql = "INSERT INTO person
     VALUES ($personID,'$firstname','$lastname','$birthDate','$citizenship','$city','$province','$address','$postcode','$phone','$email');";
   $sql2 = "INSERT INTO in_sys_person 
   VALUES ($personID,'$medicalCardNum','$mCardIssueDate','$mCardEndDate');";
    if (mysqli_query($conn, $sql)) {
   echo "New record created successfully";
 } else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 }
 if (mysqli_query($conn, $sql2)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
}
    $conn->close();
   set_message("PERSON CREATED");
   redirect("index.php?person");
   exit();
 }
 }
  
 function add_person_out(){
  if (isset($_POST['add_person_out'])) {
  $conn = connect();
  $query = "SELECT personID FROM person";
  $result = mysqli_query($conn,$query);
  $rowcount =mysqli_num_rows($result);
  $personID = ((int) $rowcount) + 1 ;
  echo $personID;
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
  $sql = "INSERT INTO person
    VALUES ($personID,'$firstname','$lastname','$birthDate','$citizenship','$city','$province','$address','$postcode','$phone','$email');";
  $sql2 = "INSERT INTO out_sys_person 
  VALUES ($personID,'$passport');";
   if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
if (mysqli_query($conn, $sql2)) {
 echo "New record created successfully";
} else {
 echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
}
   $conn->close();
  set_message("PERSON CREATED");
  redirect("index.php?person");
  exit();
}
}

?>
