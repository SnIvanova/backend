<?php
session_start();


if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time() + (86400 * 30), "/");
} elseif (isset($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
} else {
    $lang = 'it'; 
}


$translations = array(
    'it' => array(
        'welcome' => 'Benvenuti sul nostro sito!',
        'news' => 'Notizie',
        
    ),
    'en' => array(
        'welcome' => 'Welcome to our website!',
        'news' => 'News',
        
    )
);


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

?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $translations[$lang]['welcome']; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Website</a>
           
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0" action="" method="get">
                            <select class="form-control mr-sm-2" name="lang">
                                <option value="it" <?php if ($lang == 'it') echo 'selected="selected"'; ?>>Italiano</option>
                                <option value="en" <?php if ($lang == 'en') echo 'selected="selected"'; ?>>English</option>
                            </select>
                          
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Change Language</button>
                                <button class="btn btn-success my-3 my-sm-0" type="button" id="generatePdfBtn">Generate PDF</button>
                                <button class="btn btn-outline-success ml-auto mr-2" id="toggleFormBtn">Add News</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center"><?php echo $translations[$lang]['welcome']; ?></h1>
        <h2 class="text-center"><?php echo $translations[$lang]['news']; ?></h2>
        <ul class="news-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li class='news-item'>" . $row["title_$lang"] . "</li>";
                }
            } else {
                echo "<li class='news-item'>No news available</li>";
            }
            ?>
        </ul>
    </div>
    <div id="formContainer" class="container mt-5" style="display: none;">
        <?php require_once('NewsForm.php'); echo NewsForm::createForm();?>
    </div>

    <script>
        document.querySelector("#generatePdfBtn").addEventListener("click", function() {
            var selectedLang = document.querySelector('select[name="lang"]').value;
            window.location.href = "generate_pdf.php?lang=" + selectedLang;
        });
    </script>
  
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector("#toggleFormBtn").addEventListener("click", function() {
            var formContainer = document.querySelector("#formContainer");
            if (formContainer.style.display === "none" || formContainer.style.display === "") {
                formContainer.style.display = "block";
            } else {
                formContainer.style.display = "none";
            }
        });
    });
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php

$conn->close();
?>


