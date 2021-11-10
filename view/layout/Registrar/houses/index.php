<?php 

$title = 'Houses';

include_once(VIEW_PATH. 'layout/_header.php');

 ?>

<?php include_once(VIEW_PATH. 'layout/Registrar/_nav.php'); ?>


<div id = "mainContent" style="height: 35em;">

<?php if(!empty($houses)):?>
<h3 class="title">Houses Details</h3>
<?php endif;?>


<p class="new"><a href="<?php echo '/'. APP_ROOT.'/';?>houses/new ">[New House]</a></p>

<?php if(!empty($houses)):?>
<div id="navLinks">
<?php if($pagination->total_pages()>1){
    
    if($pagination->has_prev()){
    
    echo '<p><a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'houses?page=1><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/first.png /></a>&nbsp&nbsp
    <a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'houses?page='. $pagination->prev_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/previous.png /></a>';
    echo '&nbsp&nbsp&nbsp&nbsp';
    }else{echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'; }
    if($pagination->has_next()){
    echo '<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'houses?page='. $pagination->next_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/next.png /></a>
    &nbsp&nbsp<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'houses?page='. $pagination->total_pages(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/last.png /></a></p>';
    
    }else{echo '&nbsp&nbsp&nbsp&nbsp&nbsp</p>'; }

} 
?>

</div>
<div class="houseMsg"><?php echo flash_message($session->get_message());?></div>
<form action="#" method="post" >

<?php foreach ($houses as $house):?>
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
<legend>House Details</legend>
<p><label>Title</label><input type="text" name="houses[house_title]" value="<?php echo strtoupper($house->house_title); ?>" disabled="disabled" /></p>
<p><label>House Leader</label>
<input type="text" name="houses[house_leader]" value="<?php if($staff = Staff::find_by_id($house->house_leader)){echo htmlspecialchars (strtoupper( $staff->full_name));}?>" disabled="disabled" />
</p>
<p class="edit_class"><a href="<?php echo '/'. APP_ROOT.'/';?>houses/edit?id=<?php echo $house->id;?> ">[Edit]</a> &nbsp; 
<a href="<?php echo '/'. APP_ROOT.'/';?>students/house_members?id=<?php echo $house->id;?> ">[View Members]</a>&nbsp; 
</p>

</fieldset>
</div>
<?php endforeach;?>

</form>
<?php else:?>
<div id="emptyResult">
<h3>No House Found</h3>
</div>
<?php endif;?>
</div>

<?php include_once(VIEW_PATH. 'layout/_footer.php'); ?>