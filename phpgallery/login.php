<?php
  include_once 'header.php';
?>

    <main>

      <section class="container form-cont mt-3 mb-3">
        <form class="row g-3" action="includes/login.inc.php" method="post">
          <h2 class="login-header mt-3 mb-3 pt-3 pb-3">Log In</h2>
          <div class="col-md-8">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="uid" placeholder="Username / E-mail" class="form-control">
          </div>
          <div class="col-md-8">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="pwd" placeholder="Password" class="form-control">
          </div>
          <div class="col-md-12">
            <button type="submit" name="submit" class="btn btn-outline-dark">Log In</button>
          </div>
        </form>
      </section>

        <?php //Error Messages
          //Check if certain URL exists
          if (isset($_GET["error"])) {
            //Check what the error message could be
            if ($_GET["error"] == "emptyinput") {
              echo "<p class='signup-message'>You must fill in all the fields!</p>";
            }
            elseif ($_GET["error"] == "wronglogin") {
              echo "<p class='signup-message'>Incorrect Login information!</p>";
            }
          }
        ?>
      </section>
    </main>



<?php
  include_once 'footer.php';
?>
