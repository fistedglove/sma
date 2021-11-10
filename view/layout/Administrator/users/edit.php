<?php

$title = 'Change Password';
include_once(VIEW_PATH. 'layout/_loginheader.php');

?>

<div id="loginMainContent">

<div id="passwordMsg"><?php echo flash_warning($session->get_message());?></div>
        

<form action="<?php echo '/'. APP_ROOT.'/';?>users/edit" method="post">
<fieldset class="password" >
<legend>Change Password</legend>
<input type="hidden" name="users[type]" value="<?php echo $found_user->type;?>" />
<input type="hidden" name="users[staff_id]" value="<?php echo $found_user->staff_id;?>" />
<p>
<label>Username: </label>
<select name="users[username]">
<option value="<?php echo $found_user->username;?>"><?php echo $found_user->username;?></option>
</select>
</p>

<p>
<label>Old Password: </label>
<input type="password" name="users[old_password]" value="" />
</p>

<p>
<label>New Password: </label>
<input type="password" name="users[password]" value="" />
</p>

<p>
<label class="confirm">Confirm Password: </label>
<input class="confirm" type="password" name="users[confirm_password]" value="" />
</p>

<p>
<input class="submit" type="submit" name="submit" value="Submit" />
</p>
</fieldset>

</form>







</div>


<?php include_once(VIEW_PATH. 'layout/_loginfooter.php');?>