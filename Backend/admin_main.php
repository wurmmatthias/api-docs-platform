<?php 
include "connect.php";
if (isset($_GET['project'])) {
    $pid = $_GET['project'];
}
else {
    $pid = "";
}
?>

<!doctype html>
<html lang="en">
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

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg" data-bs-theme="dark" style="background-color:rgb(54, 204, 117);">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><b>Admin Area</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admin_main.php">Posts bearbeiten</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown link
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main content -->
  <div class="main-content">

  <!-- <button class="btn btn-primary toggle-sidebar-btn" onclick="toggleSidebar()">Toggle Sidebar</button> -->
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <h5>Alle Projekte</h5>
      <ul class="nav flex-column">
        <?php 

        $sql_projects = "SELECT * FROM projekte";
        $result_projects = mysqli_query($conn, $sql_projects);
        
        if (mysqli_num_rows($result_projects) > 0) {
          // output data of each row
          while($row_project = mysqli_fetch_assoc($result_projects)) {

            echo "<li class='nav-item'>";
            echo "
                <div class='row'>
                    <div class='col-8'>
                        <a class='nav-link' href='admin_main.php?project=" . $row_project["pid"] . "'>" . $row_project["name"] . "</a>
                    </div>
                    <div class='col-2'>
                        <a class='nav-link' href='admin_main.php?project=" . $row_project["pid"] . "'>✏️</a>
                    </div>
                    <div class='col-2'>
                        <a class='nav-link' href='admin_main.php?project=" . $row_project["pid"] . "'>🗑️</a>
                    </div>
                </div>";
            echo "</li>";

          }
        } else {
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
    echo "<h1>Bitte wähle ein Projekt aus der linken Spalte!</h1><br>";
    echo "Hier kannst du die Posts bearbeiten. Bitte wähle zunächst das Projekt, in dem sich der Post befindet.";
    echo "<br><br>";
}
else {
    $sql_postinfo = "SELECT * FROM posts WHERE to_pid = " . $pid . "";
    $result_postsinfo = mysqli_query($conn, $sql_postinfo);


    if (mysqli_num_rows($result_postsinfo) > 0) {
    // output data of each row
    while($row_post = mysqli_fetch_assoc($result_postsinfo)) {
        echo "<h1>" . $row_post["name"] ."</h1><br>";
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
