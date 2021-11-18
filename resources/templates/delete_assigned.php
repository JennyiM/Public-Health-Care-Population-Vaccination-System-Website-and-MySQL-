<?php 

function delete_assigned(){
  if (isset($_GET['SSN'])) {
  $conn = connect();
  $SSN = (int)$_GET['SSN'];
  $employee_ID = (int)$_GET['employee_ID'];
  $facilityID = (int)$_GET['facilityID'];
  echo $SSN;
  $sql = "UPDATE assigned SET deleted_ = 1 WHERE SSN = '$SSN' AND employee_ID = $employee_ID AND facilityID = $facilityID;";
    if (mysqli_query($conn, $sql)) {
      echo "Delete successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  $conn->close();
  set_message("assigned DELETED");
  echo("<script>location.href = 'index.php?assigned';</script>");
  exit();
  }
}

delete_assigned();

?>