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
function display_appointment($personID, $doseNum){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $personID = (int) $personID;
  $query = "SELECT * FROM appointment Where personID = $personID AND appointment.doseNumber = '$doseNum' AND deleted_ = 0;";
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
              <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_appointment&id=$personID&dose=$doseNum'">Edit</button>
              <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_appointment&id=$personID&dose=$doseNum'">Delete</button>
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

function display_assigned($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $SSN = (int) $a;
  $query = "SELECT a.SSN, p.firstName,p.lastName, f.facilityName,pw.title,a.startDate,a.endDate,a.hourly_rate,a.facilityID,a.employee_ID
            FROM assigned a, public_worker pw,person p, facility f
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
                <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_assigned&SSN=$SSN&employee_ID=$employee_ID&facilityID=$facilityID'">Edit</button>
                <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_assigned&SSN=$SSN&employee_ID=$employee_ID&facilityID=$facilityID'">Delete</button>
            </td> 
        </tr> 
        DELIMETER;
      
        echo $assignlist;
      }
      $result->free();
    }
}


function add_assigned(){
  if(isset($_POST['add_assigned'])) {
      $conn = connect();
      $SSN = $_POST["SSN"];
      $employee_ID = $_POST["employee_ID"];
      $startDate = $_POST["startDate"];
      $endDate = $_POST["endDate"];
      $facilityID = $_POST["facilityID"];
      $hourly_rate = $_POST["hourly_rate"];
      $sql = "INSERT INTO assigned VALUES ($SSN,$employee_ID,'$startDate','$endDate',$facilityID,$hourly_rate,0);";
      
      if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      
      $conn->close();
      set_message("assigned CREATED");
      echo("<script>location.href = 'index.php?assigned';</script>");
      exit();
  
    }
}

function display_ageGroup($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $groupID = (int) $a;
  $query = "SELECT * FROM age_group Where age_group.groupID = $groupID AND age_Group.deleted_ = 0;";
  if($result = $mysqli-> query($query)){
    while ($row = $result->fetch_assoc()){
      $groupID = $row["groupID"];
      $StartDate = $row["startDate"];
      $EndDate = $row["endDate"];
      $Age=$row["age"];
      
      $agegrouplist = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$groupID}</td>
          <td row="cell">{$StartDate}</td>
          <td row="cell">{$EndDate}</td>
          <td row="cell">{$Age}</td>
         <td>
              <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_age_group&id=$groupID'">Edit</button>
              <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_age_group&id=$groupID'">Delete</button>
          </td> 
      </tr> 
      
      DELIMETER;
    
      echo $agegrouplist;
    }
    $result->free();
  }
}

function add_age_group(){
  if(isset($_POST['add_age_group'])) {
  $conn = connect();
  $query = "SELECT groupID FROM age_group;";
  $result = mysqli_query($conn,$query);
  $rowcount =mysqli_num_rows($result);
  $groupID = ((int) $rowcount) + 1 ;
  echo $groupID;
 
  $startDate = $_POST['startDate'];
  $endDate = $_POST['endDate'];
  $age=$_POST['age'];
  $sql = "INSERT INTO age_group 
    VALUES ($groupID,'$startDate','$endDate','$age',0);";
   if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
   $conn->close();
  set_message("age group CREATED");
  echo("<script>location.href = 'index.php?age_group';</script>");
  exit();
}
}
function delete_age_group(){
  if (isset($_GET['id'])) {
  $conn = connect();
  $groupID = (int)$_GET['id'];
  echo $groupID;
  $sql = "UPDATE age_group SET deleted_ = 1 WHERE groupID = '$groupID'";
    if (mysqli_query($conn, $sql)) {
      echo "Delete successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
   $conn->close();
  set_message("AGE GROUP DELETED");
  //redirect("index.php?person");
  echo("<script>location.href = 'index.php?age_group';</script>");

  exit();
  }
}
function display_vaccintype($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $lotNumber = $a;
  $query = "SELECT * FROM vaccin_status Where vaccin_status.lotNumber = '$lotNumber' AND vaccin_status.deleted_ = 0;";
  if($result = $mysqli-> query($query)){
    while ($row = $result->fetch_assoc()){
      $lotNumber = $row["lotNumber"];
      $vaccintype = $row["type"];
      $suspendedDate = $row["suspendedDate"];
      $approvedDate = $row["approvedDate"];
      $status = $row["status"];

      $vaccintypelist = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$lotNumber}</td>
          <td row="cell">{$vaccintype}</td>
          <td row="cell">{$suspendedDate}</td>
          <td row="cell">{$approvedDate}</td>
          <td row="cell">{$status}</td>
         <td>
              <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_vaccine_type&lotNumber=$lotNumber'">Edit</button>
              <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_vaccine&lotNumber=$lotNumber'">Delete</button>
          </td> 
      </tr> 
      
      DELIMETER;
    
      echo $vaccintypelist;
    }
    $result->free();
  }
}
function add_vaccine_type(){
  if(isset($_POST['add_vaccine_type'])) {
  $conn = connect();
  $lotNumber=$_POST['lotNumber'];
  $type = $_POST['type'];
  $suspenedDate = $_POST['suspenedDate'];
  $approvedDate = $_POST['approvedDate'];
  $status = $_POST['status'];
  $sql = "INSERT INTO vaccin_status 
    VALUES ('$lotNumber','$type','$suspenedDate','$approvedDate','$status',0);";
   if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
   $conn->close();
  set_message("new vaccin information CREATED");
  //debug redirect("index.php?age_group");
  echo("<script>location.href = 'index.php?vaccine_type';</script>");
  exit();
}
}
function delete_vaccine_type(){
  if (isset($_GET['lotNumber'])) {
  $conn = connect();
  $lotNumber = $_GET['lotNumber'];
  echo $lotNumber;
  $sql = "UPDATE vaccin_status SET deleted_ = 1 WHERE lotNumber = '$lotNumber'";
    if (mysqli_query($conn, $sql)) {
      echo "Delete successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
   $conn->close();
  set_message("VACCINE DELETED");
  echo("<script>location.href = 'index.php?vaccine_type';</script>");

  exit();
  }
}
// province
function display_province($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $provinceName = $a;
  $query = "SELECT * FROM province Where province.provinceName = '$provinceName' AND province.deleted_ = 0;" ;
  if($result = $mysqli-> query($query)){
    while ($row = $result->fetch_assoc()){
      $provinceName = $row["provinceName"];
      $provStartDate = $row["provStartDate"];
      $vacAgeGroup = $row["vacAgeGroup"];
    
      
      $provincelist = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$provinceName}</td>
          <td row="cell">{$provStartDate}</td>
          <td row="cell">{$vacAgeGroup}</td>
          
         <td>
              <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_province&id=$provinceName'">Edit</button>
              <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_province&id=$provinceName'">Delete</button>
          </td> 
      </tr> 
      
      DELIMETER;
    
      echo $provincelist;
    }
    $result->free();
  }
}

function add_province(){
  if (isset($_POST['add_province'])) {
    $conn = connect();
    $query = "SELECT provinceName FROM province";
    $result = mysqli_query($conn,$query);
    //$rowcount =mysqli_num_rows($result);
    //$provinceName = ((int) $rowcount) + 1 ;
    //echo $provinceName;
    $provinceName = $_POST['provinceName'];
    $provStartDate = $_POST['provStartDate'];
    $vacAgeGroup = $_POST['vacAgeGroup'];

    $sql = "INSERT INTO province
      VALUES ('$provinceName','$provStartDate',$vacAgeGroup,0);";
   
   if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  $conn->close();
  set_message("PROVINCE CREATED");
  //redirect("index.php?province");
  echo("<script>location.href = 'index.php?province&id=$provinceName';</script>");
  exit();
}
}

//Infection Type
function display_infection_type($a){
  connect();
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $typeID = (int)$a;
  $query = "SELECT * FROM infection_type Where infection_type.typeID = $typeID; /*AND person.deleted_ = 0;*/" ;
  if($result = $mysqli-> query($query)){
    while ($row = $result->fetch_assoc()){
      $typeID = $row["typeID"];
      $virus_type = $row["virus_type"];

    
      
      $infection_typelist = <<<DELIMETER
      <tr role="row">
          <td row="cell">{$typeID}</td>
          <td row="cell">{$virus_type}</td>
         
          
         <td>
              <button type="button" class="btn btn-sm btn-dark" onclick ="window.location.href = 'index.php?edit_infection_type&id=$typeID'">Edit</button>
              <button type="button" class="btn btn-sm btn-danger" onclick ="window.location.href = 'index.php?delete_infection_type&id=$typeID'">Delete</button>
          </td> 
      </tr> 
      
      DELIMETER;
    
      echo $infection_typelist;
    }
    $result->free();
  }
}

function add_infection_type(){
  if (isset($_POST['add_infection_type'])) {
  $conn = connect();
  $query = "SELECT typeID FROM infection_type";
  $result = mysqli_query($conn,$query);
  $rowcount =mysqli_num_rows($result);
  $typeID = ((int) $rowcount);
  echo $typeID;
  $virus_type = $_POST['virus_type'];
 
  $sql = "INSERT INTO infection_type
    VALUES ($typeID,'$virus_type',0);";
  
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
   $conn->close();
  set_message("INFECTION TYPE CREATED");
  //redirect("index.php?infection_type");
  echo("<script>location.href = 'index.php?infection_type&id=$typeID';</script>");
  exit();
}
}
?>
