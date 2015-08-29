<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, change email, change email address';
$des = 'Change your wechitchat email address.';

$title = 'Account - Change Email';
$change = 'false';

include('Includes/header.php');



if(!(isset($_COOKIE['user']))){


header("Location: index.php");



} elseif(isset($_COOKIE['user'])){


$date = date('ymdHi');

$sql = "UPDATE users SET last_logged = '$date' WHERE name= '$_COOKIE[user]'";
mysql_query($sql);




$errors = "";
$gmess = "";


if(isset($_POST['cancel'])){
header("Location: editprofile.php");
}



if(isset($_GET['edit'])){
if($_GET['edit'] == 'true'){



if(isset($_POST['email'])){
if(!(empty($_POST['email']))){
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
$errors .=  "The Email Address is not valid<br />";
}
}
}


if(isset($_POST['email'])){
if(strlen($_POST['email']) > 30){
$errors .= "Email Address is to long<br />";
}
}


if(isset($_POST['email'])){
if(strlen($_POST['email']) < 3){
$errors .= "Email Address is to short<br />";
}
}



if(isset($errors) && isset($_POST['email'])){
if(empty($errors)){


$_POST['email'] = htmlentities(stripslashes(trim(mysql_prep($_POST['email']))));


$query = "SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$password = $row['password'];
$email = $row['email'];

$sql = "UPDATE users SET email = '$_POST[email]' WHERE name = '$_COOKIE[user]' AND password = '$password'";

mysql_query($sql);
$gmess = 'Your Email Address has been successfully changed!';

}



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
<li><a href="messages.php">Messages</a></li>
<li><a href="editprofile.php" class="dropper">Edit Profile</a></li>
<li><a href="people.php">People</a></li>
<li><a href="friends.php">Friends</a></li>
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
<li><a href="messages.php">Messages</a></li>
<li><a href="editprofile.php" id="onp">Edit Profile</a></li>
<li><a href="people.php">People</a></li>
<li><a href="friends.php">Friends</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

</div>


<div id="fright">


<h1 id="prof">
<div id="bord">
Edit Profile > Change Email
</div>

</h1>

<div id="pcontent">

<?php


$query = "SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1";
$result = mysql_query($query);


while($row = mysql_fetch_array($result)){
$name = $row['name'];
$password = $row['password'];
$email = $row['email'];



?>

<?php

$query = "SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$email = $row['email'];


if(empty($email)){
echo 'You haven\'t suplied an email address yet.';
} else {
echo 'Your current password is: <b>'.$email.'</b>';
}


}

?>

<br />
<br />
<span id="red">Required*</span>
<br />

<?php

if(!(empty($errors))){

?>

<div id="errors">
<?php echo $errors; ?>
</div>

<?php

} elseif(empty($gmess)){
echo "<br />";
}


if(!(empty($gmess))){

?>

<div id="gmess">
<?php echo $gmess; ?>
</div>

<?php

}

?>


<form action="change_email.php?edit=true" method="post">
<label>New Email Address<span id="red">*</span><label> <br /><input type="text" size="45" maxlength="30" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" name="email" />
<br />
<input type="submit" id="edit_esubmit" value="Save" /> <input type="submit" name="cancel" id="edit_esubmit" value="Cancel" />
</form>


</div>

</div>

</div>


<?php

}


} else {
echo 'There was an error please report this to us by going to the<a href="support.php">support</a> page';
}



include('Includes/footer.php');

?>