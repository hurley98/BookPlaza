<?php include 'conn.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- Datatable -->
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    

    <title>Book Plaza</title>
  </head>
  <body>
  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index">Book Plaza</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="index">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="books">Books</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><?php echo $user->getUsername(@$_SESSION['user']); ?></a>
      </li>
      <li class="nav-item">
        <?php 
            echo ($user->isLoggedIn()) ? "<a class='nav-link' href='logout'>Logout</a>" : "<a class='nav-link' href='login'>Login</a>";
        ?>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post" action="search" >
      <input class="form-control mr-sm-2" type="search" name="searchItem" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<div class="loader" style="z-index: 999; position: absolute;left: 0; right: 0; background-color:white">
  <center>
    <img src="img/loader.gif"/>
  </center>
</div>
<script>
  $(document).ready(() => {
    $('.loader').hide();
  })
</script>