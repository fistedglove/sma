<?php 

$title = 'Parents';

include_once(VIEW_PATH. 'layout/_header.php');

?>

<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>

<div id = "mainContent">


<div id="stdMenu">
    <ul id="one" class="horiz">
    <li><a href="#" onmouseover="setMenu('subThree')" onmouseout="clearMenu('subThree')">Status</a></li>
    
    </ul>
    
    <ul id="subThree" class="vert" onmouseover="setMenu('subThree')" onmouseout="clearMenu('subThree')" style="left:22px;">
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>parents/index?status=Active">Active</a></li>
    <li><a href="<?php echo '/'. APP_ROOT.'/';?>parents/index?status=Inactive">Inactive</a></li>
    
    </ul>
</div>

<?php if(!empty($parents)):?>
<h3 class="title">Parents Profile</h3>
<?php endif;?>
<?php if(!empty($parents)):?>
<div id="indexSearchBox">
<form action="<?php echo '/'. APP_ROOT.'/';?>parents/search" method="post">
<fieldset class="parent">
Surname:&nbsp; 
<input type="text" name="surname" value="" />

<input class="image" type="image" src="<?php echo WEBSITE.DS. APP_ROOT.DS. 'images/search.png';?>" />
</fieldset> 
</form>
</div>
<div id="navLinks">
<?php if($pagination->total_pages()>1){
    
    if($pagination->has_prev()){
    
    echo '<p>
<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'parents?status='.$status.'&page=1><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/first.png /></a>
&nbsp&nbsp<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'parents?status='.$status.'&page='. $pagination->prev_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/previous.png /></a>';
    echo '&nbsp&nbsp&nbsp&nbsp';
    }else{echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'; }
    if($pagination->has_next()){
    echo '<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'parents?status='.$status.'&page='. $pagination->next_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/next.png /></a>
    &nbsp&nbsp<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'parents?status='.$status.'&page='. $pagination->total_pages(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/last.png /></a></p>';
    
    }else{echo '&nbsp&nbsp&nbsp&nbsp&nbsp</p>'; }

} 
?>

</div>


<div id="searchMsg"><?php echo flash_message($session->get_message());?></div>
<?php foreach($parents as $parent):?>
<form action="<?php echo '/'. APP_ROOT.'/';?>parents/edit?id=<?php echo $parent->id; ?>" method="post">
<fieldset class="viewParent">
<legend>Parent Details</legend>
<input type="hidden" name="parents[id]" value="<?php echo htmlspecialchars($parent->id); ?>" />
<p><label>Full Name:</label><input name = "parents[full_name]" type="text" value="<?php echo htmlspecialchars (strtoupper($parent->full_name)); ?>" disabled="disabled" /></p>
<p><label>Surname:</label><input name = "parents[surname]" type="text" value="<?php echo htmlspecialchars (strtoupper($parent->surname)); ?>" disabled="disabled" /></p>
<p><label>Address:</label><textarea name ="parents[address]" cols="23" rows="4" disabled="disabled" ><?php echo htmlspecialchars (strtoupper($parent->address)); ?></textarea></p>
<p><label>Email:</label><input name = "parents[email_address" type="text" value="<?php echo htmlspecialchars($parent->email_address); ?>" disabled="disabled" /></p>
<p><label>Telephone:</label><input type="text" name = "parents[telephone]" value = "<?php echo htmlspecialchars($parent->telephone); ?>" disabled="disabled" /></p>
<p><label>Mobile</label><input type="text" name = "parents[mobile]" value = "<?php echo htmlspecialchars($parent->mobile); ?>" disabled="disabled" /></p>
<p><label>Status</label><input name ="parents[status]" type="text" value="<?php echo htmlspecialchars (strtoupper($parent->status)); ?>" disabled="disabled" /></p>
<p class="edit"><a href="<?php echo '/'. APP_ROOT.'/';?>parents/edit?id=<?php echo $parent->id?>" >[Edit Parent Details]</a>&nbsp;&nbsp;
<a href="<?php echo '/'. APP_ROOT.'/';?>parents/students?id=<?php echo $parent->id?>">[View Child/Children]</a>
</p>
</fieldset>
</form>

<div class="parentPhoto"><img src = "<?php echo WEBSITE.DS. APP_ROOT.DS. 'photos/parents/' . $parent->id.'.jpg';?>" alt="Parent photo" width="200px" height="170px" /></div><br class="clear" />

<?php endforeach; ?>

<?php else:?>
<div id="emptyResult">
<h3>No Parent Found!</h3>
</div>
<?php endif;?>
</div>



<?php include_once(VIEW_PATH. 'layout/_footer.php');?>
