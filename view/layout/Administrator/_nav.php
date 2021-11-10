<div id = "mainNav">

<?php 

$id = $_SESSION['user_id'];
$found_user = users::find_by_id($id);

?>

<ul>

<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>users/new" id="createUser">Create User</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>users/index" id="viewUsers">View Users</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>logs/show" id="viewLogs">View Logs</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>tasks/" id="tasks">Admin Tasks</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>staff/show?id=<?php echo $found_user->staff_id;?>" id="profile">Profile</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>users/logout" id="logOut" onclick="return confirm('Do you want to Log Out?')">Log Out</a></li>
</ul>
<p class="loggedIn">Logged In: <?php echo $found_user->username. ' '. $found_user->type; ?></p>
</div>