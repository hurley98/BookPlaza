<?php
    // Conexiunea cu baza de date
    include '../conn.php';

    if(isset($_SESSION['user']))
    {
        $uid = $_SESSION['user'];
    }

    // For cover images
    $target_dir = "..//images//" . $uid . "//";

    // For PDF
    $target_dir_pdf = "..//pdf//" . $uid . "//";

    if(!is_dir($target_dir))
    {
        // Daca nu exista, creeam una
        mkdir($target_dir, 0755, true);
    }

    if(!is_dir($target_dir_pdf))
    {
        mkdir($target_dir_pdf, 0755, true);
    }

    // PDF
    $target_file_pdf = $target_dir_pdf . basename($_FILES['fileToUploadPdf']['name']);
    $pdfFileType = strtolower(pathinfo($target_file_pdf, PATHINFO_EXTENSION));

    // allow cerating file formats
    $allowTypes = array('pdf', 'doc');
    if(in_array($pdfFileType, $allowTypes))
    {
        // Upload file to the server
        if(move_uploaded_file($_FILES['fileToUploadPdf']['tmp_name'], $target_file_pdf))
        {
            $bookPdf = basename($_FILES['fileToUploadPdf']['name']);
        }
    }

    //

    // For image
    $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // check if image file is actual an image or fake image
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if($check !== false)
    {
       // echo "File is an image - " . $check['mime'];
        $uploadOk = 1;
    }
    else
    {
       // echo "File is not an image";
        $uploadOk = 0;
    }

    // check if the file already exists
    if(file_exists($target_file))
    {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if($_FILES['fileToUpload']['size'] > 50000000)
    {
        //echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
    {
        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if($uploadOk == 0)
    {
        //echo "Sorry, your file was not uploaded.";
        echo 0;
    }
    else
    {
        // If everything is ok, try to upload the file
        if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file))
        {
            $bookImage = basename($_FILES['fileToUpload']['name']);
            //echo "title: " . $_POST['title'];

            // Insert image path into database
            $insertStatement = $conn->prepare("INSERT INTO books(title, coverimage, genre, pdf, shortdesc, author, addedby) VALUES (:title, :coverimage, :genre, :pdf, :description, :author, :addedby)");
            $insertStatement->execute(array(
                ':title' => $_POST['title'],
                ':coverimage' => $bookImage,
                ':genre' => $_POST['genre'],
                ':pdf' => $bookPdf,
                ':description' => $_POST['description'],
                ':author' => $_POST['author'],
                ':addedby' => $uid
            ));

            echo 1;
        }
    }
?> 