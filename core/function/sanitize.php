<?php

  function recover($mode , $email){ // for email recovery
    $mode = sanitize($mode);
    $email = sanitize($email);
    $user_data = user_data(email_id($email),'first_name','username' );

    //to mail user their username or password
    if ($mode = 'username'){
      email($email,'YO', );
    }
    elseif ($mode = 'password'){}
  }

  // so that the logged in user user can not access the register page
  function logged_in_redirect() {
    if( logged_in()){
      header('Location: index.php');
      exit();
    }
  }

  //for making sure that we allow access to only signed in users on the page on which this function is called
  function protect_page() {
    if( !logged_in()){
      header('Location: protected.php');
      exit();
    }
  }

  function array_sanitze(&$item){
    global $db;
    $item = mysqli_real_escape_string($db, $item);
  }

   function sanitize(string $data ){
      global $db;
      $data = htmlentities(strip_tags(trim($data)),ENT_QUOTES);
      return $db->real_escape_string($data);
   }

   function output_error($errors)
   {
      return '<ul><li>' . implode('<li></li>', $errors) . '</li></ul>';
   }