<?php
  include_once 'head.php';
  session_start();
?>
  <!-- Body -->
  <body id="bg-color">

    <header>
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="index.php">TRAVEL GALLERY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <?php //Change website when user is logged in
                  if (isset($_SESSION["useruid"])) {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="gallery.php">Gallery</a>
                          </li>';
                    echo '<li class="nav-item">
                            <a class="nav-link" href="includes/logout.inc.php">Log Out</a>
                          </li>';
                  }
                  else {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="signup.php">Sign Up</a>
                          </li>';
                    echo '<li class="nav-item">
                            <a class="nav-link" href="login.php">Log In</a>
                          </li>';
                  }
                ?>
              </ul>
            </div>
        </div>
      </nav>
    </header>
