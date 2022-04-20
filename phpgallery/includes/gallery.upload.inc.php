<?php
//Check if upload was submitted
if (isset($_POST['submit'])) {

  //1) Grab new file name
  $newFileName = $_POST['filename'];
  if (empty($newFileName)) {
    $newFileName = "gallery";
  } else {
    //If user writes a file name with spaces, we want to replace spaces with a dash. Also, we want it lowercase.
    $newFileName = strtolower(str_replace(" ", "-", $newFileName));
  }
  //2) Grab image title and description
  $imageTitle = $_POST['filetitle'];
  $imageDesc = $_POST['filedesc'];

  //3) Grab file
  $file = $_FILES['file'];
  //Info from file: print_r($file); -- we need name, type, tmp_name, error and size
  $fileName = $file['name'];
  $fileType = $file['type'];
  $fileTempName = $file['tmp_name'];
  $fileError = $file['error'];
  $fileSize = $file['size'];

  //Get file extension in lowercase
  $fileExt = explode(".", $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array("jpg", "jpeg", "png");

  //ERROR HANDLERS
  //1) Did we get an allowed file extension?
  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 20000000) {
        $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
        $fileDestination = "../img/gallery/" . $imageFullName;

        //Include info into database before uplaoding the file
        include_once 'dbh.inc.php';
        //More error handlers
        if (empty($imageTitle) || empty($imageDesc)) {
          header('Location: ../gallery.php?upload=empty');
          exit();
        } else {
          $sql = "SELECT * FROM gallery;";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed";
          } else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $rowCount = mysqli_num_rows($result);
            $setImageOrder = $rowCount + 1;

            //Insert info about image into database
            $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) VALUES (?, ?, ?, ?);";
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo "SQL statement failed";
            } else {
              mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
              mysqli_stmt_execute($stmt);

              //Insert image into DB
              move_uploaded_file($fileTempName, $fileDestination);
              header('Location: ../gallery.php?upload=success');
            }
          }
        }

      } else {
        echo "File size is too big!";
      }
    } else {
      echo "You had an error!";
    }
  } else {
    echo "You need to upload a proper file type (jpg, jpeg or png)";
    exit();
  }

}
