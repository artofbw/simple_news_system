<?php
require("config/dbconnect.php");
require("article/Article.php");
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Simple news system</title>
</head>

<body>
<div class="container">
    <?php
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $conn = connect_to_db();

        if (!$conn) {
            echo "Błąd podczas próby połączenia z serwerem MySQL...<br>";
            exit;
        }
        if (!$id) {
            echo "Wystąpiło nieprawidłowe zapytanie...<br>";
            exit;
        } else {
            Article::deleteArticle($id, $conn);
            header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER["PHP_SELF"]) . "/index.php");
        }

    } else {
        echo "Wystąpiło nieprawidłowe zapytanie...<br>";
    }
    ?>
</div>
</body>

</html>

