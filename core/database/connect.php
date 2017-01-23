<?php
   $db = new mysqli('127.0.0.1','root','mj0405','reg2');
   if($db->errno){
      die('sorry we are offline');
   }