<?php

$title = 'House Members';

include_once(VIEW_PATH. 'layout/_header.php');
?>

<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php');?>

<div id = "mainContent" style="height: 38em;">


<?php if(!empty($students)):?>
<div id="stdnavLinks">

<?php if($pagination->total_pages()>1){
   
    if($pagination->has_prev()){
    
    echo '<p><a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'students/house_members?id='.$house->id. '&page='. $pagination->prev_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/previous.png /></a>';
    echo '&nbsp&nbsp&nbsp&nbsp';
    }else{echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'; }
    if($pagination->has_next()){
    echo '<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'students/house_members?id='.$house->id. '&page='. $pagination->next_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/next.png /></a></p>';
    
    }else{echo '&nbsp&nbsp&nbsp&nbsp&nbsp</p>'; }

} 
?>
</div>
<h3 class="houseTitle">Members of <?php echo strtoupper($house->house_title); ?> House </h3>
<div id="classStdMsg"><?php echo flash_message($session->get_message());?></div>

<?php foreach($students as $student):?>
<form action="#" method="post">
<fieldset class="classStudent">
<legend>Student Details</legend>
<input type="hidden" name="students[id]" value="<?php echo $student->id; ?>" />
<p><label>Surname</label><input name = "surname" type="text" value="<?php echo htmlspecialchars (strtoupper($student->surname)); ?>"  disabled="disabled"/></p>
<p><label>First Name</label><input name = "firstName" type="text" value="<?php echo htmlspecialchars (strtoupper($student->first_name)); ?>" disabled="disabled" /></p>
<p><label>Other Names</label><input name = "otherNames" type="text" value="<?php echo htmlspecialchars (strtoupper($student->other_names)); ?>" disabled="disabled" /></p>
<p class="edit"><a href="<?php echo '/'. APP_ROOT. '/students/show?id='. $student->id;?>" target="_blank">[View Profile]</a>&nbsp;&nbsp;
</p>


</fieldset>
</form>
<div class="classStdPhoto"><img src = "<?php echo WEBSITE.DS. APP_ROOT.DS. 'photos/students/' . $student->id.'.jpg';?>" alt="student photo" width="200px" height="150px" /></div><br class="clear" />



<?php endforeach; ?>
<?php else:?>
<div id="emptyResult">
<h3>No Member Found!</h3>
</div>
<?php endif;?>
</div>



<?php
include_once(VIEW_PATH. 'layout/_footer.php');
?>