<h2>Users</h2>
<b> We have currently
   <?php
        $user_count = user_count();
        $suffix = ($user_count > 1)?'s':'';
   ?>
   <?php echo $user_count.' '; ?>user <?php echo $suffix; ?></b>.

