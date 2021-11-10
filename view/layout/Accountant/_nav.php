<div id = "mainNav">
<ul>
<?php 

$id = $_SESSION['user_id'];
$found_user = users::find_by_id($id);

?>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>parents/" id="parent">Parents</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>students/" id="student">Students</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>classes/" id="classes">Classes</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>payments/new" id="payments">Payments</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>staff/show?id=<?php echo $found_user->staff_id;?>" id="profile">Profile</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>users/logout" id="logOut" onclick="return confirm('Do you want to Log Out?')">Log Out</a></li>
</ul>
<p class="loggedIn">Logged In: <?php echo $found_user->username. ' '. $found_user->type; ?></p>
</div>