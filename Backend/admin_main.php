<?php 
session_start();
include "connect.php";
include "./locale/language_config.php";

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
    <link rel="icon" type="image/x-icon" href="./src/img/favicon.ico">
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
      img {
        max-width: 600px;
        height: auto;
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
        <?php if ($pid != "") {echo "<a class='nav-link active' href='../frontend/docs/index.php?doku=".$pid."'>".  __("to_frontend", $language) . "</a>";}?>
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
            <button type='button' class='btn shadow-none'><?php echo "<h5>" .  __("all_projects", $language) . "</h5>";?></button>
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
            <h5 class='modal-title'>".  __("add_project?", $language) ."</h5>
        </div>
        <div class='modal-body'>
            <form action='addproject.php' method='POST'>
              <div class='form-group'>
                <input type='text' id='author' name='author' value='". $current_user ."' hidden>
                <input type='text' class='form-control' id='projectname' name='projectname' placeholder=".  __("projectname", $language) .">
                <br>
                 <textarea class='form-control' id='projectdescription' name='projectdescription' rows='15' placeholder=".  __("projectdescription", $language) ."></textarea><br><br>
              </div>
        </div>
        <div class='modal-footer'>
            <button type='submit' class='btn btn-primary'>".  __("submit", $language) ."</button>
            </form>
            <a href='admin_main.php' class='btn btn-secondary'>".  __("close", $language) ."</a>
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
                        <h5 class='modal-title'>".  __("edit_project_name", $language) ."</h5>
                    </div>
                    <div class='modal-body'>
                        <form action='editproject.php' method='GET'>
                          <div class='form-group'>
                            <input type='text' id='pid' name='pid' value='".$row_project["pid"] ."' hidden>
                            <input type='text' id='author' name='author' value='". $current_user ."' hidden>
                            <input type='text' class='form-control' id='projectname' name='projectname' placeholder='".  __("projectname", $language) ."' value='" . $row_project["name"] . "'>
                            <textarea class='form-control' id='projectdescription' name='projectdescription' rows='15' placeholder='".  __("projectdescription", $language) ."'>" . $row_project["description"] . "</textarea><br><br>
                          </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-primary'>".  __("submit", $language) ."</button>
                        </form>
                        <a href='admin_main.php' class='btn btn-secondary'>".  __("close", $language) ."</a>
                    </div>
                </div>
            </div>
        </div>";

        echo "<div class='modal' id='delete" . $row_project["pid"] . "' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>".  __("delete_project?", $language) ."</h5>
                    </div>
                    <div class='modal-body'>
                        <p>".  __("delete_project_description", $language) ."</p>
                    </div>
                    <div class='modal-footer'>
                        <a href='deleteproject.php?pid=" . $row_project["pid"] . "' class='btn btn-danger'>".  __("delete", $language) ."</a>
                        <a href='admin_main.php' class='btn btn-secondary'>".  __("close", $language) ."</a>
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
    echo "<h2>" .  __("no_project_title", $language) . "</h2><br>";
    echo "" . __("no_project_description", $language) . "";
    echo "<br><br>";
}
else {
    $sql_postinfo = "SELECT * FROM posts WHERE to_pid = " . $pid . "";
    $result_postsinfo = mysqli_query($conn, $sql_postinfo);

    $sql_projekt = "SELECT * FROM projekte WHERE pid = " . $pid . "";
    $result_projekt = mysqli_query($conn, $sql_projekt);
    $projekt = mysqli_fetch_assoc($result_projekt);

    echo "<h1>" . $projekt["name"] ."</h1>";
    echo "<p class='text-secondary'>".  __("docs of", $language) ." ".  $projekt["author"]  ."</p>";
    echo "<h5>" . $projekt["description"] ."</h1><br>";
    echo "<a href='addpost_page.php?topid=" . $pid . "' class='btn btn-success'>" . __("add_post", $language) . "</a>";
    echo "<br><br><br>";

    if (mysqli_num_rows($result_postsinfo) > 0) {
    // output data of each row
    while($row_post = mysqli_fetch_assoc($result_postsinfo)) {
       
        echo "<h2><a href='editpost_page.php?poid=" . $row_post["poid"] . "'>".  $row_post["name"]  ."</a></h2>";
        echo "<p class='text-secondary'>".  __("docs of", $language) ." ".  $row_post["author"]  ."</p>";
        echo jsonToHtml($row_post["content"]);
        echo "<br><br>";
    }
    } 
    else {
        echo __("documentation_empty", $language);
    }

    mysqli_close($conn);
}

function jsonToHtml($json) {
  $data = json_decode($json, true);
  $html = '';

  foreach ($data['blocks'] as $block) {
    switch ($block['type']) {
        case 'header':
            $html .= '<h' . $block['data']['level'] . '>' . htmlspecialchars($block['data']['text']) . '</h' . $block['data']['level'] . '>';
            break;

        case 'image':
            $html .= '<img src="' . htmlspecialchars($block['data']['file']['url']) . '" alt="' . htmlspecialchars($block['data']['caption']) . '"';
            if ($block['data']['withBorder']) {
                $html .= ' style="border: 1px solid #000;"';
            }
            if ($block['data']['withBackground']) {
                $html .= ' style="background-color: #f0f0f0;"';
            }
            if ($block['data']['stretched']) {
                $html .= ' style="width: 100%;"';
            }
            $html .= ' />';
            break;

        case 'paragraph':
            $text = $block['data']['text'];
            $html .= '<p>' . $text . '</p>';
            break;

        case 'code':
            $text = $block['data']['text'];
            $text = preg_replace_callback('/@@(.*?)@@/', function ($matches) {
                return '<code>' . htmlspecialchars($matches[1]) . '</code>';
            }, $text);
  
            $html .= '<p>' . $text . '</p>';
            break;

        case 'raw':
          $text = $block['data']['html'];
          $html =  $text;
          break;

        case 'table':
            $rows = $block['data']['content'];
            $withHeadings = $block['data']['withHeadings'] ?? false; // Standardmäßig false, falls nicht gesetzt
            
            $html .= '<table border="1" cellspacing="0" cellpadding="5">';
            foreach ($rows as $rowIndex => $row) {
                $html .= '<tr>';
                foreach ($row as $cellIndex => $cell) {
                    if ($withHeadings && $rowIndex === 0) {
                        // Erste Zeile als Header, wenn withHeadings true ist
                        $html .= '<th>' . htmlspecialchars($cell) . '</th>';
                    } else {
                        // Alle anderen Zellen als normale Tabellenzellen
                        $html .= '<td>' . htmlspecialchars($cell) . '</td>';
                    }
                }
                $html .= '</tr>';
            }
            $html .= '</table>';
            break;
    }
  }

  return $html;
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
