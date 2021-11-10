<?php

$title = 'Parent - Children';
include_once(VIEW_PATH. 'layout/_header.php');
?>

<?php include_once(VIEW_PATH. 'layout/Accountant/_nav.php'); ?>
<div id = "mainContent" style="height: 42em;">

<?php if(!empty($students)):?>
<div class="child"><p>The Child/Children of <?php echo ucwords($parent->full_name);?></p></div>
<div id="stdnavLinks">
<?php if($pagination->total_pages()>1){
   
    if($pagination->has_prev()){
    
    echo '<p><a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'parents/students?id='.$id.'&page='. $pagination->prev_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/previous.png /></a>';
    echo '&nbsp&nbsp&nbsp&nbsp';
    }else{echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'; }
    if($pagination->has_next()){
    echo '<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'parents/students?id='.$id. '&page='. $pagination->next_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/next.png /></a></p>';
    
    }else{echo '&nbsp&nbsp&nbsp&nbsp&nbsp</p>'; }
} 
?>

</div>
<br class="clear" />
<?php foreach($students as $student):?>
<form action="#" method="post">
<fieldset class="student">
<legend>Student Details</legend>
<input type="hidden" name="students[id]" value="<?php echo $student->id; ?>" />
<p><label>Surname</label><input name = "surname" type="text" value="<?php echo htmlspecialchars (strtoupper($student->surname)); ?>"  disabled="disabled"/></p>
<p><label>First Name</label><input name = "firstName" type="text" value="<?php echo htmlspecialchars (strtoupper($student->first_name)); ?>" disabled="disabled" /></p>
<p><label>Other Names</label><input name = "otherNames" type="text" value="<?php echo htmlspecialchars (strtoupper($student->other_names)); ?>" disabled="disabled" /></p>

<p class="edit">
<a href="<?php echo '/'. APP_ROOT. '/students/show?id='. $student->id;?>" target="_blank">[View Profile]</a>
</p>
</fieldset>
</form>
<div class="classPhoto"><img src = "<?php echo WEBSITE.DS. APP_ROOT.DS. 'photos/students/' . $student->id.'.jpg';?>" alt="student photo" width="200px" height="150px" /></div><br class="clear" />



<?php endforeach; ?>
<?php else:?>
<div id="emptyResult">
<div class="child"><p>No Child/Children Found for <?php echo $parent->full_name;?> </p></div>
</div>

<?php endif;?>
</div>



<?php
include_once(VIEW_PATH. 'layout/_footer.php');
?>