<?php


class Article
{

    function fetchNews($conn)
    {
        $request = $conn->prepare(" SELECT id, title, short_description, created_at FROM news ORDER BY created_at DESC LIMIT 3");
        return $request->execute() ? $request->fetchAll() : false;
    }


    function getArticle($id, $conn)
    {
        $request = $conn->prepare(" SELECT id, title, short_description, description, created_at FROM news  WHERE id = ? ");
        return $request->execute(array($id)) ? $request->fetchObject() : false;
    }

    function deleteArticle($id, $conn)
    {
        $request = $conn->prepare(" DELETE FROM news WHERE id = ? ");
        return $request->execute(array($id)) ? true : false;
    }

    function addArticle($title, $short_description, $description, $conn)
    {
        $request = $conn->prepare(" INSERT INTO news (title, short_description, description) values (?, ?, ?) ");
        return $request->execute(array($title, $short_description, $description)) ? true : false;
    }

    function updateArticle($id, $title, $short_description, $description, $conn)
    {
        $request = $conn->prepare(" UPDATE news SET title=?, short_description=?, description=? WHERE id=? ");
        return $request->execute(array($title, $short_description, $description, $id)) ? true : false;
    }
}