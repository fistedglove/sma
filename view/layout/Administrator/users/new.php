<?php
$title = 'New User';

include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/Administrator/_nav.php');?>

<div id="mainContent" style="height: 32em;">
<h3 class="title">New User Accounts</h3>
<div id="userMsg"><?php echo flash_warning($session->get_message());?></div>
        

<form action="<?php echo '/'. APP_ROOT.'/';?>users/new" method="post">
<fieldset class="user" >
<legend>Create User</legend>
<p>
<label>Username: </label>
<input type="text" name="users[username]" value="" />
</p>

<p>
<label>Password: </label>
<input type="password" name="users[password]" value="" />
</p>
<p>
<label>Account Type: </label>
<select name="users[type]">
<option value="">Select Type</option>
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
<option value="">Select  Staff </option> 
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