<?php 
session_start();
include "connect.php";
include "../Frontend/locale/language_config.php";
$topid = $_GET['topid'];
?>

<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokumentation App - Admin</title>
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
    </style>
  </head>
  <body>

  <?php
  if (!isset($_SESSION['user'])) {
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
    <div class="container-fluid p-4">
      <?php 
      echo "
      <form action='addpost.php' method='POST' onsubmit='return saveEditorContent();'>
          <div class='form-group'>
              <input type='text' id='author' name='author' value='". $current_user ."' hidden>
              <input type='text' id='topid' name='topid' value='" . $topid ."' hidden>
              <input type='text' class='form-control' id='postname' name='postname' placeholder='". __("postname", $language) ."'><br>
              <!-- Editor container -->
              <div id='editorjs'></div>
              <textarea id='postcontent' name='postcontent' hidden></textarea>
              <br><br>
          </div>
          <button type='submit' class='btn btn-primary w-100'>". __("submit", $language) ."</button>
      </form>";
      ?>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <p><b><?php echo __("copyright", $language); ?></b></p>
  </footer>

  <script>
  const editor = new EditorJS({
    holder: 'editorjs',
    tools: {
      header: {
        class: Header,
        inlineToolbar: ['bold', 'italic'], // Inline Optionen für Header
        config: {
          levels: [2, 3, 4], // Überschriften H2, H3, H4
          defaultLevel: 3,
        },
      },
      paragraph: {
        class: Paragraph,
        inlineToolbar: ['bold', 'italic', 'inlineCode'], // Inline Optionen für Text
      },
      inlineCode: InlineCode, // Inline-Code für Text
      simpleImage: {
        class: SimpleImage, // Bild hinzufügen (sehr simpel)
        config: {
          placeholder: 'Füge hier ein Bild hinzu',
        },
      },
      image: {
        class: ImageTool,
        config: {
          endpoints: {
            byFile: 'uploadFile.php', // PHP-Endpunkt für Datei-Uploads
            byUrl: 'fetchUrl.php',    // PHP-Endpunkt für URL-Uploads
          },
          field: 'image',
          types: 'image/*',
          caption: true,
          buttonContent: 'Bild auswählen oder URL einfügen',
        },
      },
    },
    placeholder: 'Beginne hier mit der Eingabe...',
    onReady: () => {
      console.log('Editor.js ist bereit!');
    },
  });

    function saveEditorContent() {
      return new Promise((resolve, reject) => {
        editor.save().then((outputData) => {
          document.getElementById('postcontent').value = (JSON.stringify(outputData));
          resolve(true);
        }).catch((error) => {
          console.error('Saving failed: ', error);
          reject(false);
        });
      });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
