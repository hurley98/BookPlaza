<?php
    include 'header.inc.php';

    // Bood id
    $bid = $_GET['bid'];

    try
    {
        $statement = $conn->prepare("SELECT * FROM books WHERE id=:bid");
        $statement->bindParam(':bid', $bid, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        ?>
        <div class="container">
            <div class="row">
                <div class="col" style="padding-top:100px; text-align: center">
                    <img src="images/<?php echo $row['addedby']; ?>/<?php echo $row['coverimage']; ?>"  width="200px"/>
                    <h2 style="margin-top: 15px"><?php echo $row['title'];?></h2>
                    <hr />
                    <p class="text-left" style="padding: 30px"><?php echo $row['shortdesc']; ?></p>
                </div>
            </div>
        </div>
            
        <?php
    } catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>

