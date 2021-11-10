<?php 

$title = 'Classes';

include_once(VIEW_PATH. 'layout/_header.php');

 ?>

<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>


<div id = "mainContent" style="height: 35em;">

<?php if(!empty($classes)):?>
<h3 class="title">Classes Details</h3>
<?php endif;?>

<p class="new"><a href="<?php echo '/'. APP_ROOT.'/';?>Classes/new ">[New Class]</a></p>
<?php if(!empty($classes)):?>
<div id="navLinks">
<?php if($pagination->total_pages()>1){
    
    if($pagination->has_prev()){
    
    echo '<p><a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'classes?page=1><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/first.png /></a>
    &nbsp&nbsp<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'classes?page='. $pagination->prev_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/previous.png /></a>';
    echo '&nbsp&nbsp&nbsp&nbsp';
    }else{echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'; }
    if($pagination->has_next()){
    echo '<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'classes?page='. $pagination->next_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/next.png /></a>
    &nbsp&nbsp<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'classes?page='. $pagination->total_pages(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/last.png /></a></p>';
    
    }else{echo '&nbsp&nbsp&nbsp&nbsp&nbsp</p>'; }

} 
?>

</div>
<div class="houseMsg"><?php echo flash_message($session->get_message());?></div>
<form action="#" method="post" >

<?php foreach ($classes as $class):?>
<?php static $i = 0; $i++; 
    switch($i){
    case 1:
    $div = 'one';
    break;
    case 2:
    $div = 'two';
    break;
    case 3:
    $div = 'three';
    break;
    case 4:
    $div = 'four';
    break;
    case 5:
    $div = 'five';
    break;
    case 6:
    $div = 'six';
    break;
    
}?>
<div class="<?php echo $div;?>">
<fieldset class="class">
<legend>Classes</legend>

<p><label>Title</label><input type="text" name="classes[title]" value="<?php echo strtoupper($class->title); ?>" disabled="disabled" /></p>
<p><label>Class Teacher</label>
<input type="text" name="classes[teacher_id]" value="<?php if($staff = Staff::find_by_id($class->teacher_id)){echo htmlspecialchars (strtoupper( $staff->full_name));}?>" disabled="disabled" />
</p>
<p class="edit_class"><a href="<?php echo '/'. APP_ROOT.'/';?>classes/edit?id=<?php echo $class->id;?>">[Edit]</a> &nbsp; 
<a href="<?php echo '/'. APP_ROOT.'/';?>students/class_students?id=<?php echo $class->id;?> ">[View Students]</a>&nbsp; 
<a href="<?php echo '/'. APP_ROOT.'/';?>class_timetable/index?id=<?php echo $class->id;?>" target="_blank">[View Timetable]</a>&nbsp; 
<a href="<?php echo '/'. APP_ROOT.'/';?>class_timetable/new?id=<?php echo $class->id;?>">[Create Timetable]</a>

</p>

</fieldset>
</div>
<?php endforeach;?>

</form>
<?php else:?>
<div id="emptyResult">
<h3>No Class Found!</h3>
</div>
<?php endif;?>
</div>

<?php include_once(VIEW_PATH. 'layout/_footer.php'); ?>