<?php 

$title = 'Admin Tasks';

include_once(VIEW_PATH. 'layout/_header.php');

 ?>
 <?php include_once(VIEW_PATH. 'layout/Administrator/_nav.php'); ?>
 
 <div id="mainContent" style="height: 32em;">
 <h3 class="title">Administrator Tasks</h3>
 
 <div id="academicYear">
<form action="<?php echo '/'. APP_ROOT.'/';?>tasks/academic_year" method="post">
<p><a href="#">
Change Academic Year:
<input type="text" name="academic_year" value="" />
</a>
<input class="image" type="image" onclick="return confirm('Do you want to set Academic Year?')" src="<?php echo WEBSITE.DS. APP_ROOT.DS. 'images/go.png';?>" />
</p>
</form>
</div>
 
 
 
 <div id="dbPass">
<form action="<?php echo '/'. APP_ROOT.'/';?>tasks/db_pass" method="post">
<p><a href="#">
Change DB Password:
<input type="password" name="db_password" value="" />
</a>
<input class="image" type="image" onclick="return confirm('Do you want to change Database Password?')" src="<?php echo WEBSITE.DS. APP_ROOT.DS. 'images/go.png';?>" />
</p>
</form>
</div>
 
 
 <div id="searchBox">
<form action="<?php echo '/'. APP_ROOT.'/';?>tasks/" method="post">
<fieldset class="tasks">
Restore Backup:
<select name="restore" class="restore">
<?php if(isset($backup_file)):?>
<option value=""><?php echo $backup_file;?></option>
<?php else:?>
<option value="">Select Backup</option>
<?php endif;?>
<?php foreach($backups as $backup): ?>
<?php if(($backup != '.') && ($backup != '..')):?>
<option value="<?php echo $backup;?>"><?php echo $backup;?></option>
<?php endif;?>
<?php endforeach; ?>
</select>

<input class="image" type="image" onclick="return confirm('Do you want to restore backup? Make sure you backup current term Data before you restore!')" src="<?php echo WEBSITE.DS. APP_ROOT.DS. 'images/search.png';?>" />
</fieldset> 
</form>
</div>
 
<div class="taskMsg"><?php echo flash_message($session->get_message());?></div>
 
 <ul class="tasks">
 <li><a href="<?php echo '/'. APP_ROOT.'/';?>tasks/backup" onclick="return confirm('Do you want to backup current term data?')">Backup Current Term Data</a></li>
 <li><a href="<?php echo '/'. APP_ROOT.'/';?>tasks/results" onclick="return confirm('Do you want to clear out Results Data?')">Clear out the Terms Results Table</a></li>
 <li><a href="<?php echo '/'. APP_ROOT.'/';?>tasks/comments" onclick="return confirm('Do you want to clear out Comments Data?')">Clear out the Terms Comments Table</a></li>
 <li><a href="<?php echo '/'. APP_ROOT.'/';?>tasks/payments" onclick="return confirm('Do you want to clear out Payments Data?')">Clear out the Payments Table</a></li>
 </ul>
 
 
 
 
 
 </div>
 <?php include_once(VIEW_PATH. 'layout/_footer.php'); ?>