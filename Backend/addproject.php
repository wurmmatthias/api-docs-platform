<?php 
include 'connect.php';
 
if (isset($_POST['projectname'])) {
    $projectname = $_POST['projectname'];
    $projectdescription = $_POST['projectdescription'];
    $author = "Not defined";
    
    $add_user = "INSERT INTO projekte (name, description, author) VALUES ('$projectname', '$projectdescription', '$author')";

    if (mysqli_query($conn, $add_user)) {
        echo "Projekt hinzugefügt.";
    } else {
        echo "Error in Database Entry";
    }

    mysqli_close($conn);
         
}
else {echo "General Error";}

header("Location: admin_main.php")

?>