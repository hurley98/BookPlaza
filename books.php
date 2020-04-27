<?php include 'header.inc.php'; ?>

<div class="container">
    <div class="bookPart" style="width: 80%; left: 0; right: 0; margin: 0 auto; margin-top: 50px; padding: 10px">
        <a href="#" id="addBookButton" style="margin-bottom: 20px" class="btn btn-success">Add</a>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Cover Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <?php
                        // if the user is logged in and admin, by now we check if the user is logged in
                        if($user->isLoggedIn())
                        {
                            echo '<th>Actions</th>';
                        }
                    ?>  
                </tr>
            </thead>
            <tbody id="dataFetched"></tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal" id="addBook" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a New Book</h5>
                <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form with upload -->
                <form enctype='multipart/form-data' method="POST" style="width: 80%;" id="uploadForm">
                    <div class="form-group">
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter the title..">
                    </div>
                    <div class="form-group">
                        <input type="text" name="author" id="author" class="form-control" placeholder="Enter the author..">
                    </div>
                    <div class="form-group">
                        <input type="file" name="fileToUpload" id="imgTU" />
                    </div>
                    <center>
                        <input type="submit" class="btn btn-secondary" id="uploadCoverImage" value="Add" />
                    </center>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary closeButton" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

</div>

<script>
$(document).ready(function() {
    $('#example').DataTable();
    $('#dataFetched').load("Actions/fetchBooks.php");

    window.setInterval(function() {
        $('#dataFetched').load("Actions/fetchBooks.php");
    }, 1000);

    $('#addBookButton').click((e) => {
        e.preventDefault();
        $('#addBook').fadeIn(300).modal('show');
    });

    $('#uploadForm').on('submit', (e) => {
        e.preventDefault();

        var fd = new FormData();
        var files = $('#imgTU')[0].files[0];
        fd.append('fileToUpload', files);


        $.ajax
        ({
            url: 'Actions/addNewBook.php',
            type: 'POST',
            data: fd,
            processData: false,
            cache: false,
            contentType: false,
            success: (data) => {
                alert(data);
            }
        });

    });

  
} );
</script>

<?php include 'footer.inc.php'; ?>