<?php

$title = 'Students';
include_once(VIEW_PATH. 'layout/_header.php');
?>

<?php include_once(VIEW_PATH. 'layout/Accountant/_nav.php'); ?>
<div id = "mainContent" style="height: 40em;">
<div id="stdMenu">
    <ul id="one" class="horiz">
    <li><a href="#" onmouseover="setMenu('subThree')" onmouseout="clearMenu('subThree')">Status</a></li>
    
    </ul>
    
    <ul id="subThree" class="vert" onmouseover="setMenu('subThree')" onmouseout="clearMenu('subThree')" style="left:22px;">
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>students/index?status=Active">Active</a></li>
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>students/index?status=Inactive">Inactive</a></li>
    
    </ul>
</div>

<?php if(!empty($students)):?>
<h3 class="title">Students Profile</h3>

<?php endif;?>
<?php echo flash_message($session->get_message());?>

<?php if(!empty($students)):?>
<div id="indexSearchBox">
<form action="<?php echo '/'. APP_ROOT.'/';?>students/class_students" method="post">
<fieldset>
Search by:&nbsp;
Class 
<select name="class">
<option value="">Select Class</option>
<?php foreach($classes as $class): ?>
<option value="<?php echo $class->id;?>"><?php echo strtoupper($class->title);?></option>
<?php endforeach; ?>
</select>

<input class="image" type="image" src="<?php echo WEBSITE.DS. APP_ROOT.DS. 'images/search.png';?>" />
</fieldset> 
</form>
</div>


<div id="navLinks">
<?php if($pagination->total_pages()>1){
   
    if($pagination->has_prev()){
    
    echo '<p><a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'students?status='.$status.'&page=1><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/first.png /></a>
    &nbsp&nbsp<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'students?status='.$status.'&page='. $pagination->prev_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/previous.png /></a>';
    echo '&nbsp&nbsp&nbsp&nbsp';
    }else{echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'; }
    if($pagination->has_next()){
    echo '<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'students?status='.$status.'&page='. $pagination->next_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/next.png /></a>
    &nbsp&nbsp<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'students?status='.$status.'&page='. $pagination->total_pages(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/last.png /></a></p>';
    
    }else{echo '&nbsp&nbsp&nbsp&nbsp&nbsp</p>'; }
} 
?>

</div>
<br class="clear" />
<?php foreach($students as $student):?>
<form action="#" method="post">
<fieldset class="indexStudent">
<legend>Student Details</legend>
<input type="hidden" name="students[id]" value="<?php echo $student->id; ?>" />
<p><label>Surname</label><input name = "surname" type="text" value="<?php echo htmlspecialchars (strtoupper($student->surname)); ?>"  disabled="disabled"/></p>
<p><label>First Name</label><input name = "firstName" type="text" value="<?php echo htmlspecialchars (strtoupper($student->first_name)); ?>" disabled="disabled" /></p>
<p><label>Other Names</label><input name = "otherNames" type="text" value="<?php echo htmlspecialchars (strtoupper($student->other_names)); ?>" disabled="disabled" /></p>

<p class="edit">
<a href="<?php echo '/'. APP_ROOT. '/students/show?id='. $student->id;?>" target="_blank" >[View Profile]</a>&nbsp;&nbsp;
<a href="<?php echo '/'. APP_ROOT.'/';?>payments/show?id=<?php echo $student->id; ?>" target="_blank" >[View Payments]</a>
</p>
</fieldset>
</form>
<div class="stdIndexPhoto"><img src = "<?php echo WEBSITE.DS. APP_ROOT.DS. 'photos/students/' . $student->id.'.jpg';?>" alt="student photo" width="200px" height="150px" /></div><br class="clear" />


<?php endforeach; ?>
<?php else:?>
<div id="emptyResult">

<h3>No Student Found</h3>
</div>
<?php endif;?>
</div>



<?php
include_once(VIEW_PATH. 'layout/_footer.php');
?>