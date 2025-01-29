<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user']))
{
    header("Location: login_page.php");  
}

$current_user = $_SESSION['user'];

$sql_user = "SELECT * FROM user WHERE username = '$current_user'";
$result_user = mysqli_query($conn, $sql_user);
$user = mysqli_fetch_assoc($result_user);


if ($user["lang"] == 'de') {
    $edit = "UPDATE user SET lang = 'en' WHERE username = '$current_user'";
}

else if ($user["lang"] == 'en') {
    $edit = "UPDATE user SET lang = 'de' WHERE username = '$current_user'";
}

else if ($user["lang"] == '') {
    $edit = "UPDATE user SET lang = 'en' WHERE username = '$current_user'";
}


if (mysqli_query($conn, $edit)) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
   

header("Location: admin_main.php")
?>