<?php 

$title = 'Staff';

include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>

<div id = "mainContent" style="height: 40em;">

<div id="stdMenu">
    <ul id="one" class="horiz">
    <li><a href="#" onmouseover="setMenu('subThree')" onmouseout="clearMenu('subThree')">Status</a></li>
    
    </ul>
    
    <ul id="subThree" class="vert" onmouseover="setMenu('subThree')" onmouseout="clearMenu('subThree')" style="left:22px;">
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>staff/index?status=Active">Active</a></li>
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>staff/index?status=Inactive">Inactive</a></li>
    
    </ul>
</div>



<?php if(!empty($staffs)):?>
<div id="indexSearchBox">
<form action="<?php echo '/'. APP_ROOT.'/';?>staff/search" method="post">
<fieldset class="parent">
Surname:&nbsp; 
<input type="text" name="surname" value="" />

<input class="image" type="image" src="<?php echo WEBSITE.DS. APP_ROOT.DS. 'images/search.png';?>" />
</fieldset> 
</form>
</div>
<h3 class="title">Staff Profile</h3>
<div id="navLinks">
<?php if($pagination->total_pages()>1){
    
    if($pagination->has_prev()){
    
    echo '<p><a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'staff?status='.$status.'&page=1><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/first.png /></a>
    &nbsp&nbsp<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'staff?status='.$status.'&page='. $pagination->prev_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/previous.png /></a>';
    echo '&nbsp&nbsp&nbsp&nbsp';
    }else{echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'; }
    if($pagination->has_next()){
    echo '<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'staff?status='.$status.'&page='. $pagination->next_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/next.png /></a>
    &nbsp&nbsp<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'staff?status='.$status.'&page='. $pagination->total_pages(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/last.png /></a>
</p>';
    
    }else{echo '&nbsp&nbsp&nbsp&nbsp&nbsp</p>'; }
} 
?>

</div>
<div id="staffIndexMsg"><?php echo flash_message($session->get_message());?></div>
<?php foreach($staffs as $staff):?>
<form action="#" method="post">
<fieldset class="indexStaff">
<legend>Staff Details</legend>
<input type="hidden" name="staff[id]" value="<?php echo $staff->id; ?>" />
<p><label>Surname</label><input name ="staff[surname]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->surname)); ?>" disabled="disabled" /></p>
<p><label>First Name</label><input name ="staff[first_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->first_name)); ?>" disabled="disabled" /></p>
<p><label>Full Name</label><input name ="staff[full_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($staff->full_name)); ?>" disabled="disabled" /></p>

<p class="edit">
<a href="<?php echo '/'. APP_ROOT.'/';?>staff/show?id=<?php echo $staff->id?>" target="_blank">[View Profile]</a>&nbsp;&nbsp;

<?php if($staff->post == 'teacher'):?>
<a href="<?php echo '/'. APP_ROOT.'/';?>teacher_timetable/index?id=<?php echo $staff->id;?>" target="_blank" >[View Timetable]</a>&nbsp;&nbsp;
<?php endif;?>

</p>
</fieldset>
</form>
<div class="staffIndexPhoto"><img src = "<?php echo WEBSITE.DS. APP_ROOT.DS. 'photos/staff/' . $staff->id.'.jpg';?>" alt="Staff photo" width="200px" height="150px" /></div><br class="clear" />

<?php endforeach; ?>
<?php else:?>
<div id="emptyResult">
<h3>No Staff Found!</h3>
</div>
<?php endif;?>
</div>
<?php include_once(VIEW_PATH. 'layout/_footer.php');?>