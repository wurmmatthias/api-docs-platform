<?php 
session_start();
include "connect.php";
include "./locale/language_config.php";

$sql_css = "SELECT * FROM custom_css WHERE cid = 1";
$result_css = mysqli_query($conn, $sql_css);
$row_css = $result_css->fetch_assoc();

if (isset($_GET['project'])) {
    $pid = $_GET['project'];
}
else {
    $pid = "";
}
?>

<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentation App - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        width: 400px;
        background-color: #f8f9fa;
        padding: 20px;
        transition: transform 0.3s ease;
      }
      .navbar-right {
        display: flex;
        align-items: center;
        gap: 10px; /* Abstand zwischen den Links */
      }
      .navbar-right a {
        text-decoration: none;
        color: inherit;
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
      #editor {
      width: 100%;
      height: 400px;
    }
    </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.11.2/ace.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
      <a class="navbar-brand" href="admin_main.php"><b><?php echo __("admin_heading", $language); ?></b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admin_main.php"><?php echo __("edit_projects_heading", $language); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admin_style_settings.php"><?php echo __("styling_heading", $language); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="useraccount_page.php"><?php echo __("user_account_heading", $language); ?></a>
          </li>
        </ul>
      </div>
      <nav class="navbar-right">
        <?php echo "<a class='nav-link active' href='userLang.php'>".  __("language", $language) . "</a>";?>
        <a href='logout.php' style="font-size:26px" class='fa fa-sign-out btn shadow-none'></a>
      </nav>
    </div>
  </nav>

  <!-- Main content -->
  <div class="main-content">

  <!-- <button class="btn btn-primary toggle-sidebar-btn" onclick="toggleSidebar()">Toggle Sidebar</button> -->
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class='row'>
          <div class='col-8'>
            <button type='button' class='btn shadow-none'><?php echo "<h5>" .  __("custom_css_sidebar_title", $language) . "</h5>";?></button>
          </div>
          <div class='col-2'>
          </div>
      </div>
      <ul class="nav flex-column">
        <li>
          <a href="#" class="btn btn-success btn-lg w-100 mb-1">Speichern 💾</a>
        </li>

        <li>
          <a href="#" class="btn btn-danger btn-lg w-100 mb-1">Änderungen verwerfen ❌</a>
        </li>
      </ul>
    </div>

    <!-- Main content area -->
    <div class="container-fluid p-4">

    <div class="row">
        <div class="col-6">

<?php 
    echo "<h2>" .  __('custom_css_title', $language) . "</h2><br>";
    echo "" . __("custom_css_desc", $language) . "";
    echo "<br><br>";

?>

<div id="editor"><?php echo $row_css["css"]; ?>
</div>

        </div>
        <div class="col-4">
        
        </div>
    </div>

    </div>

  </div>

  <!-- Footer -->
  <footer class="footer">
    <p><b><?php echo __("copyright", $language); ?></b></p>
  </footer>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('collapsed');
    }

    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/css");
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
