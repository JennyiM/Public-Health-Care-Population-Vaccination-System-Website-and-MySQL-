<?php
function delete_infection_type(){
    if (isset($_GET['id'])) {
    $conn = connect();
    $typeID = (int)$_GET['id'];
    //echo $personID;
    $sql = "UPDATE infection_type SET deleted_ = 1 WHERE infection_type.typeID = $typeID;";
      if (mysqli_query($conn, $sql)) {
        echo "Delete successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
     $conn->close();
    set_message("Infection Type DELETED");
    //redirect("index.php?person");
    echo("<script>location.href = 'index.php?infection_type';</script>");
    exit();
    }
  }

delete_infection_type();

?>