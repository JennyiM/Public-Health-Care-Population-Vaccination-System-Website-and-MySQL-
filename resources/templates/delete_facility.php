<?php
function delete_facility(){
    if (isset($_GET['id'])) {
    $conn = connect();
    $facilityID = (int)$_GET['id'];
    //echo $personID;
    $sql = "UPDATE facility SET deleted_ = 1 WHERE facilityID = '$facilityID'";
      if (mysqli_query($conn, $sql)) {
        echo "Delete successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
     $conn->close();
    set_message("FACILITY DELETED");
    //redirect("index.php?person");
    echo("<script>location.href = 'index.php?facility';</script>");
    exit();
    }
  }

delete_facility();

?>