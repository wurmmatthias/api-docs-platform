<?php
session_start();
include "connect.php";
$poid = $_GET["poid"];
$topid = $_GET["topid"];

$deletepost = "DELETE FROM posts WHERE poid = '$poid'";

if (mysqli_query($conn, $deletepost)) {
    echo "Post deleted successfully";
  } else {
    echo "Error deleting post: " . mysqli_error($conn);
  }
  
header("Location: admin_main.php?project=" . $topid . "")
?>