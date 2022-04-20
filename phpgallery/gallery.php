<?php
  include_once 'header.php';
?>


<section class="gallery-links">

    <h2 class="mt-3 mb-3 pt-3 pb-3">Gallery</h2>
    <div class="travel-gallery-container">
      <?php
      include_once 'includes/dbh.inc.php';

      $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC;";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement failed!";
      } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
          echo '<a href="#">
                  <div style="background-image: url(img/gallery/'.$row["imgFullNameGallery"].');"></div>
                  <h3 class="mt-3">'.$row["titleGallery"].'</h3>
                  <p>'.$row["descGallery"].'</p>
                </a>';
        }
      }

      ?>
    </div>

</section>
<section class="upload-section">

  <?php
  if (isset($_SESSION['useruid'])) {
    echo '<div class="gallery-upload">
            <form class="upload-form" action="includes/gallery.upload.inc.php" method="POST" enctype="multipart/form-data">
              <h3 class="mt-3 pt-3 mb-3">Upload Files</h3>
              <input type="text" name="filename" placeholder="File Name">
              <input type="text" name="filetitle" placeholder="Image Title">
              <input type="text" name="filedesc" placeholder="Image Description">
              <h4 class="center-hfour">Choose Files</h4>
              <div class="file-input"><input type="file" name="file" value="Search Files"></div>
              <button type="submit" name="submit">Upload</button>
            </form>
          </div>';
  }
  ?>

</section>



<?php
  include_once 'footer.php';
?>
