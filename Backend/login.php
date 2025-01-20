<?php 
include 'connect.php';
 
if (isset($_POST['username'])) {
    $user_input = $_POST['username'];
    $passwort_input = $_POST['passwort'];
    
    $check_user = "SELECT * FROM user WHERE username = '$user_input'";
    $result = mysqli_query($conn, $check_user);
        
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $hashed_password = $row["password"];

            if(password_verify($passwort_input, $hashed_password)) {
                echo "Logged In!";
            } 
        }
        } 
        else {
            echo "Error: User does not exist!";
        }
    
}

?>
 
