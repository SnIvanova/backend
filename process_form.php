<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $title_it = htmlspecialchars($_POST['title_it']);
    $title_en = htmlspecialchars($_POST['title_en']);
    $content_it = htmlspecialchars($_POST['content_it']);
    $content_en = htmlspecialchars($_POST['content_en']);
    
  
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

 
    $sql = "INSERT INTO news (title_it, title_en, content_it, content_en) VALUES ('$title_it', '$title_en', '$content_it', '$content_en')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();
}
?>
