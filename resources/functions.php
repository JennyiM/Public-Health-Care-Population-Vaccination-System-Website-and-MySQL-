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

function display_person($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $personID = (int) $a;
  $query = "SELECT * FROM person Where person.personID = $personID;";
  echo $query;
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
 function add_person(){
   if (isset($_POST['add_person'])) {
   $conn = connect();
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
   $sql = "INSERT INTO person (firstName, lastName, birthDate,citizenship,city,province,address,postCode,phone,email)
     VALUES ('$firstname','$lastname','$birthDate','$citizenship','$city','$province','$address','$postcode','$phone','$email');";
     if (mysqli_query($conn, $sql)) {
   echo "New record created successfully";
 } else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 }
    $conn->close();
   set_message("PERSON CREATED");
   redirect("index.php?person");
   exit();
 }
 }
  


?>
