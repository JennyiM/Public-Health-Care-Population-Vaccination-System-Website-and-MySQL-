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

  return header("Location: $location");
}

//person part
function display_person($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $personID = (int) $a;
  $query = "SELECT * FROM person Where person.personID = $personID AND person.deleted_ = 0;";
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
              <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_inperson&id=$personID'">Edit</button>
              <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_person&id=$personID'">Delete</button>
          </td> 
      </tr> 
      
      DELIMETER;
    
      echo $personlist;
    }
    $result->free();
  }

  $query1 = "SELECT * FROM infection_history Where personID = $personID;";
  if($result1 = $mysqli-> query($query1)){
    while ($row1 = $result1->fetch_assoc()){
      $startDate = $row1["startDate"];
      $endDate = $row1["endDate"];
      $infectionType = $row1["infectionType"];
      
      $infectionlist = <<<DELIMETER
      <table class="table table-hover" role="table">
        <thead role="rowgroup">
           <tr role="row">
           <th scope="col" role="columnheader">Infection Start Date</th>
           <th scope="col" role="columnheader">Infection End Date</th>
           <th scope="col" role="columnheader">Infection Type</th>
        </tr>
        <tr role="row">
          <td row="cell">{$startDate}</td>
          <td row="cell">{$endDate}</td>
          <td row="cell">{$infectionType}</td>
      </tr> 
        </thead>
       <tbody role="rowgroup">
        </tbody>
       </table>
      
      DELIMETER;
    
      echo $infectionlist;
    }
    $result1->free();
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
     VALUES ($personID,'$firstname','$lastname','$birthDate','$citizenship','$city','$province','$address','$postcode','$phone','$email',0);";
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
    VALUES ($personID,'$firstname','$lastname','$birthDate','$citizenship','$city','$province','$address','$postcode','$phone','$email', 0);";
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

function delete_person(){
  if (isset($_GET['id'])) {
  $conn = connect();
  $personID = (int)$_GET['id'];
  echo $personID;
  $sql = "UPDATE person SET deleted_ = 1 WHERE personID = '$personID'";
    if (mysqli_query($conn, $sql)) {
      echo "Delete successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
   $conn->close();
  set_message("PERSON DELETED");
  //redirect("index.php?person");
  echo("<script>location.href = 'index.php?person';</script>");
  exit();
  }
}

function verify_person($a){
    // ob_start();
    $conn = connect();
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $personID = (int)$a;
    $query = "SELECT * FROM out_sys_person WHERE out_sys_person.personID = $personID;";
    $result = $mysqli-> query($query);
    $num = mysqli_num_rows($result);
    if($num != '0' ){

      echo("<script>location.href = 'index.php?edit_outperson&id=$personID';</script>");
      //  redirect("index.php?edit_outperson&id=$personID");
    }
}
//appointment
//appointment
function display_appointment($personID, $date){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $personID = (int) $personID;
  $query = "SELECT * FROM appointment Where personID = $personID AND appointment.date = '$date' AND deleted_ = 0;";
  if($result = $mysqli-> query($query)){
    while ($row = $result->fetch_assoc()){
      $personID = $row["personID"];
      $facilityID = $row["facilityID"];
      $date = $row["date"];
      $timeslot = $row["timeslot"];
      $doseNum =$row["doseNumber"];
      
      $appointlist = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$personID}</td>
          <td row="cell">{$facilityID}</td>
          <td row="cell">{$date}</td>
          <td row="cell">{$doseNum}</td>
          <td row="cell">{$timeslot}</td>
         <td>
              <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_appointment&id=$personID'">Edit</button>
              <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_person&id=$personID'">Delete</button>
          </td> 
      </tr> 
      
      DELIMETER;
    
      echo $appointlist;
    }
    $result->free();
  }
}



function display_facility($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $facilityID = (int) $a;
  $query = "SELECT * FROM facility Where facility.facilityID= $facilityID AND facility.deleted_ = 0;";
  if($result = $mysqli-> query($query)){
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
      
      $personlist = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$facilityID}</td>
          <td row="cell">{$facilityName}</td>
          <td row="cell">{$type}</td>
          <td row="cell">{$capacity}</td>
          <td row="cell">{$address}</td>
          <td row="cell">{$phone}</td>
          <td row="cell">{$webAddress}</td>
          <td row="cell">{$managerID}</td>
          <td row="cell">{$totalNumEmployee}</td>
          <td row="cell">{$totalNumNurse}</td>
          <td row="cell">{$province}</td>
          <td row="cell">{$openHours}</td>
          <td row="cell">{$closeHours}</td>
         <td>
              <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_facility&id=$facilityID'">Edit</button>
              <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_facility&id=$facilityID'">Delete</button>
          </td> 
      </tr> 
      
      DELIMETER;
    
      echo $personlist;
    }
    $result->free();
  }
}

function add_facility(){
  if(isset($_POST['add_facility'])) {
  $conn = connect();
  $query = "SELECT facilityID FROM facility";
  $result = mysqli_query($conn,$query);
  $rowcount =mysqli_num_rows($result);
  $facilityID = ((int) $rowcount) + 1 ;
  //echo $facilityID;
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
    
    $sql = "INSERT INTO facility
    VALUES ($facilityID,'$facilityName','$type','$capacity','$address','$phone','$webAddress','$managerID'
          ,'$totalNumEmployee','$totalNumNurse','$province', '$openHours', '$closeHours', 0);";
    
    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    $conn->close();
    set_message("FACILITY CREATED");
    //redirect("index.php?person");
    echo("<script>location.href = 'index.php?facility';</script>");
    exit();

  }

 
}


function display_public_worker($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $SSN = (int) $a;
  $query = "SELECT pw.SSN,p.firstName,p.lastName,pw.title FROM person p, public_worker pw WHERE pw.SSN = $SSN AND p.personID = pw.personID AND pw.deleted_ = 0;";
  if($result = $mysqli-> query($query)){
      while ($row = $result->fetch_assoc()){
        $SSN = $row["SSN"];
        $firstName = $row["firstName"];
        $lastName = $row["lastName"];
        $title = $row["title"];

        $pworkerlist = <<<DELIMETER
        <tr role="row">
            <td row="cell">{$SSN}</td>
            <td row="cell">{$firstName}</td>
            <td row="cell">{$lastName}</td>
            <td row="cell">{$title}</td>
          <td>
                <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_public_worker&SSN=$SSN'">Edit</button>
                <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_public_worker&SSN=$SSN'">Delete</button>
            </td> 
        </tr> 
        DELIMETER;
      
        echo $pworkerlist;
      }
      $result->free();
    }
}

function add_public_worker(){
  if(isset($_POST['add_public_worker'])) {
      $conn = connect();
      $SSN = $_POST["SSN"];
      $title = $_POST["title"];
      $personID = $_POST["personID"];
      $sql = "INSERT INTO public_worker VALUES ($SSN,'$title',$personID,0);";
      
      if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      
      $conn->close();
      set_message("Public Worker CREATED");
      echo("<script>location.href = 'index.php?public_worker';</script>");
      exit();
  
    }
}

function display_assignment($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $SSN = (int) $a;
  $query = "SELECT a.SSN, p.firstName,p.lastName, f.facilityName,pw.title,a.startDate,a.endDate,a.hourly_rate,a.facilityID,a.employee_ID
            FROM assignment a, public_worker pw,person p, facility f
            WHERE a.SSN=$SSN AND a.SSN = pw.SSN AND pw.personID = p.personID AND f.facilityID = a.facilityID AND a.deleted_ = 0;";
  if($result = $mysqli-> query($query)){
      while ($row = $result->fetch_assoc()){
        $SSN = $row["SSN"];
        $firstName = $row["firstName"];
        $lastName = $row["lastName"];
        $facilityName = $row["facilityName"];
        $title = $row["title"];
        $startDate = $row["startDate"];
        $endDate = $row["endDate"];
        $hourly_rate = $row["hourly_rate"];
        $facilityID = $row["facilityID"];
        $employee_ID = $row["employee_ID"];


        $assignlist = <<<DELIMETER
        <tr role="row">
            <td row="cell">{$SSN}</td>
            <td row="cell">{$firstName}</td>
            <td row="cell">{$lastName}</td>
            <td row="cell">{$facilityName}</td>            
            <td row="cell">{$title}</td>
            <td row="cell">{$startDate}</td>
            <td row="cell">{$endDate}</td>
            <td row="cell">{$hourly_rate}</td>

          <td>
                <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_assignment&SSN=$SSN&employee_ID=$employee_ID&facilityID=$facilityID'">Edit</button>
                <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_assignment&SSN=$SSN&employee_ID=$employee_ID&facilityID=$facilityID'">Delete</button>
            </td> 
        </tr> 
        DELIMETER;
      
        echo $assignlist;
      }
      $result->free();
    }
}


function add_assignment(){
  if(isset($_POST['add_assignment'])) {
      $conn = connect();
      $SSN = $_POST["SSN"];
      $employee_ID = $_POST["employee_ID"];
      $startDate = $_POST["startDate"];
      $endDate = $_POST["endDate"];
      $facilityID = $_POST["facilityID"];
      $hourly_rate = $_POST["hourly_rate"];
      $sql = "INSERT INTO assignment VALUES ($SSN,$employee_ID,'$startDate','$endDate',$facilityID,$hourly_rate,0);";
      
      if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      
      $conn->close();
      set_message("Assignment CREATED");
      echo("<script>location.href = 'index.php?assignment';</script>");
      exit();
  
    }
}


?>
