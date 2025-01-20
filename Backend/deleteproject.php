<?php
include "connect.php";
$pid = $_GET["pid"];

$deleteproject = "DELETE FROM projekte WHERE pid = '$pid'";
$delete_entrys = "DELETE FROM posts WHERE to_pid = '$pid'";

if (mysqli_query($conn, $deleteproject)) {
    echo "Record updated successfully";
    if (mysqli_query($conn, $delete_entrys)) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
   

header("Location: admin_main.php")
?>