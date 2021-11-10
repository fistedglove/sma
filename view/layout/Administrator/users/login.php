<?php

$title = 'Login';
include_once(VIEW_PATH. 'layout/_loginheader.php');

?>




<div id="loginMainContent">
<?php if($session->get_message() == 'You have logged out successfully!'):?>
<div class="logOutGreenMsg"><?php echo flash_message($session->get_message());?></div>
 <?php elseif($session->get_message() != 'You have logged out successfully!'):?>  
<div class="logOutMsg"><?php echo flash_message($session->get_message());?></div>      
<?php endif;?>
<form action="<?php echo '/'. APP_ROOT.'/';?>users/login" method="post">
<fieldset class="login" >
<legend>Please Login</legend>

<p>
<label>Username: </label>
<input type="text" name="users[username]" value="" />
</p>

<p>
<label>Password: </label>
<input type="password" name="users[password]" value="" />
</p>

<p>
<input class="submit" type="submit" name="submit" value="Submit" />
</p>
</fieldset>

</form>







</div>


<?php include_once(VIEW_PATH. 'layout/_loginfooter.php');?>