<?php 
session_start();
include "connect.php";
$poid = $_GET['poid'];
?>

<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentation App - Admin</title>
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
    <div class="container-fluid p-4">



<?php 
 $sql_postinfo = "SELECT * FROM posts WHERE poid = " . $poid . "";
 $result_postsinfo = mysqli_query($conn, $sql_postinfo);

 if (mysqli_num_rows($result_postsinfo) > 0) {
 // output data of each row
 while($row_post = mysqli_fetch_assoc($result_postsinfo)) {
    
    echo "
    <form action='editpost.php' method='POST'>
        <div class='form-group'>
            <input type='text' id='pid' name='pid' value='".$row_post["to_pid"] ."' hidden>
            <input type='text' id='poid' name='poid' value='".$row_post["poid"] ."' hidden>
            <input type='text' id='author' name='author' value='". $current_user ."' hidden>
            <input type='text' class='form-control' id='postname' name='postname' placeholder='Post Title' value='" . $row_post["name"] . "'><br>
            <textarea class='form-control' id='postcontent' name='postcontent' placeholder='Post Content' rows='15'>" . $row_post["content"] . "</textarea><br><br>
        </div>
        <button type='submit' class='btn btn-primary w-100'>Edit</button>
    </form>
    <br>
    <button type='button' class='btn btn-danger w-100' data-bs-toggle='modal' data-bs-target='#delete" . $row_post["poid"] . "'>Delete</button>";

    echo "<div class='modal' id='delete" . $row_post["poid"] . "' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Delete Post?</h5>
                    </div>
                    <div class='modal-body'>
                        <p>Are you sure that you want to delete your Post?</p>
                    </div>
                    <div class='modal-footer'>
                        <a href='deletepost.php?poid=" . $row_post["poid"] . "&topid=" .  $row_post["to_pid"] . "' class='btn btn-danger'>Delete</a>
                        <a href='editpost_page.php?poid=" . $row_post["poid"] . "' class='btn btn-secondary'>Close</a>
                    </div>
                </div>
            </div>
        </div>";
 }
 } 
 else {
     echo "This Documentation is empty...";
 }

 mysqli_close($conn);
?>




    </div>

  </div>

  <!-- Footer -->
  <footer class="footer">
    <p><b>&copy; 2025. All rights reserved.</b></p>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
