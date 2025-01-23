<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrierung - Dokumentation App</title>
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

<?php
if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
}
else {
  $msg = 0;
}
?>

  <body>
    <div class="login-container">
      <h2 class="text-center mb-4"><b>Doku App</b> Registrierung</h2>
      <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $error_message; ?>
        </div>
      <?php endif; ?>
      <form method="POST" action="adduser.php">
        <div class="mb-3">
          <label for="username" class="form-label">Benutzername</label>
          <input type="text" class="form-control" id="username" name="username" required>
          <?php if ($msg == 1) {echo "<p class='text-danger'>Username already exists. Please choose a different one.</p>";} ?>
        </div>
        <div class="mb-3">
          <label for="firstname" class="form-label">Vorname</label>
          <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label">Nachname</label>
          <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>
        <div class="mb-3">
          <label for="passwort" class="form-label">Passwort</label>
            <input 
              type="password" 
              class="form-control" 
              id="passwort" 
              name="passwort" 
              required 
              pattern="(?=.*\d)(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}" 
              title="Das Passwort muss mindestens 8 Zeichen lang sein, mindestens eine Zahl, einen Großbuchstaben und ein Sonderzeichen enthalten.">
              <small class="text-muted">Das Passwort muss mindestens 8 Zeichen lang sein, mindestens eine Zahl, einen Großbuchstaben und ein Sonderzeichen enthalten.</small>
        </div>
        <button type="submit" class="btn btn-success w-100">Registrieren</button>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
