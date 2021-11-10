<?php 
 
 $title = 'View Logs';
include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/Administrator/_nav.php'); ?>

<div id = "mainContent">
<h3 class="title">Event Logs</h3>
<div class="clearLog"><a href="<?php echo '/'. APP_ROOT.'/';?>logs/show?clear=true" onclick="return confirm('Do you want to Clear Logs?')">[Clear Logs]</a></div>
<div id="searchBox">
<form action="<?php echo '/'. APP_ROOT.'/';?>logs/show" method="post">
<fieldset>
Logs Backup:
<select name="backup" class="search">
<?php if(isset($backup_file)):?>
<option value=""><?php echo $backup_file;?></option>
<option value="">Current Log</option>
<?php else:?>
<option value="">Select Backup</option>
<?php endif;?>
<?php foreach($backups as $backup): ?>
<?php if(($backup != '.') && ($backup != '..')):?>
<option value="<?php echo $backup;?>"><?php echo $backup;?></option>
<?php endif;?>
<?php endforeach; ?>
</select>

<input class="image" type="image" src="<?php echo WEBSITE.DS. APP_ROOT.DS. 'images/search.png';?>" />
</fieldset> 
</form>
</div>

<div id="logs" >

<table class="logs">
<thead>
<th>Event</th>
<th>Details</th>
<th>Date and Time</th>
</thead>
<tbody>
<?php echo $contents;?>

</tbody>
</table>
</div>



</div>
<?php include_once(VIEW_PATH. 'layout/_footer.php');?>