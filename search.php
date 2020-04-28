<?php
    include 'header.inc.php';

    $bookSearch = 0;

    // POST Event
    if(isset($_POST))
    {
        $bookSearch = $_POST['searchItem'];
        if($bookSearch == "")
        {
            $bookSearch = 0;
        }
    }

    try
    {
        $statement = $conn->prepare("SELECT * FROM books WHERE title LIKE '%' :bookSearch '%' ");
        $statement->bindParam(':bookSearch', $bookSearch, PDO::PARAM_STR);
        $statement->execute();

        $rows = $statement->fetchAll();
        $n = $statement->rowCount();

        ?>
        <h1 class="text-center">Search results (<?php echo $n; ?>)</h1>
        <hr />
        <center>
        <form method="POST" action="search" class="form-inline my-2" style="left: 0; right: 0; margin: 0 auto; width: 300px">
            <input class="form-control mr-sm-2" type="search" name="searchItem" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" id="searchB" type="submit">Search</button>
        </form>
        </center>

        <!-- Foreach 3 per row -->
        <?php
        foreach($rows as $row)
        {
            ?>
            <div class="col-sm-4">
                <a href="book.php?bid=<?php echo $row['id']; ?>" style="text-decoration: none; color: black">
                <div class="card" style="height: 600px;margin-bottom: 20px">
                    <img src="images//<?php echo $row['addedby']; ?>//<?php echo $row['coverimage']; ?>" style="left: 0; right: 0; margin: 0 auto; width: 200px; height: 300px;" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title text-center"><?php echo $row['title']; ?></h5>
                    <p class="card-text">
                    <hr/>
                    Scurtă descriere:
                    <?php echo $row['shortdesc']; ?></p>
                    <hr />
                    <p class="card-text"><small class="text-muted">Autorul: <?php echo $row['author']; ?></small></p>
                    </div>
                </div>
                </a>
            </div>
            <?php
        }
    } catch(PDOException $e)
    {
        echo $e->getMessage();
    }

include 'footer.inc.php';
?>

