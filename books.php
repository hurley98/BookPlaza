<?php include 'header.inc.php'; ?>

<div class="container">
    <div class="bookPart" style="width: 80%; left: 0; right: 0; margin: 0 auto; border: 1px solid black; margin-top: 50px; padding: 10px">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Cover Image</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody id="dataFetched">
                <tr>
                    <td>Test</td>
                    <td>Test2</td>
                    <td>test3</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#example').DataTable();

    window.setInterval(function() {
        $('#dataFetched').load("Actions/fetchBooks.php");
    }, 1000);
} );
</script>

<?php include 'footer.inc.php'; ?>