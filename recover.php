<?php
  require 'core/init.php';
  logged_in_redirect();
  require 'includes/head.php';
?>
  <h2>Recover</h2>
<?php
  if (isset($_GET['success']) && empty($_GET['success']) ){

  }
  else {
    $mode_allowed = array('username', 'password');
    if (isset($_GET[ 'mode' ]) && in_array($_GET[ 'mode' ], $mode_allowed)) {
      if (isset($_POST[ 'email' ]) && !empty($_POST[ 'email' ])) {
        if (email_exists($_POST[ 'email' ])) {
          recover($_GET[ 'mode' ], $_POST[ 'email' ]);
          header('Location: recover.php?success');
        } else {
          echo 'sorry there is no email address <br>';
        }
      }
      ?>

      <form action="" method="post">
        <li>Enter your email address here:<br>
          <input type="email" placeholder="Your registered email address" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
        </li>
        <li><input type="submit" value="Recover"></li>
      </form>

      <?php
    } else {
      header('Location: index.php'); //rather i will be using here 404 page to display the error
      exit();
    }
  }
?>
<?php
  require 'includes/googleanalytics.php';
?>