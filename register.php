<?php
    require 'core/init.php';
    logged_in_redirect();
    require 'includes/head.php';

    if (!empty ($_POST)){

            if (user_exists($_POST['username'])){ //if username is taken
                $errors[] = 'Sorry the username '.$_POST['username']. ' is already taken.';
            }

            if ($_POST['password'] < 6 ){ //password length must not be less than 6
                $errors[] = 'Password must be at least 6 characters long.';
            }

            if ($_POST['password']!= $_POST['r_password']) { // for checking that password and repeat password must match
               $errors[] = 'Both the passwords must match';
            }
            if (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){ // to check for valid email
                $errors[] = 'enter valid email address';
            }
            if (email_exists($_POST['email'])){ // to check if anyone has taken that email address
               $errors[] = 'Sorry the email '.$_POST['email']. ' is already taken.';
            }
    }
?>

<h1>Register</h1>

<?php
  if(isset($_GET['success'])&&empty($_GET['success'])) {
      echo 'You have been logged in '; // modifications karni hai abhi isme.
  }
  else {
    if (!empty($_POST) && empty($errors)) { //means there are no errors
      $register_data = array(
       'username' => $_POST[ 'username' ],
       'password' => $_POST[ 'password' ],
       'first_name' => $_POST[ 'first_name' ],
       'last_name' => $_POST[ 'last_name' ],
       'email' => $_POST[ 'email' ]
      );
      header('Location: register.php?success');
      exit();
    } else {
      echo output_error($errors);
    }

    ?>

      <form action="" method="post" >
          <ul>
              <li>
                  Username* :
                  <input type="text" name="username" id="username" autocomplete="off" pattern="\w*" required ><br>
              </li>
              <li>
                  Password* :
                  <input type="password" name="password" id="password" minlength="6" maxlength="32" required autocomplete="off">
              </li>
              <li>
                  Password Again* :
                  <input type="password" name="r_password" id="r_password" minlength="6" maxlength="32" required
                         autocomplete="off">
              </li>
              <li>
                  First Name* :
                  <input type="text" name="first_name" id="first_name" autocomplete="off" required pattern="[a-zA-Z]*">
              </li>
              <li>
                  Last Name* :
                  <input type="text" name="last_name" id="last_name" autocomplete="off" required pattern="\A*">
              </li>
              <li>
                  Email* :
                  <input type="email" name="email" id="email" autocomplete="off" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
              </li>
              <li>
                  <input type="checkbox" required >
                  <b>Agree to our terms and conditions</b><br>
                  <input type="submit" value="Register" id="click"><br>
              </li>
          </ul>
      </form>
    <?php
  }
  ?>