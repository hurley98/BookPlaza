<?php
    include '../conn.php';

    // make a simple selection
    try
    {
        $statement = $conn->prepare("SELECT * FROM books");
        $statement->execute();
        $books = $statement->fetchAll();
        foreach($books as $book)
        {
            echo '
                <tr>
                    <td style="text-align: center"><img src='. $book['coverimage'] .' style="width: 100px"/></td>
                    <td>'. $book['title'] .'</td>
                    <td>'. $book['author'] .'</td>
                    '; 
                    if($user->isLoggedIn()) { echo "<td><center><a href='#' class='btn btn-info'>Edit</a>&nbsp;<a href='#' class='btn btn-danger'>Remove</a></center></td>"; }
            echo '
                </tr>
            ';
        }
    } catch(PDOException $e)
    {
        echo $e->getMessage();
    }

?>