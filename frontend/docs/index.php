<?php 
include "../../Backend/connect.php";
include "../locale/language_config.php";

$projekt = $_GET["doku"];

$sql_projectinfo = "SELECT * FROM projekte WHERE pid =" . $projekt . "";
$result_projectinfo = mysqli_query($conn, $sql_projectinfo);
$row = $result_projectinfo->fetch_assoc();

$sql_postinfo = "SELECT * FROM posts WHERE to_pid = " . $projekt . "";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $row["name"]; ?> - <?php echo __("title", $language); ?></title>
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
        width: 250px;
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
      <a class="navbar-brand" href="#"><b>Doku App</b> - <?php echo $row["name"]; ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Startseite</a>
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
      <h5><?php echo __("toc", $language); ?></h5>
      <ul class="nav flex-column">
        <?php 
        
        $result_postsinfo = mysqli_query($conn, $sql_postinfo);
        
        if (mysqli_num_rows($result_postsinfo) > 0) {
          // output data of each row
          while($row_post = mysqli_fetch_assoc($result_postsinfo)) {

            echo "<li class='nav-item'>";
            echo "<a class='nav-link' href='#'>" . $row_post["name"] . "</a>";
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

$result_postsinfo = mysqli_query($conn, $sql_postinfo);


if (mysqli_num_rows($result_postsinfo) > 0) {
  // output data of each row
  while($row_post = mysqli_fetch_assoc($result_postsinfo)) {
    echo "<h1>" . $row_post["name"] ."</h1><br>";
    echo $row_post["content"];
    echo "<br><br>";
  }
} else {
  echo "Diese Dokumentation ist leider leer....";
}

mysqli_close($conn);
?>


        </div>
        <div class="col-4">
        
        </div>
    </div>

    </div>

  </div>

  <!-- Footer -->
  <footer class="footer">
    <p><b><?php echo __("docs of", $language); ?> <?php echo $row["author"]; ?></b></p>
    <p><b><?php echo __("copyright", $language); ?></b></p>
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
