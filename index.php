<?php
    include 'header.inc.php';
?>

<br />
<div class="category" style="width: 400px; left: 0; right: 0; margin: 0 auto">
    <h2 class="text-center">Please select a Genre</h2>
    <select class="form-control category">
        <option>---</option>
        <?php
            try
            {
                $statement = $conn->prepare("SELECT * FROM genres WHERE active=1");
                $statement->execute();

                $rows = $statement->fetchAll();

                if($statement->rowCount() > 0)
                {
                    foreach($rows as $row)
                    {
                        ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['value']; ?></option>
                        <?php
                    }
                }
            } catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        ?>
    </select>
</div>

<script>
    $(document).ready(() => {
        $('select.category').change(function() {
            var selectedGenre = $(this).children("option:selected").val();

            $('.data').load('loadbooks.php?gid='+selectedGenre);
        });
    });
</script>

<div class="container">
    <div class="row data text-center"></div>
</div>
<?php
    include 'footer.inc.php';
?>