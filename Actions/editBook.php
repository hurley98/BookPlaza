<?php
    include '../conn.php';

    try
    {
        $title = $_POST['newTitle'];
        $author = $_POST['newAuthor'];
        $bookId = $_POST['bookid'];
        $statement = $conn->prepare("UPDATE books SET title=:newTitle, author=:newAuthor WHERE id=:bookId");
        $statement->execute(array(
            ':newTitle' => $title,
            ':newAuthor' => $author,
            ':bookId' => $bookId
        ));

        if($statement->rowCount() > 0)
        {
            echo 1;
        }
    } catch (PDOException $e)
    {
        echo $e->getMessage();
    }

?>