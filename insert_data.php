<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO news (title_it, title_en, content_it, content_en, created_at) VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}


$newsEntries = array(
    array('Titolo Italiano 1', 'Title English 1', 'Contenuto Italiano 1', 'Content English 1'),
    array('Titolo Italiano 2', 'Title English 2', 'Contenuto Italiano 2', 'Content English 2'),
    array('Titolo Italiano 3', 'Title English 3', 'Contenuto Italiano 3', 'Content English 3')
);

foreach ($newsEntries as $entry) {
    $title_it = $entry[0];
    $title_en = $entry[1];
    $content_it = $entry[2];
    $content_en = $entry[3];


    $stmt->bind_param("ssss", $title_it, $title_en, $content_it, $content_en);

   
    if (!$stmt->execute()) {
        echo "Error inserting sample data: " . $stmt->error;
    }
}

echo "Sample data inserted successfully";


$stmt->close();
$conn->close();
?>
