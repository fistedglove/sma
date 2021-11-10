<?php
$title = 'New User';

include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/Administrator/_nav.php');?>

<div id="mainContent" style="height: 32em;">
<h3 class="title">New User Accounts</h3>
<div id="userMsg"><?php echo flash_warning($session->get_message());?></div>
        

<form action="<?php echo '/'. APP_ROOT.'/';?>users/edit_user" method="post">
<fieldset class="editUser" >
<legend>Create User</legend>
<input type="hidden" name="users[id]" value="<?php echo $user_account->id;?>" />
<p>
<label>Username: </label>
<input type="text" name="users[username]" value="<?php echo strtoupper($user_account->username);?>" />
</p>

<p>
<label>Account Type: </label>
<select name="users[type]">
<option value="<?php echo $user_account->type;?>"><?php echo $user_account->type;?></option>
<option value="Administrator">Administrator</option>
<option value="Principal">Principal</option>
<option value="HR">HR</option>
<option value="Accountant">Accountant</option>
<option value="Registrar">Registrar</option>
<option value="Teacher">Teacher</option>
</select>
</p>

<p>
<label>Staff FullName: </label>
<select name="users[staff_id]">
<option value="<?php echo $user_account->staff_id;?>"><?php echo strtoupper($staff_name->full_name);?></option> 
<?php foreach($staffs as $staff):?>
<option value="<?php echo $staff->id;?>"><?php echo htmlspecialchars(strtoupper($staff->full_name));?></option>
<?php endforeach;?>
</select>
</p>
<p>
<input class="submit" type="submit" name="submit" value="Submit" />
</p>
</fieldset>

</form>







</div>


<?php include_once(VIEW_PATH. 'layout/_footer.php');?>