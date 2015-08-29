<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, change password';
$des = 'Change your wechitchat password.';

$title = 'Account - Edit Profile > Change Password';
$change = 'false';

include('Includes/header.php');



if(!(isset($_COOKIE['user']))){


header("Location: index.php");



} elseif(isset($_COOKIE['user'])){


$date = date('ymdHi');

$sql = "UPDATE users SET last_logged = '$date' WHERE name= '$_COOKIE[user]'";
mysql_query($sql);




$errors = '';
$gmess = '';


if(isset($_POST['cancel'])){
header("Location: editprofile.php");
}



if(isset($_GET['edit'])){
if($_GET['edit'] == 'true'){



if(isset($_POST['password'])){
if(strlen($_POST['password']) > 30){
$errors .= "Password is to long<br />";
}
}


if(isset($_POST['password'])){
if(strlen($_POST['password']) < 3){
$errors .= "Password is to short<br />";
}
}


if(!preg_match ("~^[A-Za-z0-9]*$~", $_POST['password'])) {
$errors .=  "The password is not valid<br />";
}


// New Password

if(isset($_POST['new_password'])){
if(strlen($_POST['password']) > 30){
$errors .= "Password is to long<br />";
}
}


if(isset($_POST['new_password'])){
if(strlen($_POST['password']) < 3){
$errors .= "Password is to short<br />";
}
}


if(!preg_match ("~^[A-Za-z0-9]*$~", $_POST['new_password'])) {
$errors .=  "The password is not valid<br />";
}




// Confirm New Password

if(isset($_POST['new_password']) && isset($_POST['c_new_password'])){

if($_POST['new_password'] != $_POST['c_new_password']){
$errors .=  "The New Password doesn't match the Confirm New Password feild<br />";
}

if(empty($_POST['c_new_password'])){
$errors .=  "The Comfirm New Password is empty<br />";
}

if(empty($_POST['new_password'])){
$errors .=  "The New Password is empty<br />";
}

}



if(isset($_POST['password'])){

$query = "SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$password = $row['password'];

if($password != $_POST['password']){
$errors .=  "Your current Password doesn't match the Password you have entered<br />";
}
}

}




// Updating new password

if(isset($_POST['password']) && isset($_POST['new_password']) && isset($_POST['c_new_password']) && empty($errors)){
if(empty($errors)){


$_POST['password'] = htmlentities(stripslashes(trim(mysql_prep($_POST['password']))));
$_POST['new_password'] = htmlentities(stripslashes(trim(mysql_prep($_POST['new_password']))));
$_POST['c_new_password'] = htmlentities(stripslashes(trim(mysql_prep($_POST['c_new_password']))));



$query = "SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$password = $row['password'];

$sql = "UPDATE users SET password = '$_POST[new_password]' WHERE name = '$_COOKIE[user]' AND password = '$password'";

mysql_query($sql);
$gmess = 'Your password has been changed!';

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
Edit Profile > Change Password
</div>

</h1>

<div id="pcontent">

<?php


$query = "SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1";
$result = mysql_query($query);


while($row = mysql_fetch_array($result)){
$name = $row['name'];
$password = $row['password'];



?>

<span id="red">Required*</span>
<br />


<?php

if(!(empty($errors))){

?>

<div id="errors">
<?php echo $errors; ?>
</div>

<?php

} else {
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




<form action="change_pass.php?edit=true" method="post">
<label>Password<span id="red">*</span><label> <br /><input type="password" size="45" maxlength="30" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; }else{ echo $password; } ?>" name="password" />
<br />
<br />
<label>New Password<span id="red">*</span><label> <br /><input type="password" size="45" maxlength="30" value="<?php if(isset($_POST['new_password'])){ echo $_POST['new_password']; } ?>" name="new_password" />
<br />
<br />
<label>Comfirm New Password<span id="red">*</span><label> <br /><input type="password" size="45" maxlength="30" value="<?php if(isset($_POST['c_new_password'])){ echo $_POST['c_new_password']; } ?>" name="c_new_password" />
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