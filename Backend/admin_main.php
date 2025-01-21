<?php 
session_start();
include "connect.php";
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
    <title>Dokumentation App - Admin</title>
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
      .navbar.right {
        float: right;
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

  <!-- <button class="btn btn-primary toggle-sidebar-btn" onclick="toggleSidebar()">Toggle Sidebar</button> -->
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class='row'>
          <div class='col-8'>
            <button type='button' class='btn shadow-none'><h5>Alle Projekte</h5></button>
          </div>
          <div class='col-2'>
          </div>
          <div class='col-2'>
            <button type="button" class="btn shadow-none" data-bs-toggle="modal" data-bs-target="#addproject">➕</button>
          </div>
      </div>
      <ul class="nav flex-column">


<?php 
echo "<div class='modal' id='addproject' tabindex='-1' role='dialog'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
        <div class='modal-header'>
            <h5 class='modal-title'>Projekt hinzufügen</h5>
        </div>
        <div class='modal-body'>
            <form action='addproject.php' method='POST'>
              <div class='form-group'>
                <input type='text' id='author' name='author' value='". $current_user ."' hidden>
                <input type='text' class='form-control' id='projectname' name='projectname' placeholder='Projektname'>
                <br>
                 <textarea class='form-control' id='projectdescription' name='projectdescription' rows='15' placeholder='Projektbeschreibung'></textarea><br><br>
              </div>
        </div>
        <div class='modal-footer'>
            <button type='submit' class='btn btn-primary'>Submit</button>
            </form>
            <a href='admin_main.php' class='btn btn-secondary'>Close</a>
        </div>
    </div>
  </div>
</div>";

        $sql_projects = "SELECT * FROM projekte";
        $result_projects = mysqli_query($conn, $sql_projects);
        
        if (mysqli_num_rows($result_projects) > 0) {
          // output data of each row
          while($row_project = mysqli_fetch_assoc($result_projects)) {

            echo "<li class='nav-item'>";
            echo "<div class='container'>
                    <div class='row'>
                        <div class='col-8'>
                            <a class='nav-link' href='admin_main.php?project=" . $row_project["pid"] . "'>" . $row_project["name"] . "</a>
                        </div>
                        <div class='col-2'>
                            <button type='button' class='btn shadow-none' data-bs-toggle='modal' data-bs-target='#edit" . $row_project["pid"] . "'>✏️</button>
                        </div>
                        <div class='col-2'>
                            <button type='button'  class='btn shadow-none' data-bs-toggle='modal' data-bs-target='#delete" . $row_project["pid"] . "'>🗑️</button>
                        </div>
                    </div>
                </div>";
            echo "</li>";

            echo "<div class='modal' id='edit" . $row_project["pid"] . "' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Projektnamen ändern</h5>
                    </div>
                    <div class='modal-body'>
                        <form action='editproject.php' method='GET'>
                          <div class='form-group'>
                            <input type='text' id='pid' name='pid' value='".$row_project["pid"] ."' hidden>
                            <input type='text' id='author' name='author' value='". $current_user ."' hidden>
                            <input type='text' class='form-control' id='projectname' name='projectname' value='" . $row_project["name"] . "'>
                            <textarea class='form-control' id='projectdescription' name='projectdescription' rows='15' placeholder='Projektbeschreibung'>" . $row_project["description"] . "</textarea><br><br>
                          </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-primary'>Submit</button>
                        </form>
                        <a href='admin_main.php' class='btn btn-secondary'>Close</a>
                    </div>
                </div>
            </div>
        </div>";

        echo "<div class='modal' id='delete" . $row_project["pid"] . "' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Projekt Löschen?</h5>
                    </div>
                    <div class='modal-body'>
                        <p>Bist du sicher, dass du dieses Projekt endgültig löschen möchtest?</p>
                    </div>
                    <div class='modal-footer'>
                        <a href='deleteproject.php?pid=" . $row_project["pid"] . "' class='btn btn-danger'>Delete</a>
                        <a href='admin_main.php' class='btn btn-secondary'>Close</a>
                    </div>
                </div>
            </div>
        </div>";

          }
        } 
        else {
          echo "";
        }
        
        ?>
      </ul>
    </div>

    <!-- Main content area -->
    <div class="container-fluid p-4">

    <div class="row">
        <div class="col-6">

<?php 

if ($pid == "") {
    echo "<h2>Bitte wähle ein Projekt aus der linken Spalte!</h2><br>";
    echo "Hier kannst du die Posts bearbeiten. Bitte wähle zunächst das Projekt, in dem sich der Post befindet.";
    echo "<br><br>";
}
else {
    $sql_postinfo = "SELECT * FROM posts WHERE to_pid = " . $pid . "";
    $result_postsinfo = mysqli_query($conn, $sql_postinfo);

    $sql_projekt = "SELECT * FROM projekte WHERE pid = " . $pid . "";
    $result_projekt = mysqli_query($conn, $sql_projekt);
    $projekt = mysqli_fetch_assoc($result_projekt);

    echo "<h1>" . $projekt["name"] ."</h1>";
    echo "<p class='text-secondary'>by ".  $projekt["author"]  ."</p>";
    echo "<h5>" . $projekt["description"] ."</h1><br>";
    echo "<a href='addpost_page.php?topid=" . $pid . "' class='btn btn-success'>Add Post</a>";
    echo "<br><br><br>";

    if (mysqli_num_rows($result_postsinfo) > 0) {
    // output data of each row
    while($row_post = mysqli_fetch_assoc($result_postsinfo)) {
       
        echo "<h2><a href='editpost_page.php?poid=" . $row_post["poid"] . "'>".  $row_post["name"]  ."</a></h2>";
        echo "<p class='text-secondary'>by ".  $row_post["author"]  ."</p>";
        echo $row_post["content"];
        echo "<br><br>";
    }
    } 
    else {
        echo "Diese Dokumentation ist leider leer....";
    }

    mysqli_close($conn);
}
?>


        </div>
        <div class="col-4">
        
        </div>
    </div>

    </div>

  </div>

  <!-- Footer -->
  <footer class="footer">
    <p><b>&copy; 2025. Alle Rechte vorbehalten.</b></p>
  </footer>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('collapsed');
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
