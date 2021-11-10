<div id = "mainNav" style="height: 35em;">
<?php 

$id = $_SESSION['user_id'];
$found_user = users::find_by_id($id);

?>

<ul>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>parents/new" id="admission">Admissions</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>students/" id="student">Students</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>parents/" id="parent">Parents</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>staff/" id="staff">Staff</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>classes/" id="classes">Classes</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>houses/" id="houses">Houses</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>staff/show?id=<?php echo $found_user->staff_id;?>" id="profile">Profile</a></li>
<li><a class="nav" href="<?php echo '/'. APP_ROOT.'/';?>users/logout" id="logOut" onclick="return confirm('Do you want to Log Out?')">Log Out</a></li>
</ul>
<p class="loggedIn">Logged In: <?php echo $found_user->username. ' -  '. $found_user->type; ?></p>
</div>