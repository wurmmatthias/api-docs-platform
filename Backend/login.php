<?php 
session_start();
include 'connect.php';
 
if(isset($_SESSION['use'])) {
    header("http://localhost/API-DOCS-PLATFORM/Backend/admin_main.php"); 
}


if (isset($_POST['username'])) {
    $user_input = $_POST['username'];
    $passwort_input = $_POST['passwort'];
    
    $check_user = "SELECT * FROM user WHERE username = '$user_input'";
    $result = mysqli_query($conn, $check_user);
        
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $hashed_password = $row["password"];

            if(password_verify($passwort_input, $hashed_password)) {
                $_SESSION['user'] = $user_input;
                echo '<script type="text/javascript"> window.open("http://localhost/API-DOCS-PLATFORM/Backend/admin_main.php","_self");</script>';
                echo "Logged In!";
            } else {
                echo "Passwort Falsch";
                header("Location: http://localhost/api-docs-platform/Backend/login_page.php?msg=1");
            }
        }
        } 
        else {
            echo "Fehler im Benutzer";
            header("Location: http://localhost/api-docs-platform/Backend/login_page.php?msg=3");
        }
    
}

?>
 
