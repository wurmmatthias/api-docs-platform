<?php 
session_start();
include "connect.php";
include "../Frontend/locale/language_config.php";
$poid = $_GET['poid'];
?>

<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentation App - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
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
            <a class="nav-link active" aria-current="page" href="admin_main.php"><?php echo __("styling_heading", $language); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="useraccount_page.php"><?php echo __("user_account_heading", $language); ?></a>
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
  $content = $row_post["content"];
    
    echo "
    <form action='editpost.php' method='POST' onsubmit='return submitEditorContent()'>
        <div class='form-group'>
            <input type='text' id='pid' name='pid' value='".$row_post["to_pid"] ."' hidden>
            <input type='text' id='poid' name='poid' value='".$row_post["poid"] ."' hidden>
            <input type='text' id='author' name='author' value='". $current_user ."' hidden>
            <input type='text' class='form-control' id='postname' name='postname' placeholder='".  __("postname", $language) ."' value='" . $row_post["name"] . "'><br>
            <input type='hidden' id='postcontent_hidden' name='postcontent'>
            
            <div id='editorjs'></div> <!-- Editor.js-Container -->
        </div>
        <button type='submit' class='btn btn-primary w-100'>".  __("edit", $language) ."</button>
    </form>
    <br>
    <button type='button' class='btn btn-danger w-100' data-bs-toggle='modal' data-bs-target='#delete" . $row_post["poid"] . "'>".  __("delete", $language) ."</button>";

    echo "<div class='modal' id='delete" . $row_post["poid"] . "' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>".  __("delete_post?", $language) ."</h5>
                    </div>
                    <div class='modal-body'>
                        <p>".  __("delete_post_description", $language) ."</p>
                    </div>
                    <div class='modal-footer'>
                        <a href='deletepost.php?poid=" . $row_post["poid"] . "&topid=" .  $row_post["to_pid"] . "' class='btn btn-danger'>".  __("delete", $language) ."</a>
                        <a href='editpost_page.php?poid=" . $row_post["poid"] . "' class='btn btn-secondary'>".  __("close", $language) ."</a>
                    </div>
                </div>
            </div>
        </div>";
 }
 } 
 else {
    echo __("documentation_empty", $language);
 }

 mysqli_close($conn);
?>





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
  <script>
  const initialContent = <?= json_encode($content); ?>;

  const editor = new EditorJS({
    holder: 'editorjs',
    tools: {
      header: {
        class: Header,
        inlineToolbar: ['bold', 'italic'],
        config: {
          levels: [2, 3, 4],
          defaultLevel: 3,
        },
      },
      paragraph: {
        class: Paragraph,
        inlineToolbar: ['bold', 'italic', 'inlineCode'],
      },
      inlineCode: InlineCode,
      simpleImage: {
        class: SimpleImage,
        config: {
          placeholder: 'Füge hier ein Bild hinzu',
        },
      },
      image: {
        class: ImageTool,
        config: {
          endpoints: {
            byFile: 'uploadFile.php',
            byUrl: 'fetchUrl.php',
          },
          field: 'image',
          types: 'image/*',
          caption: true,
          buttonContent: 'Bild auswählen oder URL einfügen',
        },
      },
    },
    data: initialContent ? JSON.parse(initialContent) : {},
    placeholder: 'Beginne hier mit der Eingabe...',
    onReady: () => {
      console.log('Editor.js ist bereit!');
    },
  });

  function submitEditorContent() {
    return editor.save().then((outputData) => {
      document.getElementById('postcontent_hidden').value = JSON.stringify(outputData);
      return true;
    }).catch((error) => {
      console.error('Fehler beim Speichern des Editor-Inhalts:', error);
      return false;
    });
  }
</script>

  </body>
</html>