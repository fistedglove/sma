<?php 

$title = 'School Management System - Homepage';



include_once(VIEW_PATH. 'layout/_header.php');

?>

<?php include_once(VIEW_PATH. 'layout/Principal/_nav.php');?>

<div id = "mainContent">




<h2>Welcome to the School Management System Homepage!</h2>
<h3>ACADEMIC YEAR: <?php echo ACADEMIC_YEAR;?></h3>
<div class="homepageMsg"><?php echo flash_message($session->get_message());?></div>
<div id="homePage"><img  src="<?php echo WEBSITE.DS. APP_ROOT.DS. 'images/homepage.jpg';?>"/></div>



</div>

<?php include_once(VIEW_PATH. 'layout/_footer.php');?>
