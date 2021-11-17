<?php 

function delete_public_worker(){
  if (isset($_GET['SSN'])) {
  $conn = connect();
  $SSN = (int)$_GET['SSN'];
  echo $SSN;
  $sql = "UPDATE public_worker SET deleted_ = 1 WHERE SSN = '$SSN'";
    if (mysqli_query($conn, $sql)) {
      echo "Delete successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  $conn->close();
  set_message("Public Worker DELETED");
  echo("<script>location.href = 'index.php?public_worker';</script>");
  exit();
  }
}

delete_public_worker();

?>