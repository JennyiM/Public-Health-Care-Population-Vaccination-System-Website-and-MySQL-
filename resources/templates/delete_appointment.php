<?php
function delete_appointment(){
    if (isset($_GET['id']) AND isset($_GET['dose'])) {
    $conn = connect();
    $personID = $_GET['id'];
    $dosenum = $_GET['dose'];
    echo $personID;
    $sql = "UPDATE appointment SET deleted_ = 1 WHERE personID = $personID AND doseNumber = $dosenum;";
      if (mysqli_query($conn, $sql)) {
        echo "Delete successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
     $conn->close();
    set_message("APPOINTMENT DELETED");
    //redirect("index.php?person");
    echo("<script>location.href = 'index.php?appointment';</script>");
    exit();
    }
  }

delete_appointment();

?>