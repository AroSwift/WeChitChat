<?php


if(isset($_COOKIE['user'])){

$date = date('ymdHi');

$sql = "UPDATE users SET last_logged = '$date' WHERE name= '$_COOKIE[user]'";
mysql_query($sql);

}



if(isset($_COOKIE['parent'])){

$date = date('ymdHi');

$sql = "UPDATE users SET last_logged = '$date' WHERE name= '$_COOKIE[parent]'";
mysql_query($sql);

}




include("Includes/connection.php");


function mysql_prep( $value ) {
$magic_quotes_active = get_magic_quotes_gpc();
$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
if( $new_enough_php ) { // PHP v4.3.0 or higher
// undo any magic quote effects so mysql_real_escape_string can do the work
if( $magic_quotes_active ) { $value = stripslashes( $value ); }
$value = mysql_real_escape_string( $value );
} else { // before PHP v4.3.0
// if magic quotes aren't already on then add slashes manually
if( !$magic_quotes_active ) { $value = addslashes( $value ); }
// if magic quotes are active, then the slashes already exist
}
return $value;
}





function badword($string){

if($string){

$sweararray = array('blood', "'");
$replace = array('--', '\'');

$new_string = str_replace($sweararray, $replace, $string);

return $new_string;

}

}






function returnMess($querydate){

$minusdate = date('ymdHi') - $querydate;

if($minusdate > 88697640 && $minusdate < 100000000){
    $minusdate = $minusdate - 88697640;
}

    switch ($minusdate) {

        case ($minusdate < 99):
					if($minusdate >= 59){
						$date_string = '1 minute ago';
					} elseif($minusdate > 59){
						$date_string =  ''.($minusdate - 40).' minutes ago';
                    } elseif($minusdate > 1 && $minusdate < 10){
						$date_string = '1 minute ago';
					} elseif($minusdate > 1 && $minusdate < 59){
						$date_string = ''.$minusdate.' minutes ago';
					}
        break;

        case ($minusdate > 99 && $minusdate < 2359):
                    $flr = floor($minusdate * .01);
                    if($flr == 1){
						$date_string = '1 hour ago';
                    }
                    else{
						$date_string =  ''.$flr.' hours ago';
                    }
        break;
       
        case ($minusdate > 2359 && $minusdate < 310000):
                    $flr = floor($minusdate * .0001);
                    if($flr == 1){
						$date_string = '1 day ago';
                    }
                    else{
						$date_string =  ''.$flr.' days ago';
                    }
        break;
       
        case ($minusdate > 310001 && $minusdate < 12320000):
                    $flr = floor($minusdate * .000001);
                    if($flr == 1){
						$date_string = "1 month ago";
                    }
                    else{
						$date_string =  ''.$flr.' months ago';
                    }
        break;
       
        case ($minusdate > 100000000):
                $flr = floor($minusdate * .00000001);
                if($flr == 1){
						$date_string = '1 year ago.';
                }
                else{
						$date_string = ''.$flr.' years ago';
                }
        }
       

   if(isset($date_string)){
   if($date_string == '0 hours ago'){
   $date_string = '1 minute ago';
   } elseif(!(isset($date_string))){
	$date_string = '1 minute ago';
   }
   }
   
   
   
   if(isset($date_string)){
   if($date_string == '0 months ago'){
   $date_string = '1 month ago';
   } elseif(!(isset($date_string))){
	$date_string = '1 minute ago';
   }
   }
   
   
   if(isset($date_string)){
   if($date_string == '0 days ago'){
   $date_string = '1 day ago';
   } elseif(!(isset($date_string))){
	$date_string = '1 minute ago';
   }
   }
   
   
   if(isset($date_string)){
   if($date_string == 'On 0 years ago'){
   $date_string = '1 year ago';
   } elseif(!(isset($date_string))){
	$date_string = '1 minute ago';
   }
   }
   
   
   
   
   
   if(!(isset($date_string))){
   $date_string = '1 minute ago';
   }
   
   
   
    return $date_string;
} 









function returnDate($querydate){

$minusdate = date('ymdHi') - $querydate;

if($minusdate > 88697640 && $minusdate < 100000000){
    $minusdate = $minusdate - 88697640;
}

    switch ($minusdate) {

        case ($minusdate < 99):
					if($minusdate >= 10){
						$date_string = 'On now';
					} elseif($minusdate > 59){
						$date_string =  'On '.($minusdate - 40).' minutes ago';
                    } elseif($minusdate > 1 && $minusdate < 10){
						$date_string = 'On now';
					} elseif($minusdate > 1 && $minusdate < 59){
						$date_string = 'On '.$minusdate.' minutes ago';
					}
        break;

        case ($minusdate > 99 && $minusdate < 2359):
                    $flr = floor($minusdate * .01);
                    if($flr == 1){
						$date_string = 'On 1 hour ago';
                    }
                    else{
						$date_string =  'On '.$flr.' hours ago';
                    }
        break;
       
        case ($minusdate > 2359 && $minusdate < 310000):
                    $flr = floor($minusdate * .0001);
                    if($flr == 1){
						$date_string = 'On 1 day ago';
                    }
                    else{
						$date_string =  'On '.$flr.' days ago';
                    }
        break;
       
        case ($minusdate > 310001 && $minusdate < 12320000):
                    $flr = floor($minusdate * .000001);
                    if($flr == 1){
						$date_string = "On 1 month ago";
                    }
                    else{
						$date_string =  'On '.$flr.' months ago';
                    }
        break;
       
        case ($minusdate > 100000000):
                $flr = floor($minusdate * .00000001);
                if($flr == 1){
						$date_string = 'On 1 year ago.';
                }
                else{
						$date_string = 'On '.$flr.' years ago';
                }
        }
       

   if(isset($date_string)){
   if($date_string == 'On 0 hours ago'){
   $date_string = 'On now';
   } elseif(!(isset($date_string))){
	$date_string = 'On now';
   }
   }
   
   
   
   if(isset($date_string)){
   if($date_string == 'On 0 months ago'){
   $date_string = 'On 1 month ago';
   } elseif(!(isset($date_string))){
	$date_string = 'On now';
   }
   }
   
   
   if(isset($date_string)){
   if($date_string == 'On 0 days ago'){
   $date_string = 'On 1 day ago';
   } elseif(!(isset($date_string))){
	$date_string = 'On now';
   }
   }
   
   
   if(isset($date_string)){
   if($date_string == 'On 0 years ago'){
   $date_string = 'On 1 month ago';
   } elseif(!(isset($date_string))){
	$date_string = 'On now';
   }
   }
   
   
   
   
   
   if(!(isset($date_string))){
   $date_string = 'On Now';
   }
   
   
   
    return $date_string;
} 



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>
<?php

if(isset($title)){
echo $title;
} else {
echo "We Chit Chat";
}

?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="Keywords" content="safe chatting, chatting for kids, kids chat, chat rooms for kids, teens chat, free chatting for kids, free chatting" />
<meta name="Description" content="WeChitChat is a secure and safe place for young kids to chat." />

<link rel="icon" href="Images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="Images/favicon.ico" type="image/x-icon" /> 
<meta name="robots" content="index" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache" />

<link rel="stylesheet" type="text/css" href="MainStyle.css"  media="screen" />
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<script src="js/real_jquery.js" type="text/javascript"></script>


<script type="text/javascript">


var timeout         = 0;
var closetimer		= 0;
var ddmenuitem      = 0;
var klue			= 'yes';


function jsddm_open(){	

	jsddm_canceltimer();
	jsddm_close();
	$(this).find('.iit').css('background-color','#3D72EB');
	$(this).find('.iit').css('-moz-border-radius-topleft','10px');
	$(this).find('.iit').css('-moz-border-radius-topright','10px');
	ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');
	
	if(klue === 'yes'){
		$('#drop_men').hide();
		$('#drop_men').slideDown(500);
		klue = 'no';
	}
	
}
	
	
	
function jsddm_close(){	
if(ddmenuitem){ 

	ddmenuitem.css('visibility', 'hidden'); 
	
}
}




function jsddm_timer(){	
closetimer = window.setTimeout(jsddm_close, timeout);

	<?php
	
	if(isset($change)){
	
	?>
	
	$(this).find('.iit').css('background-color','#3D72EB');
	$(this).find('.iit').css('-moz-border-radius-topleft','10px');
	$(this).find('.iit').css('-moz-border-radius-topright','10px');
	
	<?php
	
	} else {
	
	?>

	$(this).find('.iit').css('background-color','#1C346B');
	$(this).find('.iit').css('-moz-border-radius-topleft','0px');
	$(this).find('.iit').css('-moz-border-radius-topright','0px');

	
	<?php
	
	}

	?>	
}


function jsddm_canceltimer(){

	if(closetimer){	
		window.clearTimeout(closetimer);
		closetimer = null; 
	}
	
}

		
$(document).ready(function()
{	$('#jsddm > li').bind('mouseover', jsddm_open);
	$('#jsddm > li').bind('mouseout',  jsddm_timer);
	});

document.onclick = jsddm_close;
</script>


<!--[if IE]>
<style type="text/css">

body{
margin-right: -40px;
}




/* Links */

#jsddm{
margin-top: -23px;
margin-bottom: 0px;
overflow: hidden;
margin-right: 50px;
}

#jsddm li ul li a{
width: 130px;
background: #3D72EB;
padding-left: 15px;
margin-top: 0px;
margin-right: 293px;
}





/* SideBar */

#ssubmit{
font-size: 79%;
border: 2px solid #7F7F53;
font-weight: bold;
margin-left: 5px;
}

#isubmit{
margin-top: 6px;
margin-left: -26px;
}

#esubmit{
margin-top: -1px;
margin-left: -10px;
}

#SideBarR1, #SideBarR2{
width: 27%;
margin-right: 50px;
}




/* Content */

#Content{
width: 55%;
}




/* Footer */

#Footer #Flinks{
margin-right: 30px;
}


</style>

<![endif]-->


</head>
<body>

<div id="Header">
<a name="top"><a href="http://wechitchat.com/"><img src="Images/banner.png" alt="" /></a></a>
<span id="hslog">A safe place for kids to chat</span>
