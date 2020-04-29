<?php
    include '../conn.php';

    try
    {
        $title = $_POST['newTitle'];
        $author = $_POST['newAuthor'];
        $bookId = $_POST['bookid'];
        $newDescription = $_POST['newShortDesc'];
        $statement = $conn->prepare("UPDATE books SET title=:newTitle, author=:newAuthor, shortdesc=:newshortdesc WHERE id=:bookId");
        $statement->execute(array(
            ':newTitle' => $title,
            ':newAuthor' => $author,
            ':newshortdesc' => $newDescription,
            ':bookId' => $bookId
        ));

        if($statement->rowCount() > 0)
        {
            echo 1;
        }
        else
        {
            echo 2;
        }
    } catch (PDOException $e)
    {
        echo $e->getMessage();
    }

?>