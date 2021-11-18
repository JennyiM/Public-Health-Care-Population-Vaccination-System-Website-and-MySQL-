<?php
function delete_province(){
    if (isset($_GET['id'])) {
    $conn = connect();
    $provinceName = $_GET['id'];
    //echo $personID;
    $sql = "UPDATE province SET deleted_ = 1 WHERE province.provinceName = '$provinceName';";
      if (mysqli_query($conn, $sql)) {
        echo "Delete successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
     $conn->close();
    set_message("Province DELETED");
    //redirect("index.php?person");
    echo("<script>location.href = 'index.php?province';</script>");
    exit();
    }
  }

delete_province();

?>