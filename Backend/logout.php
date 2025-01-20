<?php
 session_start();

  echo "Logout Successfully ";
  session_destroy();
  header("Location: http://localhost/API-DOCS-PLATFORM/Backend/login_page.php");
?>