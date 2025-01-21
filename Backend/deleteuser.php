<?php
session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login_page.php");  
}

$current_user = $_SESSION['user'];
include "connect.php";


if (isset($_POST['uid'])) {
  $uid = $_POST['uid'];
  $password = $_POST['password'];

  $sql_userinfo = "SELECT * FROM user WHERE username = '$current_user'";
  $result_userinfo = mysqli_query($conn, $sql_userinfo);

  if (mysqli_num_rows($result_userinfo) > 0) {
      $row_user = mysqli_fetch_assoc($result_userinfo);


      if ($row_user["uid"] != $uid) {
          echo "UID != User";
          header("Location: useraccount_page.php?msg=6");
          exit;
      }

      $check_user = "SELECT * FROM user WHERE uid = '$uid'";
      $result = mysqli_query($conn, $check_user);

      if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $hashed_password = $row["password"];

          if (password_verify($password, $hashed_password)) {
              $delete_user = "DELETE FROM user WHERE uid = '$uid'";
              if (mysqli_query($conn, $delete_user)) {
                  echo "User deleted successfully";
                  header("Location: adduser_page.php");
                  exit;
              } 
              else {
                  echo "Error deleting user: " . mysqli_error($conn);
                  header("Location: useraccount_page.php?msg=5");
                  exit;
              }
          } 
          else {
              echo "Passwort falsch";
              header("Location: useraccount_page.php?msg=4");
              exit;
          }
      } 
      else {
          echo "Nutzer existiert nicht";
          header("Location: useraccount_page.php?msg=5");
          exit;
      }
  } 
  else {
      echo "Aktueller Benutzer existiert nicht";
      header("Location: useraccount_page.php?msg=5");
      exit;
  }
} 
else {
  echo "Keine UID übergeben";
  header("Location: useraccount_page.php?msg=5");
  exit;
}

?>