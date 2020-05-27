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
    <title>Add article</title>
</head>

<body>

<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $conn = connect_to_db();
        $article = Article::getArticle($id, $conn);
    }

?>

<div class="container">
    <form method="POST" action="index.php">
        <div class="form-group">
            <label for="title">Tytuł</label>
            <input class="form-control" id="title-edit" name="title-edit" placeholder="Wprowadź tytuł" value="<?php echo $article ? $article->title : "" ?>" required>
        </div>
        <div class="form-group">
            <label for="short-description">Krótki opis</label>
            <input type="text" class="form-control" name="short-description-edit" id="short-description-edit" placeholder="Wprowadź krótki opis" value="<?php echo $article ? $article->short_description : "" ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Opis</label>
            <textarea class="form-control" name="description-edit" rows="3" id="description-edit" required><?php echo $article ? $article->description : "" ?></textarea>
        </div>
        <input id="id-edit" name="id-edit" type="hidden" value="<?php echo $article ? $article->id : "" ?>">
        <button type="submit" class="btn btn-primary">Wyślij</button>
    </form>
</div>
</body>
</html>

