<?php 
include 'connect.php';
 
if(isset($_GET['user'])) {
    $user_input = $_POST['user'];
    $passwort_input = $_POST['passwort'];
    
    $check_user = "SELECT * FROM user WHERE user = '$user_input'";
    $result = mysqli_query($conn, $check_user);
        
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $hashed_password = $row["password"];

            if(password_verify($$passwort_input, $hashed_password)) {
                echo "Logged In!";
            } 
        }
        } 
        else {
            echo "Error!";
        }
    
}

?>
 
