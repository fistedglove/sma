<?php

$title = 'Student Profile';

include_once(VIEW_PATH. 'layout/_header.php');
?>

<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>

<div id = "mainContent">
<div id="stdMenu">
    <ul id="one" class="horiz">
    <li><a href="#" onmouseover="setMenu('subThree')" onmouseout="clearMenu('subThree')">Results</a></li>
    </ul>
    
    <ul id="subThree" class="vert" onmouseover="setMenu('subThree')" onmouseout="clearMenu('subThree')" style="left:22px;">
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>first_term_scores/show?id=<?php echo $student->id?>" target="_blank">First Term</a></li>
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>second_term_scores/show?id=<?php echo $student->id?>" target="_blank" >Second Term</a></li>
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>third_term_scores/show?id=<?php echo $student->id?>" target="_blank">Third Term</a></li>
    </ul>
</div>
<h3 class="title">Student Profile</h3>
<div id="classMsg"><?php echo flash_message($session->get_message());?></div>
<form action="#" method="post">
<fieldset class="showStudent">
<legend>Student Details</legend>
<input type="hidden" name="students[id]" value="<?php echo $student->id; ?>" />
<p><label>Surname</label><input name = "students[surname]" type="text" value="<?php echo htmlspecialchars(strtoupper($student->surname)); ?>"  disabled="disabled"/></p>
<p><label>First Name</label><input name = "students[first_name]" type="text" value="<?php echo htmlspecialchars(strtoupper( $student->first_name)); ?>" disabled="disabled" /></p>
<p><label>Other Names</label><input name = "students[other_names]" type="text" value="<?php echo htmlspecialchars(strtoupper( $student->other_names)); ?>" disabled="disabled" /></p>
<p><label>Date of Birth</label><input name = "students[dob]" type="text" value="<?php echo htmlspecialchars(strtoupper(displayed_date($student->dob))); ?>" disabled="disabled" /></p>
<p><label>Gender</label><input type="text" name = "students[gender]" value = "<?php echo htmlspecialchars(strtoupper( $student->gender)); ?>" disabled="disabled" /></p>
<p><label>Nationality</label><input name = "students[nationality]" type="text" value="<?php echo htmlspecialchars(strtoupper( $student->nationality)); ?>" disabled="disabled" /></p>
<p><label>Parent</label><input name = "students[parent_id]" type="text" value="<?php $parent = Parents::find_by_id($student->parent_id); if($student->parent_id !=0){echo htmlspecialchars (strtoupper( $parent->full_name));}?>" disabled="disabled" /></p>
<p><label>Class</label><input name ="students[class_id]" type="text" value="<?php $class = classes::find_by_id($student->class_id);if($student->class_id !=0)echo htmlspecialchars (strtoupper( $class->title));?>" disabled="disabled" /></p>
<p><label>House</label><input name = "students[house_id]" type="text" value="<?php $house = houses::find_by_id($student->house_id); if($student->house_id !=0) echo htmlspecialchars (strtoupper( $house->house_title)); ?>" disabled="disabled" /></p>
<p><label>Admission Date</label><input name = "students[admission_date]" type="text" value="<?php echo strtoupper(displayed_date($student->admission_date)); ?>" disabled="disabled" /></p>
<p><label>Satus</label><input name = "students[status]" type="text" value="<?php echo htmlspecialchars(strtoupper( $student->status)); ?>" disabled="disabled" /></p>
<?php if(isset($student->grad_year)&& (int)$student->grad_year!= 0):  ?>
<p><label>Graduation Date</label><input name = "students[grad_year]" type="text" value="<?php echo htmlspecialchars(strtoupper(displayed_date($student->grad_year))); ?>" disabled="disabled" /></p>
<?php endif;?>
<p class="edit">
<a href="<?php echo '/'. APP_ROOT.'/';?>students/edit?id=<?php echo $student->id?>">[Edit Profile]</a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo '/'. APP_ROOT.'/';?>parents/new"  target="_blank">[Register New Student]</a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo '/'. APP_ROOT.'/';?>parents/show?id=<?php echo $student->parent_id; ?>" target="_blank" >[View Parents]</a>
</p>
</fieldset>
</form>
<div class="stdPhoto"><img src = "<?php echo WEBSITE.DS. APP_ROOT.DS. 'photos/students/' . $student->id.'.jpg';?>" alt="student photo" width="200px" height="150px" /></div><br class="clear" />

</div>



<?php
include_once(VIEW_PATH. 'layout/_footer.php');
?>