<?php

$title = 'Class Students';

include_once(VIEW_PATH. 'layout/_header.php');
?>

<?php include_once(VIEW_PATH. 'layout/Teacher/_nav.php');?>

<div id = "mainContent" style="height: 42em;">



<div id="stdMenu">
    <ul id="one" class="horiz">
    
    <li><a href="#" onmouseover="setMenu('subTwo')" onmouseout="clearMenu('subTwo')">comments</a></li>
    </ul>

    
    <ul id="subTwo" class="vert" onmouseover="setMenu('subTwo')" onmouseout="clearMenu('subTwo')" style="left: 22px;">
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>first_term_comments/index?id=<?php echo $class->id;?>" target="_blank">First Term</a></li>
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>second_term_comments/index?id=<?php echo $class->id;?>" target="_blank">Second Term</a></li>
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>third_term_comments/index?id=<?php echo $class->id;?>" target="_blank">Third Term</a></li>
    </ul>
    
    
</div>

<?php if(!empty($students)):?>
<h3 class="titleClass">Class <?php echo strtoupper($class->title); ?> Students</h3>

<div id="classStdMsg"><?php echo flash_message($session->get_message());?></div>

<div id="stdnavLinks">

<?php if($pagination->total_pages()>1){
   
    if($pagination->has_prev()){
    
    echo '<p><a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'students/class_students?id='.$class->id. '&page='. $pagination->prev_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/previous.png /></a>';
    echo '&nbsp&nbsp&nbsp&nbsp';
    }else{echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'; }
    if($pagination->has_next()){
    echo '<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'students/class_students?id='.$class->id. '&page='. $pagination->next_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/next.png /></a></p>';
    
    }else{echo '&nbsp&nbsp&nbsp&nbsp&nbsp</p>'; }
} 
?>
</div>




<?php foreach($students as $student):?>
<form action="#" method="post">
<fieldset class="classStudent">
<legend>Student Details</legend>
<input type="hidden" name="students[id]" value="<?php echo $student->id; ?>" />
<p><label>Surname</label><input name = "surname" type="text" value="<?php echo htmlspecialchars (strtoupper($student->surname)); ?>"  disabled="disabled"/></p>
<p><label>First Name</label><input name = "firstName" type="text" value="<?php echo htmlspecialchars (strtoupper($student->first_name)); ?>" disabled="disabled" /></p>
<p><label>Other Names</label><input name = "otherNames" type="text" value="<?php echo htmlspecialchars (strtoupper($student->other_names)); ?>" disabled="disabled" /></p>
<p class="edit"><a href="<?php echo '/'. APP_ROOT. '/students/show?id='. $student->id;?>" target="_blank">[View Profile]</a></p>


</fieldset>
</form>
<div class="classStdPhoto"><img src = "<?php echo WEBSITE.DS. APP_ROOT.DS. 'photos/students/' . $student->id.'.jpg';?>" alt="student photo" width="200px" height="150px" /></div><br class="clear" />



<?php endforeach; ?>
<?php else:?>
 <div id="emptyResult">
 <h3 style="margin-right: 9em;">No Student Found!</h3>
 </div>
 <?php endif;?>
</div>



<?php
include_once(VIEW_PATH. 'layout/_footer.php');
?>