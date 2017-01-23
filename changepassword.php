<?php
  require 'core/init.php';
  protect_page();

  if (!empty ($_POST)) {
    $required_field = array( 'old_pass', 'new_pass', 'new_pass_again' ); //array of all the required fields.
    foreach ($_POST as $key => $value) {
      if (empty($value) && (in_array($key, $required_field))) { //checking if any required field is empty
        $errors[] = 'field marked with asterik are required ';
        break;
      }
    }

    if( md5($_POST['old_pass'])!= $user_data['password'] ){
      $errors[] = 'current password is incorrect';
    }
    else {
      if ($_POST['new_pass']!=$_POST['new_pass_again']){
        $errors[] = 'you have entered password incorrectly';
      }

    }


  }
  require 'includes/head.php';
?>

  <h2>Change passoword</h2>

<?php
  if (isset($_GET['success'])&& empty($_GET['success'])){
    echo 'Your password has been changed';
  }
  else {
    if (!empty($_POST) && empty($errors)) {
      change_password($session_user_id, $_POST[ 'new_pass' ]);
      header('Location: changepassword.php?success');
    } elseif (!empty($errors)) {
      echo $output_errors($errors);
    }
    ?>
    <form action="" method="post">
      <ul>
        <li>
          currrent password*:<br>
          <input type="password" name="old_pass" minlength="6" maxlength="32">
        </li>
        <li>
          new password*:<br>
          <input type="password" name="new_pass" minlength="6" maxlength="32">
        </li>
        <li>
          repeat new password*:<br>
          <input type="password" name="new_pass_again" minlength="6" maxlength="32">
        </li>
        <li>
          <input type="submit" value="change password" minlength="6" maxlength="32">
        </li>
      </ul>
    </form>

    <?php
  }
  require 'includes/googleanalytics.php';
?>