<?php
session_start();
include "connect.php";

$uid = $_POST["uid"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];

$edit = "UPDATE user SET firstname = '$firstname', lastname = '$lastname' WHERE uid = '$uid'";

if (mysqli_query($conn, $edit)) {
    echo "User updated successfully";
  } else {
    echo "Error updating User: " . mysqli_error($conn);
  }
   

header("Location: useraccount_page.php")
?>