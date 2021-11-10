<?php

$title = 'Second Term Comments';

include_once(VIEW_PATH. 'layout/_header.php');
?>

<?php include_once(VIEW_PATH. 'layout/Teacher/_nav.php');?>

<div id = "mainContent" style="height: 47em;">
<br />
<br />

<?php if(!empty($comments)):?>
<h3 class="editTitle">Class teacher's second term comments for class <?php echo strtoupper($class->title);?> students </h3>
<div id="new"><p><a href="<?php echo '/'. APP_ROOT.'/';?>second_term_comments/new?id=<?php echo $class->id?>">New second term comments</a></p></div>
<div id="navLinks">
<?php if($pagination->total_pages()>1){
    
    if($pagination->has_prev()){
    
    echo '<p><a class = "navLinks" href ='. '/'. APP_ROOT.'/'."second_term_comments/index?id=$class->id". '&page='. $pagination->prev_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/previous.png /></a>';
    echo '&nbsp&nbsp&nbsp&nbsp';
    }else{echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'; }

    if($pagination->has_next()){
    echo '<a class = "navLinks" href ='. '/'. APP_ROOT.'/'."second_term_comments/index?id=$class->id".'&page='. $pagination->next_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/next.png /></a></p>';
    
    }else{echo '&nbsp&nbsp&nbsp&nbsp&nbsp</p>'; }


} 
?>

</div>

<?php foreach($comments as $comment):?>
<div id="viewComment">
<form>
<fieldset>
<p>
<label>Student Name</label>
<?php $class_student = array_shift(Student::find_by_sql("SELECT first_name, surname, other_names FROM students WHERE id=". $comment->student_id));?>
<input class="name" type="text" name="student" value="<?php echo htmlspecialchars(strtoupper($class_student->first_name. ' '. $class_student->surname));?>" disabled="disabled" />
</p>
<p>
<label>Attendance</label>
<input type="text" name="attendance" value="<?php echo $comment->attendance;?>" disabled="disabled" />
</p>

<p>
<label>Remark</label>
<textarea cols="25" rows="4" disabled="disabled"><?php echo $comment->remark;?></textarea>
</p>
</fieldset>
</form>
</div>
<?php endforeach;?>

<?php else:?>
<div style="height: 40em; text-align: left; margin-left: 6em;"><p><a href="<?php echo '/'. APP_ROOT.'/';?>second_term_comments/new?id=<?php echo $class->id?>">New second term comments</a></p></div>
<?php endif;?>
</div>


<?php include_once(VIEW_PATH. 'layout/_footer.php');?>