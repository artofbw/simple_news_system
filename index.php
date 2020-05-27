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
            <div class="row">
                <a class="btn btn-primary mt-3" href="add_article.html" role="button">Dodaj artykuł</a>
            </div>

            <?php
            $conn = connect_to_db();
            $news = Article::fetchNews($conn);

            if (isset($_POST["title"], $_POST["short-description"], $_POST["description"])) {
                $title = $_POST["title"];
                $short_description = $_POST["short-description"];
                $description = $_POST["description"];

                $id = $_GET["id"];
                $article = Article::addArticle($title, $short_description, $description, $conn);
                if ($article) {
                    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER["PHP_SELF"]) . "/index.php");
                } else {
                    echo "<h3>Wystąpiło nieprawidłowe zapytanie podczas dodawania artykułu...</h3><br>";
                }
            }

            if (isset($_POST["id-edit"], $_POST["title-edit"], $_POST["short-description-edit"], $_POST["description-edit"])) {
                $id = $_POST["id-edit"];
                $title = $_POST["title-edit"];
                $short_description = $_POST["short-description-edit"];
                $description = $_POST["description-edit"];

                $article = Article::updateArticle($id, $title, $short_description, $description, $conn);
                if ($article) {
                    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER["PHP_SELF"]) . "/index.php");
                } else {
                    echo "<h3>Wystąpiło nieprawidłowe zapytanie podczas edycji artykułu...</h3><br>";
                }
            }


            if (!$conn) {
                echo "Błąd podczas próby połączenia z serwerem MySQL...<br>";
                exit;
            }
            if (!$news) {
                echo "Brak newsów w bazie!<br>";
                exit;
            } else {
                foreach ($news as $article) {
                    echo "<div class=\"card mt-5\">";
                    echo "<div class=\"card-body\">";
                    echo "<h5 class=\"card-title\">Tytuł: $article->title <span class=\"float-right\"><a href=\"update_article.php?id=$article->id\">Edytuj</a> | <a href=\"delete.php?id=$article->id\">Usuń</a></span></h5>";
                    echo "Krótki opis: $article->short_description ";
                    echo "<a href=\"article.php?id=$article->id\">czytaj dalej</a>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </body>

</html>

