<?php
session_start();
include "connect.php";

$uid = $_POST["uid"];
$oldpassword = $_POST["oldpassword"];
$newpassword1 = $_POST["newpassword1"];
$newpassword2 = $_POST["newpassword2"];

if ($newpassword1 == $newpassword2) {
  $newpassword = $newpassword1;
}
else {
  echo "Passwords dont Match";
  header("Location: useraccount_page.php?msg=1");
}

if (isset($_POST['uid'])) {
  
  $check_user = "SELECT * FROM user WHERE uid = '$uid'";
  $result = mysqli_query($conn, $check_user);
      
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
          $hashed_password = $row["password"];

          if(password_verify($oldpassword, $hashed_password)) {
            $newpassword_hashed = password_hash($newpassword, PASSWORD_DEFAULT);
            $edit = "UPDATE user SET password = '$newpassword_hashed' WHERE uid = '$uid'";
            if (mysqli_query($conn, $edit)) {
              echo "Password updated successfully";
              header("Location: logout.php");
            } 
            else {
              echo "Error updating password: " . mysqli_error($conn);
              header("Location: useraccount_page.php?msg=3");
            }
          } 
          else {
              echo "Old Password wrong!";
              header("Location: useraccount_page.php?msg=2");
          }
      }
      } 
      else {
          echo "General Error";
          header("Location: useraccount_page.php?msg=3");
      }
  
}
?>