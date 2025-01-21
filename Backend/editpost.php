<?php
include "connect.php";

$poid = $_POST["poid"];
$pid = $_POST["pid"];
$name = $_POST["postname"];
$content = $_POST["postcontent"];
$author = $_POST["author"];

$edit = "UPDATE posts SET name = '$name', content = '$content', author = '$author' WHERE poid = '$poid'";

if (mysqli_query($conn, $edit)) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
   

header("Location: admin_main.php?project=". $pid ."")
?>