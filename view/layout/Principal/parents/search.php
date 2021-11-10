<?php 

$title = 'Search Parent';
include_once(VIEW_PATH. 'layout/_header.php');

?>

<?php include_once(VIEW_PATH. 'layout/Principal/_nav.php'); ?>

<div id = "mainContent">

<h3 class="title">Parents Profile</h3>

<?php if(!empty($parents)):?>
<?php foreach($parents as $parent):?>
<form action="<?php echo '/'. APP_ROOT.'/';?>parents/edit?id=<?php echo $parent->id; ?>" method="post">
<fieldset class="viewParent">
<legend>Edit Parent Details</legend>
<input type="hidden" name="parents[id]" value="<?php echo htmlspecialchars($parent->id); ?>" />
<p><label>Full Name:</label><input name = "parents[full_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($parent->full_name)); ?>" disabled="disabled" /></p>
<p><label>Surname:</label><input name = "parents[surname]" type="text" value="<?php echo htmlspecialchars (strtoupper($parent->surname)); ?>" disabled="disabled" /></p>
<p><label>Email:</label><input name = "parents[email_address" type="text" value="<?php echo htmlspecialchars($parent->email_address); ?>" disabled="disabled" /></p>

<p class="edit">
<a href="<?php echo '/'. APP_ROOT.'/';?>parents/show?id=<?php echo $parent->id?>"  target="_blank">[View Profile]</a>&nbsp;&nbsp;
<a href="<?php echo '/'. APP_ROOT.'/';?>parents/students?id=<?php echo $parent->id?>" target="_blank">[View Child/Children]</a>
</p>
</fieldset>
</form>

<div class="parentPhoto"><img src = "<?php echo WEBSITE.DS. APP_ROOT.DS. 'photos/parents/' . $parent->id.'.jpg';?>" alt="Parent photo" width="200px" height="170px" /></div><br class="clear" />

<?php endforeach; ?>

<?php endif;?>
</div>



<?php include_once(VIEW_PATH. 'layout/_footer.php');?>
