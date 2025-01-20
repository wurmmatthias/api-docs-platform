<?php
include "connect.php";

$pid = $_GET["pid"];
$name = $_GET["projectname"];
$description = $_GET["projectdescription"];

$edit = "UPDATE projekte SET name = '$name', description = '$description' WHERE pid = '$pid'";

if (mysqli_query($conn, $edit)) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
   

header("Location: admin_main.php")
?>