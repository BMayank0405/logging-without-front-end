<?php

  // to change password
  function change_password($user_id,$password){
    global $db;
    $user_id = (int)$user_id;
    $password = md5($password);
    $db->query("UPDATE `users` SET `password` = '$password' WHERE `user_id` = $user_id");//here user_id is not in quotes as it is a no.
  }

   // to count the no. of users who have activated there email
   function user_count(){
      global $db;
      $result = $db->query("SELECT COUNT(`user_id`) FROM `users` WHERE `active`=1");
      $row = $result->fetch_row();
      return $row[0];
   }

   // to get user data from the user id of the user
   function user_data($user_id){
      global $db;
      $data = array();
      $user_id = (int)$user_id;
      $func_num_args = func_num_args();
      $func_get_args = func_get_args();

      if($func_num_args > 1 ){
         unset($func_get_args[0]);
         $field = '`'.implode('`, `',$func_get_args).'`';  //making arguments so they can be used in the query
         $result = $db->query("SELECT $field FROM `users` WHERE `user_id`=$user_id");
         $row = $result->fetch_assoc();
         return $row;
      }
   }

   //if user is logged in different page will be shown to the user
   function logged_in() {
      return (isset($_SESSION['user_id']))?true:false;
   }

   //to check whether the username exist in database
   function user_exists(string $username):bool
   {
      $user_id = user_id($username);
      if($user_id)
         return true;
      else
         return false;
   }

   // returns user id of the user if exists
   function user_id (string $username):int{
      global $db;
      $result = $db->query("SELECT `user_id` FROM `users` WHERE `username`= '$username'");
      $row = $result->fetch_row();
      if ($result->num_rows ) //this check whether any row is returned from the query
         return $row[0]; //
      else return 0;
   }

   //to check whether the username exist in database
   function email_exists(string $email):bool
   {
      $user_id = email_id($email);
      if($user_id)
         return true;
      else
         return false;
   }

   // returns user id of the email if exists
   function email_id (string $email):int{
      global $db;
      $result = $db->query("SELECT `user_id` FROM `users` WHERE `email`= '$email'");
      $row = $result->fetch_row();
      if ( $result->num_rows ) //this check whether any row is returned from the query
         return $row[0]; //
      else return 0;
   }

   //to check if the email of user has been activated
   function user_active(string $username):bool
   {
      global $db;
      $result = $db->query("SELECT `user_id` FROM `users` WHERE `username`= '$username' AND `active`=1");
      $row = $result->fetch_row(); //this will fetch array in normal indexed format
      if($row['0']) // here row['0'] is the user id
         return true;
      else
         return false;
   }

   // this function is used to take
  function register_data($register_data) {
     global $db;
     array_walk($register_data, 'array_sanitize');
     $register_data['password']=md5($register_data['password']);
     
     //registration query
     $field = '`'.implode('`, `',array_keys($register_data)).'`'; // name of rows in which data is to be inserted
     $data = '\''.implode('\', \'',$register_data).'\''; // data which is to be inserted
     $db->query("INSERT INTO `users` ($field) VALUES ($data)");

 
  }

   //checking while logging in of a user
   function login(string $username , $password){
      global $errors,$db;
      if(!user_id ($username)){
         $errors[]= 'you have entered incorrect user name or password';
         die();
      }
      else {
         $user_id = user_id($username);
         $password = md5($password);
         $result = $db->query("SELECT `user_id` FROM `users` WHERE `username`= '$username' AND `password` = '$password'");
         $row = $result->fetch_row();
         if ($result->num_rows)
            return $user_id;
         else return false;
      }
   }
