<?php 

$title = 'Search Staff';
 
include_once(VIEW_PATH. 'layout/_header.php');

?>

<?php include_once(VIEW_PATH. 'layout/HR/_nav.php'); ?>

<div id = "mainContent">

<h3 class="title">Staff Profile</h3>

<?php if(!empty($staffs)): ?>
<?php foreach($staffs as $staff):?>
<form action="<?php echo '/'. APP_ROOT.'/';?>staff/edit?id=<?php echo $staff->id; ?>" method="post">
<fieldset class="searchStaff">
<legend>staff Details</legend>
<input type="hidden" name="staff[id]" value="<?php echo htmlspecialchars($staff->id); ?>" />
<p><label>Full Name:</label><input name = "staff[full_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->full_name)); ?>" disabled="disabled" /></p>
<p><label>Surname:</label><input name = "staff[surname]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->surname)); ?>" disabled="disabled" /></p>
<p><label>Email:</label><input name = "staff[email_address" type="text" value="<?php echo htmlspecialchars($staff->email_address); ?>" disabled="disabled" /></p>

<p class="edit"><a href="<?php echo '/'. APP_ROOT.'/';?>staff/edit?id=<?php echo $staff->id?>" target="_blank" >[Edit Profile]</a>&nbsp;&nbsp;
<a href="<?php echo '/'. APP_ROOT.'/';?>staff/show?id=<?php echo $staff->id?>"  target="_blank">[View Profile]</a>

</p>
</fieldset>
</form>

<div class="searchPhoto"><img src = "<?php echo WEBSITE.DS. APP_ROOT.DS. 'photos/staff/' . $staff->id.'.jpg';?>" alt="staff photo" width="200px" height="150px" /></div><br class="clear" />

<?php endforeach; ?>
<?php endif;?>
</div>



<?php include_once(VIEW_PATH. 'layout/_footer.php');?>
