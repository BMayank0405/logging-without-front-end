<?php
   if (logged_in()) {
      require 'includes/widgets/loggedin.php';
   }
   else {
      require 'includes/widgets/login.php';
   }
   require 'includes/widgets/user_count.php';
   ?>