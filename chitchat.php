<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, chitchat, quick chat';
$des = 'Have a quick chat with your friend on wechitchat.';

$title = 'Chit Chat';

include('Includes/header.php');

$errors = "";




?>


<ul id="jsddm">
<li><a href="support.php" class="norm" title="Report an Error">Support</a></li>
<li><a href="signup.php" class="norm" title="Sign Up!">Sign Up</a></li>
<li id="on"><a href="login.php" class="norm" title="Log In">Log In</a></li>
<li><a href="aboutus.php" class="norm" title="About us">About Us</a></li>

<?php  

if(isset($_COOKIE['user'])){

?>
<li><a href="index.php" class="iit">Account</a>
</li>
<?php

} elseif(isset($_COOKIE['parent'])){

?>
<li><a href="#" class="iit">Account</a>
<ul id="drop_men">
<li><a href="index.php">Parental Controls</a></li>
<li><a href="logout.php" class="bott">Logout</a></li>
</ul>
<?php

} else {

?>
<li><a href="index.php" class="norm" title="Home Page">Home</a>
<?php

}

?>
</li>
</ul>


</div>




<?php

if(!(isset($start))){
$start = 0;
}


if(isset($_COOKIE['user'])){




$errors = '';

if(isset($_POST['post'])){
if($_POST['post'] == 'true'){

if(!(empty($_POST['message']))){


if(empty($errors)){

$date = date('ymdHi');

$_POST['message'] = htmlentities(stripslashes(trim(mysql_prep($_POST['message']))));
$_POST['message'] = trim(mysql_prep($_POST['message']));

badw($_POST['message']);
$_POST['message'] = badw($_POST['message']);

$underu = $_COOKIE['user'].'_'.$_GET['user'];

$sql = "INSERT INTO cc (c_to, under, c_From, message, date) VALUES ('$_GET[user]', '$underu', '$_COOKIE[user]', '$_POST[message]','$date')";
mysql_query($sql);

$_POST['message'] = '';

header("Location: chitchat.php?user=".$_GET["user"]."&start=".$_GET["start"]."");

}


} else {

$errors .= 'The post is empty';

}


}
}


?>

<div id="Content1">
<h1 class="uoi">Chit Chat</h1>
<a href="index.php"><- Back</a>
<?php

if(isset($errors)){

?>

<div id="errors">
<?php echo $errors; ?>
</div>

<?php


}

if(isset($_GET['start'])){
$start = $_GET['start'];
} else {
$start = 0;
}


?>

<!--[if IE]>

Chit Chat won't work properly with Internet Explorer, please try Firefox.
<br />
<br />

<![endif]-->




<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript">


Event.observe(window, 'load', init, false);


function init(){

var url = 'get.php?start=<?php echo $start; ?>&user=<?php echo $_GET['user']; ?>';
var pars = '';
var target = 'update';
var myAjax = new Ajax.PeriodicalUpdater(target, url, {method: 'get', parameters: pars});

}

  
</script>

<div id="update"></div>



<br />
<form name="form" action="chitchat.php?user=<?php echo $_GET['user']; ?>&start=<?php echo $start; ?>" method="post">
<input type="hidden" name="by" value="<?php echo $_COOKIE['user']; ?>" />
<input type="hidden" name="post" value="true" />
<textarea rows="2" cols="37" name="message" maxlength="100">
<?php

if(isset($_POST['message'])){
echo $_POST['message'];
}

?>
</textarea>

<br />

<input type="submit" id="edit_esubmit2" name="submit" value="submit" />

</form>



</div>
<?php


} else {
header("Location: login.php");
}

include('Includes/footer.php');

?>