<?php 
include 'connect.php';
 
if (isset($_POST['username'])) {
    $username_input = $_POST['username'];
    $firstname_input = $_POST['firstname'];
    $lastname_input = $_POST['lastname'];
    $passwort_input = $_POST['passwort'];

    $password_hashed = password_hash($passwort_input, PASSWORD_DEFAULT);
    
    $add_user = "INSERT INTO user (username, firstname, lastname, password) VALUES ('$username_input', '$firstname_input', '$lastname_input', '$password_hashed')";

    if (mysqli_query($conn, $add_user)) {
        echo "User hinzugefügt.";
        header("Location: http://localhost/api-docs-platform/Backend/login_page.php?msg=2");
    } else {
        echo "Error in Database Entry";
    }

    mysqli_close($conn);
         
}
else {echo "General Error";}

?>