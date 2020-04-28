<?php

    include 'conn.php';

    $genreId = $_GET['gid'];
    

    try
    {
        $statement = $conn->prepare("SELECT * FROM books WHERE genre=:genreid");
        $statement->bindParam(':genreid', $genreId, PDO::PARAM_INT);
        $statement->execute();

        if($genreId == "---")
        {
            return false;
        }

        if($statement->rowCount() > 0)
        {
            $rows = $statement->fetchAll();

            foreach($rows as $row)
            {
                ?>
                <div class="col-sm-4">
                    <center>
                    <p class="text-muted"><?php echo $row['title']; ?></p>
                    <img src="images/<?php echo $row['addedby'];?>/<?php echo $row['coverimage'];?>" width="150px" />
                    <p style="margin-top:15px">
                    <a href="book.php?bid=<?php echo $row['id']; ?>" class="btn btn-info">Learn more</a>
                    </p>
                    </center>
                </div>
                <?php
            }
        }
        else
        {
          ?> 
            <h4 style="left: 0; right: 0; margin: 0 auto; margin-top: 20px">No books</h4>
        
        <?php
        }
    } catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>

