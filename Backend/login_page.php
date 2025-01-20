<?php 

if (isset($_GET["msg"])){
  if ($_GET["msg"] == 1) {
    $error_message = "Benutzer existiert nicht.";
  } else if ($_GET["msg"] == 2) {
    $success_message = "Benutzerkonto erfolgreich hinzugefügt. Bitte anmelden.";
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Dokumentation App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f8f9fa;
      }
      .login-container {
        max-width: 400px;
        width: 100%;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }
    </style>
  </head>
  <body>
    <div class="login-container">
      <h2 class="text-center mb-4"><b>Doku App</b> Login</h2>
      <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $error_message; ?>
        </div>
      <?php endif; ?>
      <?php if (isset($success_message)): ?>
        <div class="alert alert-success" role="alert">
          <?php echo $success_message; ?>
        </div>
      <?php endif; ?>
      <form method="POST" action="login.php">
        <div class="mb-3">
          <label for="username" class="form-label">Benutzername</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="passwort" class="form-label">Passwort</label>
          <input type="password" class="form-control" id="passwort" name="passwort" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Anmelden</button>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
