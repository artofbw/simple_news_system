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
    <title>Article details</title>
</head>

<body>
<div class="container">
    <div class="row">
        <a class="btn btn-primary mt-3" href="index.php" role="button">Powrót</a>
    </div>
    <?php
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $conn = connect_to_db();
        $article = Article::getArticle($id, $conn);

        if (!$conn) {
            echo "Błąd podczas próby połączenia z serwerem MySQL...<br>";
            exit;
        }
        if (!$article) {
            echo "Wystąpiło nieprawidłowe zapytanie...<br>";
            exit;
        } else {
            echo "<div class=\"card mt-5\">";
            echo "<div class=\"card-body\">";
            echo "<h5 class=\"card-title\">Tytuł: $article->title</h5>";
            echo "Opis: $article->description";
            echo "</div>";
            echo "<div class=\"card-footer\">";
            echo "Data utworzenia: $article->created_at";
            echo "</div>";
            echo "</div>";
        }

    } else {
        echo "brak przekazanego id";
    }

    ?>
</div>
</body>

</html>

