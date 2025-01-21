<?php 
session_start();
include "connect.php";
$topid = $_GET['topid'];
?>

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
            <a class="nav-link active" aria-current="page" href="admin_main.php">Posts bearbeiten</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main content -->
  <div class="main-content">


    <!-- Main content area -->
    <div class="container-fluid p-4">



<?php 
    echo "
    <form action='addpost.php' method='POST'>
        <div class='form-group'>
            <input type='text' id='author' name='author' value='". $current_user ."' hidden>
            <input type='text' id='topid' name='topid' value='" . $topid ."' hidden>
            <input type='text' class='form-control' id='postname' name='postname' placeholder = 'Post Title'><br>
            <textarea class='form-control' id='postcontent' name='postcontent' rows='15' placeholder = 'Post Content goes here'></textarea><br><br>
        </div>
        <button type='submit' class='btn btn-primary w-100'>Add</button>
    </form>";
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
