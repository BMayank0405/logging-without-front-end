<?php
   require 'core/init.php';
   logged_in_redirect();
   require 'includes/head.php';
   if (isset($_POST['username']) && isset($_POST['password'])) {
      $username = $_POST['username']; //user input for logging in the user
      $password = $_POST['password'];

      if (empty($username) || empty($password)) {
         $errors[] = 'you need to enter a username or password';
      }
      else
      {
         $username = sanitize($username);
         if (!user_exists($username)) {
            $errors[] = 'you need to sign in/register';
         }
         elseif (!user_active($username)) {
            $errors[] = 'you need to activate your account';
         }
         else{
            $login = login($username,$password);
            if ($login === false){
               $errors[]= 'you must provide correct username and password';
            }
            else{
               $_SESSION['user_id']=$login;
               header('Location:index.php');
            }
         }
      }

   }
   if (!empty($errors)) {
?>
   <h2>There are some problems while loggin you in.</h2>
<?php
   echo output_error($errors);}
   require 'includes/googleanalytics.php';
