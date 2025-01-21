<?php 
include 'connect.php';
 
if (isset($_POST['topid'])) {
    $topid = $_POST['topid'];
    $postname = $_POST['postname'];
    $postcontent = $_POST['postcontent'];
    $author = $_POST['author'];
    
    $add_post = "INSERT INTO posts (to_pid, name, content, author) VALUES ('$topid', '$postname', '$postcontent', '$author')";

    if (mysqli_query($conn, $add_post)) {
        echo "Post hinzugefügt.";
    } else {
        echo "Error in Database Entry";
    }

    mysqli_close($conn);
         
}
else {echo "General Error";}

header("Location: admin_main.php?project=" . $topid . "");

?>