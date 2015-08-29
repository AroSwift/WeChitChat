<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, edit profile';
$des = 'Edit your wechitchat profile.';

$title = 'Account - Edit Profile';
$change = 'false';

include('Includes/header.php');


if(!(isset($_COOKIE['user']))){

header("Location: login.php");


} elseif(isset($_COOKIE['user'])){


$date = date('ymdHi');

$sql = "UPDATE users SET last_logged = '$date'WHERE name= '$_COOKIE[user]'";
mysql_query($sql);


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
<li><a href="editprofile.php"id="onp">Edit Profile</a></li>
<li><a href="people.php">People</a></li>
<li><a href="friends.php">Friends</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

</div>


<div id="fright">


<h1 id="prof">
<div id="bord">
Edit Profile
</div>
</h1>

<div id="pcontent">

<?php


$errors = "";
$gmess = "";


if(isset($_GET['edit'])){
if($_GET['edit'] == 'true'){



if(isset($_POST['about'])){
if(!(empty($_POST['about']))){
if(strlen($_POST['about']) < 5){
$errors .= "About Me is to short<br />";
}
}
}


if(isset($_POST['about'])){
if(strlen($_POST['about']) > 500){
$errors .= "About Me is to long<br />";
}
}


if(isset($_POST['email'])){
if(!(empty($_POST['email']))){
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
$errors .=  "E-mail is not valid<br />";
}
}
}







if(isset($errors)){
if(empty($errors)){

if(empty($_POST['gender'])){
$_POST['gender'] = '';
}

if(empty($_POST['age'])){
$_POST['age'] = '';
}


$query = "SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$password = $row['password'];



$_POST['about'] = trim(mysql_prep($_POST['about']));

if(isset($_POST['email'])){
$_POST['email'] = trim(mysql_prep($_POST['email']));
}


if(empty($_POST['about'])){

$_POST['about'] = 'none';

}


badw($_POST['about']);
$_POST['about'] = badw_code($_POST['about']);


if(isset($_POST['email'])){
$sql = "UPDATE users SET email = '$_POST[email]', about = '$_POST[about]', gender = '$_POST[gender]', age = '$_POST[age]'  WHERE name = '$_COOKIE[user]' AND password = '$password'";
} else {
$sql = "UPDATE users SET about = '$_POST[about]', gender = '$_POST[gender]', age = '$_POST[age]'  WHERE name = '$_COOKIE[user]' AND password = '$password'";
}

}


mysql_query($sql);

header("Location: editprofile.php?edited=true");


}
}




}
}




if(isset($_GET['edited'])){
if($_GET['edited'] == 'true'){

$gmess = 'Your account has been successfully saved.';

}
}




$query = "SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1";
$result = mysql_query($query);


while($row = mysql_fetch_array($result)){
$name = $row['name'];
$password = $row['password'];
$email = $row['email'];
$about = $row['about'];
$pic = $row['image'];
$gender = $row['gender'];
$age = $row['age'];


if($age == '3t6'){
$age = '3 - 6';
} elseif($age == '6t9'){
$age = '6 - 9';
} elseif($age == '9t12'){
$age = '9 - 12';
} elseif($age == '12t15'){
$age = '12 - 15';
} elseif($age == '15t18'){
$age = '15 - 18';
} elseif($age == '18+'){
$age = '18+';
}

if($about == 'none'){
$about = '';
}

if(empty($email)){
$email = '';
}



$sel = 'selected="selected"';

?>


<br />
<br />
<br />



<?php

if(!(empty($errors))){

?>

<div id="errors">
<?php echo $errors.''; ?>
</div>

<?php

}


if(!(empty($gmess))){

?>

<div id="gmess">
<?php echo $gmess.''; ?>
</div>

<?php

}

?>
<br />


<form action="editprofile.php?edit=true" method="post">
<fieldset title="Change Your Password">
<legend><b>Change Password</b></legend>
Click the link below to change your password.
<br />
<a href="change_pass.php">Change password</a>
</fieldset>

<br />
<fieldset title="Change Your Email Address">
<legend><b>Change Your Email Address</b></legend>
Click the link below to change your email address.
<br />
<a href="change_email.php">Change Email</a>
<br />
<b>Your email has not be verified</b>
</fieldset>





<br />
<fieldset title="Change Your Picture">
<legend><b>Change Your Picture</b></legend>
Click the link below to change your picture.
<br />
<a href="change_pic.php">Change Picture</a>
</fieldset>






<br />
<label>
I am a
</label>
<br />
<select name="gender">
<option value="">Select Gender</option>
<option value="Boy" <?php if($gender=='Boy'){ echo 'selected="selected"'; } elseif(isset($_POST['gender'])){ echo $_POST['gender']; } ?>>Boy</option>
<option value="Girl" <?php if($gender=='Girl'){ echo 'selected="selected"'; } ?>>Girl</option>
</select>
<br />
<br />
<label>
Age
</label>
<br />
<select name="age">
<option value="">Select Age</option>
<option value="3t6" <?php if($age=='3 - 6'){ echo $sel; } ?>>3 - 6</option>
<option value="6t9" <?php if($age=='6 - 9'){ echo $sel; } ?>>6 - 9</option>
<option value="9t12" <?php if($age=='9 - 12'){ echo $sel; } ?>>9 - 12</option>
<option value="12t15" <?php if($age=='12 - 15'){ echo $sel; } ?>>12 - 15</option>
<option value="15t18" <?php if($age=='15 - 18'){ echo $sel; } ?>>15 - 18</option>
<option value="18+" <?php if($age=='18+'){ echo $sel; } ?>>18+</option>
</select>
<br />
<br />
<label>About Me<label> <br /><textarea name="about" cols="55" rows="8">
<?php 

if(isset($_POST['about'])){ 
echo $_POST['about'];
}else{ 
echo $about;
} 

?>
</textarea>
<br />
<div id="under_textarea">max characters 500</div>
<input type="submit" id="edit_esubmit" value="Save">
</form>

<?php

}

?>

</div>


</div>

</div>



<?php

} else {
echo 'There was an error please report this to us by going to the<a href="support.php">support</a> page';
}



include('Includes/footer.php');

?>