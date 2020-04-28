<?php
    include '../conn.php';

    $bid = $_POST['bidBook'];

    $statement = $conn->prepare("DELETE FROM books WHERE id=:bid");
    $statement->bindParam(':bid', $bid, PDO::PARAM_INT);
    $statement->execute();

    if($statement->rowCount() > 0)
    {
        // succcess
        echo 1;
    }
    else
    {
        // Failed or the book doesn't exists
        echo 2;
    }
?>