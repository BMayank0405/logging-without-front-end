<?php
  require 'core/init.php';
  protect_page();
  require 'includes/head.php';

  if (!empty ($_POST)) {
    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
      $errors[]='enter a valid email address';
    } 
    elseif ( email_exists($_POST['email']) && $user_data['email'] != $_POST['email'] ){
      // this checks that if the email exists in the database and is not the same email address of the user
      $errors[] = 'Sorry the email '.$_POST['email']. ' is already taken.';
    }
  
  }
  ?>
<h2>Settings</h2>

<?php
  if(!empty($_POST) && empty($errors)){ //
    $update_data = array(
     'first_name' => $_POST['f_name'],
     'last_name' => $_POST['l_name'],
     'email' => $_POST['email']
    );
  }
  elseif(!empty($errors)){
    echo $output_errors($errors);
  }
?>

<form action="" method="post">
  <ul>
    <li>First Name <br>
      <input type="text" name="f_name" required value="<?php echo $user_data['first_name']; ?>" pattern="[a-zA-Z]">
    </li>
    <li>Last Name <br>
      <input type="text" name="l_name"  value="<?php echo $user_data['last_name']; ?>" pattern="[a-zA-Z]">
    </li>
    <li>Email <br>
      <input type="email" name="email" required  value="<?php echo $user_data['email']; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
    </li>
    <li>
      <input type="submit" value="update">
    </li>
  </ul>
</form>

<?php
  require 'includes/googleanalytics.php';
?>
