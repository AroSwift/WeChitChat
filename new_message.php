<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, new message';
$des = 'Create a new message.';

$title = 'Account - New Message';
$change = 'false';

include('Includes/header.php');



if(!(isset($_COOKIE['user']))){


header("Location: index.php");



} elseif(isset($_COOKIE['user'])){


$date = date('ymdHi');

$sql = "UPDATE users SET last_logged = '$date' WHERE name= '$_COOKIE[user]'";
mysql_query($sql);




$errors = '';

if(isset($_GET['send'])){
if($_GET['send'] == 'true'){



if(empty($_POST['wto'])){
$errors .= 'The To feild is empty<br />';
}


if(isset($_POST['wto'])){
if($_POST['wto'] == $_COOKIE['user']){
$errors .= 'You can\'t send a message to yourself<br />';
}
}


if(empty($_POST['message'])){
$errors .= 'The Message feild is empty<br />';
}

if(isset($_POST['message'])){
if(strlen($_POST['message']) > 500){
$errors .= 'The Message is to long<br />';
}
}

if(isset($_POST['message'])){
if(strlen($_POST['message']) < 5){
$errors .= "The Message is to short<br />";
}
}



if(isset($_POST['wto']) && empty($errors) && isset($_POST['message'])){


$number = mysql_num_rows(mysql_query("SELECT * FROM users WHERE name = '$_POST[wto]'"));


 if($number != 1){
$errors .= 'That name doesn\'t exist<br />';
} else {

$date = date('ymdHi');

$_POST['message'] = htmlentities(stripslashes(trim(mysql_prep($_POST['message']))));
$_POST['message'] = trim(mysql_prep($_POST['message']));

badw($_POST['message']);
$_POST['message'] = badw($_POST['message']);

$sql = "INSERT INTO messages (m_to, m_from, message, date) VALUES ('$_POST[wto]', '$_COOKIE[user]', '$_POST[message]', '$date')";
mysql_query($sql);

header("Location: messages.php");

}



}




if(isset($_POST['type'])){
if($_POST['type'] == 'Cancel'){
header("Location: messages.php");
}
}



}
}



?>



<ul id="jsddm">
<li><a href="support.php" class="norm" title="Report an Error">Support</a></li>
<li><a href="signup.php" class="norm" title="Sign Up!">Sign Up</a></li>
<li><a href="login.php" class="norm" title="Log In">Log In</a></li>
<li><a href="aboutus.php" class="norm" title="About us">About Us</a></li>

<?php  

if(isset($_COOKIE['user'])){

?>
<li><a href="#" class="iit" id="spec_on">Account</a>
<ul id="drop_men">
<li><a href="index.php">Overview</a></li>
<li><a href="editprofile.php">Edit Profile</a></li>
<li><a href="people.php">People</a></li>
<li><a href="friends.php" class="dropper">Friends</a></li>
<li><a href="logout.php" class="bott">Logout</a></li>
</ul>
<?php

} else {

?>
<li id="on"><a href="index.php" class="norm" title="Home Page">Home</a>
<?php

}

?>
</li>
</ul>


</div>




<?php

$query = "SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1";

$result = mysql_query($query);


while($row = mysql_fetch_array($result)){
$name = $row['name'];
$about = $row['about'];

if($about == 'none'){
$about = '';
}


if($_COOKIE['user'] === $name){


?>

<div id="Content1">
<div id="fleft">

<?php

$query = "SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1";
$result = mysql_query($query);


while($row = mysql_fetch_array($result)){
$pic = $row['pic'];


if($pic === ''){

?>

<a href="people_profile.php?user=<?php echo $name; ?>"><img src="User_Images/none.png" id="user" width="150" height="150" alt=""></a>

<?php } else { ?>

<a href="people_profile.php?user=<?php echo $name; ?>"><img src="User_Images/<?php echo $pic; ?>" id="user" width="150" height="150" alt=""></a>

<?php

}

}

?>

<?php

}
}

?>

<div id="LogLinks">
<ul>
<li><a href="index.php">Overview</a></li>
<li><a href="messages.php"  id="onp">Messages</a></li>
<li><a href="editprofile.php">Edit Profile</a></li>
<li><a href="people.php">People</a></li>
<li><a href="friends.php">Friends</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

</div>


<div id="fright">


<h1 id="prof">
<div id="bord">
Messages -> New Message
</div>

</h1>

<div id="pcontent">

<?php

if(isset($errors)){

?>

<div id="errors">
<?php echo $errors; ?>
</div>

<?php


}


?>


<form action="new_message.php?send=true" method="post">
To: <input type="text" name="wto" value="<?php if(isset($_POST['wto'])){ echo $_POST['wto']; } elseif(isset($_GET['name'])){ echo $_GET['name']; } ?>" maxlength="15" />
<br />
<br />
Message:
<br />
<textarea name="message" cols="55" rows="8"><?php if(isset($_POST['message'])){ echo $_POST['message']; } ?></textarea>
<br />
<input type="submit" name="type" id="esubmit76" value="Send" />
<input type="submit" name="type" id="esubmit77" value="Cancel" />
</form>


</div>

</div>

</div>


<?php


} else {
echo 'There was an error please report this to us by going to the<a href="support.php">support</a> page';
}



include('Includes/footer.php');

?>