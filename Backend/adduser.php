<?php 
include 'connect.php';
 
if (isset($_POST['username'])) {
    $username_input = trim($_POST['username']);
    $firstname_input = trim($_POST['firstname']);
    $lastname_input = trim($_POST['lastname']);
    $passwort_input = $_POST['passwort'];

    $password_hashed = password_hash($passwort_input, PASSWORD_DEFAULT);

    $sql_checkUser = "SELECT * FROM user WHERE username = '$username_input'";
    $result_CheckUser = mysqli_query($conn, $sql_checkUser);

    if (mysqli_num_rows($result_CheckUser) > 0) {
        mysqli_close($conn);
        header("Location: http://localhost/api-docs-platform/Backend/adduser_page.php?msg=1");
        exit;
    } 
    else {
        $add_user = "INSERT INTO user (username, firstname, lastname, password) VALUES ('$username_input', '$firstname_input', '$lastname_input', '$password_hashed')";

        if (mysqli_query($conn, $add_user)) {
            echo "User hinzugefügt.";
            header("Location: http://localhost/api-docs-platform/Backend/login_page.php?msg=2");
            exit;
        } 
        else {
            echo "Error in Database Entry. User not added.";
        }
        mysqli_close($conn);
    }
} 
else {
    echo "General Error";
}
?>
