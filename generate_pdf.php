<?php
session_start();


if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
} else {
    $lang = 'it'; 
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM news";
$result = $conn->query($sql);


require('fpdf186/fpdf.php');


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);


$pdf->Cell(40, 10, $lang === 'it' ? 'Notizie' : 'News', 0, 1);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $title = $lang === 'it' ? $row['title_it'] : $row['title_en'];
        $content = $lang === 'it' ? $row['content_it'] : $row['content_en'];

        
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $title, 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(0, 10, $content);
        $pdf->Ln();
    }
} else {
    
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, $lang === 'it' ? 'Nessuna notizia disponibile' : 'No news available', 0, 1);
}


$pdf->Output();


$conn->close();
?>
