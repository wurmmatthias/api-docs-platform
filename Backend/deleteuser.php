<?php
session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login_page.php");  
}

$current_user = $_SESSION['user'];

include "connect.php";



if (isset($_POST['uid'])) {
  $uid = $_POST["uid"];
  $password = $_POST["password"];

  $sql_userinfo = "SELECT * FROM user WHERE username =' " . $current_user . "'";
  $result_userinfo = mysqli_query($conn, $sql_userinfo);
 
  if (mysqli_num_rows($result_userinfo) > 0) {
    while($row_post = mysqli_fetch_assoc($result_userinfo)) {
      if ($uid != $current_user) {
        header("Location: useraccount_page.php?msg=6");
      }
      else {
        $check_user = "SELECT * FROM user WHERE uid = '$uid'";
        $result = mysqli_query($conn, $check_user);
          
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $hashed_password = $row["password"];
    
              if(password_verify($password, $hashed_password)) {
                $deletuser = "DELETE FROM user WHERE uid = '$uid'";
                if (mysqli_query($conn, $deletuser)) {
                  echo "User deleted successfully";
                  header("Location: login.php"); #Ändern zu Register Page
                } else {
                  echo "Error deleting user: " . mysqli_error($conn);
                  header("Location: useraccount_page.php?msg=5");
                }
                
              } 
              
              else {
                  echo "Passwort Falsch";
                  header("Location: useraccount_page.php?msg=4");
              }
            }
          } 
          else {
              echo "Nutzer existiert nicht";
              header("Location: useraccount_page.php?msg=5");
          }
      }
    }
  } 
  else 
  {
    header("Location: useraccount_page.php?msg=5");
  }
 
  mysqli_close($conn);
}
?>