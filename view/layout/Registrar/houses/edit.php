<?php 
$title = 'Edit House';

include_once(VIEW_PATH. 'layout/_header.php');

 ?>

<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>

<div id = "mainContent" style="height: 32em;">

<h3 class="title">Edit House Details</h3>

<div class="newHouseMsg"><?php echo flash_warning($session->get_message());?></div>

<form action="<?php echo '/'. APP_ROOT.'/';?>houses/edit" method="post">
<fieldset class="house">
<legend>Edit House Details</legend>
<input type="hidden" name="houses[id]" value="<?php echo $house->id;?>" />
<p><label>Title</label><input type="text" name="houses[house_title]" value="<?php echo strtoupper($house->house_title);?>" /></p>
<p><label>House Leader</label>
<select name="houses[house_leader]">
<?php if(!empty($leader)):?>
<option value="<?php echo $leader->id;?>"><?php echo strtoupper($leader->full_name);?></option>
<?php else: ?>
<option value="">House Leader</option>
<?php endif;?>
<?php foreach($staffs as $staff):?>
<option value="<?php echo $staff->id?>"><?php echo strtoupper($staff->full_name);?></option>
<?php endforeach;?>
</select>

</p>

<p><input class="submit" type="submit" name="submit" value="Submit" /></p>

</fieldset>

</form>
</div>


<?php include_once(VIEW_PATH. 'layout/_footer.php'); ?>