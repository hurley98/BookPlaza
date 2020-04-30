<?php include 'header.inc.php'; 
$uid = $_SESSION['user'];
?>

<div class="container">
    <div class="bookPart" style="width: 80%; left: 0; right: 0; margin: 0 auto; margin-top: 50px; padding: 10px">
        <?php 
            
            if($user->isLoggedIn() && $user->isAdmin($uid))
            {
            ?>
                <a href="#" id="addBookButton" style="margin-bottom: 20px" class="btn btn-success">Add</a>
            <?php
            }
        ?>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Cover Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <?php
                        // if the user is logged in and admin, by now we check if the user is logged in
                        if($user->isLoggedIn() && $user->isAdmin($uid))
                        {
                            echo '<th>Actions</th>';
                        }
                    ?>  
                </tr>
            </thead>
            <tbody>
            <?php
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
                                <td style="text-align: center"><a href="book.php?bid='. $book['id'] .'"><img src="images//'.$book['addedby'].'//'. $book['coverimage'] .'" style="width: 100px"/></a></td>
                                <td>'. $book['title'] .'</td>
                                <td>'. $book['author'] .'</td>
                                '; 
                                if($user->isLoggedIn() && $user->isAdmin($uid)) { echo "<td><center><a href='#' id=editB" . $book['id'] . " class='btn btn-info'>Edit</a>&nbsp;<a href='#' id='removeB".$book['id']."' class='btn btn-danger'>Remove</a></center></td>"; }
                        echo '
                            </tr>
                        ';

                        ?>
                        <div class="modal fade" tabindex="-1" role="dialog" id="editM<?php echo $book['id']; ?>">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header <?php if($user->isLoggedIn() && $user->darkMode($_SESSION['user'])) { echo "darkmode" ;} ?>">
                                    <h5 class="modal-title">Editeaza cartea: <?php echo $book['title']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body <?php if($user->isLoggedIn() && $user->darkMode($_SESSION['user'])) { echo "darkmode" ;} ?>">
                                    <form id="formEdit<?php echo $book['id']; ?>">
                                        <input type="number" name="bookid" value="<?php echo $book['id']; ?>" hidden/>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="newTitle" placeholder="Schimba titlul.." value="<?php echo $book['title']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Author</label>
                                            <input type="text" class="form-control" name="newAuthor" placeholder="Schimba autorul.." value="<?php echo $book['author']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="newShortDesc" placeholder="Enter a new description"><?php echo $book['shortdesc']; ?></textarea>
                                        </div>
                                        <center>
                                            <input type="submit" class="btn btn-info" value="Editeaza"/>
                                        </center>
                                    </form>

                                    <script>
                                    $(document).ready(() => {
                                        $('#formEdit<?php echo $book['id']; ?>').on('submit', (e) => {
                                            e.preventDefault();

                                            // Ajax
                                            $.ajax
                                            ({
                                                type: 'POST',
                                                url: 'Actions/editBook.php',
                                                data: $('#formEdit<?php echo $book['id']; ?>').serialize(),
                                                success: (response) => {
                                                    alert(response);
                                                }
                                            });
                                        });
                                    });
                                    </script>
                                </div>
                                <div class="modal-footer <?php if($user->isLoggedIn() && $user->darkMode($_SESSION['user'])) { echo "darkmode" ;} ?>">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>

                        <!-- Remove Modal -->
                        <div class="modal fade" id="removeModal<?php echo $book['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header <?php if($user->isLoggedIn() && $user->darkMode($_SESSION['user'])) { echo "darkmode" ;} ?>">
                                <h5 class="modal-title text-danger" id="exampleModalLabel">Atenție</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body <?php if($user->isLoggedIn() && $user->darkMode($_SESSION['user'])) { echo "darkmode" ;} ?>">
                                <p class="text-center">Ești sigur că vrei să ștergi?</p>
                                <center>
                                    <input type="text" name="bidBook" id="bookb<?php echo $book['id']; ?>" value="<?php echo $book['id']; ?>" hidden />
                                    <a href="#" id="da<?php echo $book['id'];?>" class="btn btn-danger">Da</a> | <button class="btn btn-success" data-dismiss="modal">Nu</button>
                                </center>
                            </div>
                            </div>
                        </div>
                        </div>
                        <script>
                        $(document).ready(() => {
                            $('#editB<?php echo $book['id']; ?>').click((e) => {
                                e.preventDefault();
                                $('#editM<?php echo $book['id'];?>').modal('show');
                            });

                            $('#removeB<?php echo $book['id']; ?>').click((e) => {
                                e.preventDefault();
                                $('#removeModal<?php echo $book['id']; ?>').modal('show');
                            });

                            $('#da<?php echo $book['id']; ?>').click((e) => {
                                e.preventDefault();

                                $.ajax
                                ({
                                    type: 'POST',
                                    url: 'Actions/removeBook.php',
                                    data: { bidBook: $('#bookb<?php echo $book['id']; ?>').val() },
                                    success: (response) => {
                                        //alert (response);
                                        if(response == 1)
                                        {
                                            // hide the modal
                                            $('#removeModal<?php echo $book['id']; ?>').modal('hide');
                                            location.reload(true);
                                        }
                                    }
                                });
                            });
                        });
                        
                        </script>
                        <?php
                    }
                } catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            ?>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal" id="addBook" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header <?php if($user->isLoggedIn() && $user->darkMode($_SESSION['user'])) { echo "darkmode" ;} ?>">
                <h5 class="modal-title">Add a New Book</h5>
                <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body <?php if($user->isLoggedIn() && $user->darkMode($_SESSION['user'])) { echo "darkmode" ;} ?>">
                <!-- Form with upload -->
                <form enctype='multipart/form-data' method="POST" style="width: 80%;" id="uploadForm">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" id="titleBook" class="form-control" placeholder="Enter the title..">
                    </div>
                    <div class="form-group">
                        <label>Author</label>
                        <input type="text" name="author" id="authorBook" class="form-control" placeholder="Enter the author..">
                    </div>
                    <div class="form-group">
                        <label>Genre</label>
                        <select class="form-control genres">
                            <!-- Afisarea din baza de date -->
                            <option selected>---</option>
                            <?php 
                                $genreStatement = $conn->prepare("SELECT * FROM genres WHERE active=1");
                                $genreStatement->execute();

                                $genreRows = $genreStatement->fetchAll();

                                if($genreStatement->rowCount() > 0)
                                {
                                    foreach($genreRows as $genreRow) {
                                    ?>
                                        <option value="<?php echo $genreRow['id']; ?>"><?php echo $genreRow['value']; ?></option>
                                    <?php
                                    }
                                }
                            ?>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="shortDesc" id="descrBook" class="form-control" placeholder="Enter a description.."></textarea>
                    </div>
                    <div class="form-group">
                        <label>JPG, JPEG, PNG</label><br />
                        <input type="file" name="fileToUpload" id="imgTU" />
                    </div>
                    <div class="form-group">
                        <label>PDF</label><br />
                        <input type="file" name="fileToUploadPdf" id="pdfTU" />
                    </div>
                    <center>
                        <input type="submit" class="btn btn-secondary" id="uploadCoverImage" value="Add" />
                    </center>
                </form>
            </div>
            <div class="modal-footer <?php if($user->isLoggedIn() && $user->darkMode($_SESSION['user'])) { echo "darkmode" ;} ?>">
                <button type="button" class="btn btn-secondary closeButton" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

</div>

<script>
$(document).ready(function() {
    $('#example').DataTable();

   
    $('#addBookButton').click((e) => {
        e.preventDefault();
        $('#addBook').fadeIn(300).modal('show');
    });
$('select.genres').change(function() {

    $('#uploadForm').on('submit', (e) => {
        e.preventDefault();

        var fd = new FormData();
        var files = $('#imgTU')[0].files[0];
        var pdfFile = $('#pdfTU')[0].files[0];
        var title = $('#titleBook').val();
        var author = $('#authorBook').val();
        var description = $('#descrBook').val();
        fd.append('title', title);
        fd.append('author', author);
        fd.append('description', description);
        fd.append('fileToUpload', files);
        fd.append('fileToUploadPdf', pdfFile);

            var selectedGenre = $(this).children("option:selected").val();
            fd.append('genre', selectedGenre);
            


        $.ajax
        ({
            url: 'Actions/addNewBook.php',
            type: 'POST',
            data: fd,
            processData: false,
            cache: false,
            contentType: false,
            success: (response) => {
                //alert(data);
                if(response == 1)
                {
                    // sa apara un model de success!
                    alert("Success!");
                    $('#addBook').modal('hide');
                    location.reload(true);
                }
            }
        });

    });
}); 


  
} );
</script>

<?php include 'footer.inc.php'; ?>