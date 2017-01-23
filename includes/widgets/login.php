<div>
    <h2><a href="register.php"> sign in / register </a></h2>
   <form action="login.php" method ="post" >
        <p> Username :<input type="text" id="username" name="username" autocomplete="off" required></p>
        Password :<input type="password" id="password" name="password" autocomplete="off" required><br>
        <input type="checkbox" required> <b>Remember Me</b><br>
        <input type="submit" value ="login" id="click" ><br>
        <a href="register.php">Register</a><br>
       Forgotten your
       <a href="recover.php?mode=username">Username</a> or <a href="recover.php?mode=password">Password</a> ?
   </form>
</div>