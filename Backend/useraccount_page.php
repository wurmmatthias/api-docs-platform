<?php 
session_start();
include "connect.php";
if (isset($_GET["msg"])) {
  $msg = $_GET["msg"];
}
else {
  $msg = "";
}
?>

<?php if ($msg == 4 || $msg == 5 || $msg == 6): ?>
    <script>
      var modal = new bootstrap.Modal(document.getElementById('delete'));
      modal.show();
    </script>
  <?php endif; ?>

<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokumentation App - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
      }
      .main-content {
        flex: 1;
        display: flex;
      }
      .sidebar {
        width: 300px;
        background-color: #f8f9fa;
        padding: 20px;
        transition: transform 0.3s ease;
      }
      .sidebar.collapsed {
        transform: translateX(-100%);
      }
      .footer {
        background-color: rgb(54, 204, 117);
        color: white;
        text-align: center;
        padding: 10px;
      }
      .toggle-sidebar-btn {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1000;
      }
    </style>
  </head>
  <body>

  <?php
  if(!isset($_SESSION['user']))
  {
      header("Location: login_page.php");  
  }

  $current_user = $_SESSION['user'];
  ?>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg" data-bs-theme="dark" style="background-color:rgb(54, 204, 117);">
    <div class="container-fluid">
      <a class="navbar-brand" href="admin_main.php"><b>Admin Area</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admin_main.php">Edit Projects</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admin_main.php">Styling</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="useraccount_page.php">User Account</a>
          </li>
        </ul>
      </div>
      <nav class="navbar-right">
        <a href='logout.php' style="font-size:26px" class='fa fa-sign-out btn shadow-none'></a>
      </nav>
    </div>
  </nav>

  <!-- Main content -->
  <div class="main-content">


    <!-- Main content area -->
    <div class="container-fluid p-4 w-50">



<?php 
 $sql_userinfo = "SELECT * FROM user WHERE username = '" . $current_user . "'";
 $result_userinfo = mysqli_query($conn, $sql_userinfo);

 if (mysqli_num_rows($result_userinfo) > 0) {
 // output data of each row
 while($row_user = mysqli_fetch_assoc($result_userinfo)) {
    
    echo "
    <h1>Edit your profile</h1>
    <br>
    <form action='edituser.php' method='POST'>
        <div class='form-group'>
            <input type='text' id='uid' name='uid' value='".$row_user["uid"] ."' hidden>
            <input type='text' class='form-control' id='firstname' name='firstname' placeholder='Firstname' value='" . $row_user["firstname"] . "'><br>
            <input type='text' class='form-control' id='lastname' name='lastname' placeholder='Lastname' value='" . $row_user["lastname"] . "'><br>
        </div>
        <button type='submit' class='btn btn-primary w-100'>Edit</button><br><br><br><br>
    </form>";

    echo "<form action='changepassword.php' method='POST'>
      <div class='form-group'>
        <input type='text' id='uid' name='uid' value='".$row_user["uid"] ."' hidden>
        <input type='password' class='form-control' id='oldpassword' name='oldpassword' placeholder='Old Password'><br>
        <input type='password' class='form-control' id='newpassword1' name='newpassword1' placeholder='New Password'><br>
        <input type='password' class='form-control' id='newpassword2' name='newpassword2' placeholder='Retype new Password'><br>
      </div>
        <button type='submit' class='btn btn-primary w-100'>Change Password</button><br><br>
    </form>";
    if ($msg == 2) {echo "<p class='text-danger'>Old Password was wrong. Password not changed!</p>";}
    else if ($msg == 1) {echo "<p class='text-danger'>New passwords dont match. Password not changed!</p>";}
    else if ($msg == 3) {echo "<p class='text-danger'>Error in Database. Password not changed!</p>";}
    echo "<button type='button'  class='btn btn-danger w-100' data-bs-toggle='modal' data-bs-target='#delete'>Delete User</button>";

    echo "<div class='modal' id='delete' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                   <div class='modal-header'>
                        <h5 class='modal-title'>User löschen?</h5>
                    </div>
                    <div class='modal-body'>
                        <form action='deleteuser.php' method='POST'>
                          <div class='form-group'>
                            <a>Bist du dir sicher, dass du deinen Account endgültig löschen willst?</a><br><br>
                            <input type='text' id='uid' name='uid' value='" . $row_user["uid"] . "' hidden>
                            <input type='password' class='form-control' id='password' name='password' placeholder='Confirm with Password'>";
                            if ($msg == 4) {echo "<p class='text-danger'>Password was wrong. User not deleted!</p>";}
                            else if ($msg == 5) {echo "<p class='text-danger'>Error in Database. User not deleted!</p>";}
                            else if ($msg == 6) {echo "<p class='text-danger'>Dont even try to...</p>";}
                          echo "</div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-danger'>Delete</button>
                        </form>
                        <a href='useraccount_page.php' class='btn btn-secondary'>Close</a>
                    </div>
                </div>
            </div>
        </div>";
 }
 } 
 else {
     echo "General Error";
 }

 mysqli_close($conn);
?>




    </div>

  </div>

  <!-- Footer -->
  <footer class="footer">
    <p><b>&copy; 2025. Alle Rechte vorbehalten.</b></p>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
