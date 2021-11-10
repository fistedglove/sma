<?php
$title = 'Users';

include_once(VIEW_PATH. 'layout/_header.php');

?>


<?php include_once(VIEW_PATH. 'layout/Administrator/_nav.php');?>

<div id="mainContent" style="height: 38em;">
<h3 class="title">User Accounts</h3>
<div id="userIndexMsg"><?php echo flash_message($session->get_message());?></div>
<?php if(!empty($users)):?>
<div id="navLinks">
<?php if($pagination->total_pages()>1){
    
    if($pagination->has_prev()){
    
    echo '<p><a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'users?page='. $pagination->prev_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/previous.png /></a>';
    echo '&nbsp&nbsp&nbsp&nbsp';
    }else{echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'; }
    if($pagination->has_next()){
    echo '<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'users?page='. $pagination->next_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/next.png /></a></p>';
    
    }else{echo '&nbsp&nbsp&nbsp&nbsp&nbsp</p>'; }
} 
?>

</div>
        
<?php foreach($users as $user):?>
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
<fieldset class="viewUser" >
<legend>User Account</legend>
<input type="hidden" name="users[id]"  value="<?php echo $user->id;?>"/>
<p>
<label>Username: </label>
<input type="text" name="users[username]" value="<?php echo htmlspecialchars(strtoupper($user->username)) ;?>" disabled="disabled" />
</p>

<p>
<label>Account Type: </label>
<input type="text" name="users[type]" value="<?php echo htmlspecialchars(strtoupper($user->type)) ;?>" disabled="disabled" />
</p>
<?php $staff_name = Staff::find_by_id($user->staff_id);?>
<?php if(!empty($staff_name)):?>
<p>
<label>Staff Name: </label>
<input type="text" name="users[staff_id]" value="<?php echo htmlspecialchars(strtoupper($staff_name->full_name)) ;?>" disabled="disabled" />
</p>
<?php endif;?>
<p class="edit">
<a href="<?php echo '/'. APP_ROOT.'/';?>users/edit_user?id=<?php echo $user->id;?>">[Edit User]</a>&nbsp;&nbsp;
<?php if($user->type != 'Administrator'):?>
<?php if($user->status == 'Enabled'):?>
<a href="<?php echo '/'. APP_ROOT.'/';?>users/disable?id=<?php echo $user->id;?>" onclick="return confirm('Do you want to Disable User Account?')">[Disable User]</a>&nbsp;&nbsp;
<?php elseif ($user->status == 'Disabled'):?>
<a href="<?php echo '/'. APP_ROOT.'/';?>users/enable?id=<?php echo $user->id;?>" onclick="return confirm('Do you want to Enable User Account?')">[Enable User]</a>&nbsp;&nbsp;
<?php endif;?>
<a href="<?php echo '/'. APP_ROOT.'/';?>users/delete?id=<?php echo $user->id;?>" onclick="return confirm('Do you want to Delete User Account?')">[Delete User]</a>&nbsp;&nbsp;
<?php endif;?>
</p>
</fieldset>

</div>

<?php endforeach;?>
<?php else:?>
<div id="emptyResult">
<h3>No Users Found!</h3>

</div>
<?php endif;?>
</div>

<?php include_once(VIEW_PATH. 'layout/_footer.php');?>