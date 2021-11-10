<!DOCTYPE html">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>

<link rel="icon" href="http://localhost/phpsms/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://localhost/phpsms/favicon.ico" type="image/x-icon" />
<link href="<?php echo WEBSITE.DS. APP_ROOT.DS. 'stylesheets/main.css';?>" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo WEBSITE.DS. APP_ROOT.DS. 'stylesheets/jsDatePick_ltr.min.css';?>" rel="stylesheet" type="text/css" media="all" />
<!--[if gte IE 7]>
<link href="<?php echo WEBSITE.DS. APP_ROOT.DS. 'stylesheets/IE7.css';?>" rel="stylesheet" type="text/css" media="all" />
<![endif]-->

<script type="text/javascript" src="<?php echo WEBSITE.DS. APP_ROOT.DS. 'javascript/bw-menu.js';?>"></script>
<script type="text/javascript" src="<?php echo WEBSITE.DS. APP_ROOT.DS. 'javascript/jsDatePick.min.1.3.js';?>"></script>
<script type="text/javascript">
window.onload = function(){
		
		 new JsDatePick({
			useMode:2,
			isStripped:false,
			target:"date",
            dateFormat:"%M %d, %Y",
			cellColorScheme:"deepblue",
            yearsRange:[1900,2020],
            imgPath:"img/"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			
			limitToToday:false,
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
    new JsDatePick({
			useMode:2,
			isStripped:false,
			target:"dat",
            dateFormat:"%M %d, %Y",
			cellColorScheme:"deepblue",
            yearsRange:[1900,2020],
            imgPath:"img/"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			
			limitToToday:false,
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});    
        
        
	};
    
 
</script>




</head>

<body>
<div id = "wrapper">

<div id = "header">
<?php 

if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];

			$result = users::find_by_sql("SELECT type FROM users WHERE id =$user_id");
            
            $found_user = array_shift($result);
       }     
?>
<div id="schoolHeader"><a href="<?php echo '/'. APP_ROOT.'/';?>">Prime International School</a></div>
<div id="schoolLogo"><a href="<?php echo '/'. APP_ROOT.'/';?>" class="logo">School Logo</a></div>
</div>