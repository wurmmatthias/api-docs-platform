<?php
session_start();
include "connect.php";

$pid = $_GET["pid"];
$name = $_GET["projectname"];
$description = $_GET["projectdescription"];
$author = $_GET["author"];;

$edit = "UPDATE projekte SET name = '$name', description = '$description', author = '$author' WHERE pid = '$pid'";

if (mysqli_query($conn, $edit)) {
    echo "Project updated successfully";
  } else {
    echo "Error updating project: " . mysqli_error($conn);
  }
   

header("Location: admin_main.php")
?>