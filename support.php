<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, support, help';
$des = 'We support all wechitchat users.  If you need help or want to report an error, this is the place.';

$title = 'Support';

include('Includes/header.php');


$errors = '';



if(isset($_GET['send2'])){
if($_GET['send2'] == 'true'){


if(strlen($_POST['subject']) > 60){
$errors .= "The subject is to long<br />";
}

if(strlen($_POST['subject']) < 3){
$errors .= "The subject is to short<br />";
}

if(strlen($_POST['description']) > 500){
$errors .= "The subject is to long<br />";
}

if(strlen($_POST['description']) < 10){
$errors .= "The description is to short<br />";
}


if(empty($_POST['subject'])){
$errors .= "The subject is empty<br />";
}


if(empty($_POST['description'])){
$errors .= "The description is empty<br />";
}


if(empty($errors)){
if(isset($_POST['subject']) && isset($_POST['description'])){

$_POST['subject'] = trim(mysql_prep($_POST['subject']));
$_POST['description'] = trim(mysql_prep($_POST['description']));



badw($_POST['subject']);
$_POST['subject'] = badw($_POST['subject']);

badw($_POST['description']);
$_POST['description'] = badw($_POST['description']);



$date = date('ymdHi');

$sql = "INSERT INTO errors (subject, description, ip, status, user, date) VALUES ('$_POST[subject]', '$_POST[description]', '', 'pending', '$_POST[user]', '$date')";
mysql_query($sql);


unset($_POST['subject']);
unset($_POST['description']);

header("Location: support.php?succ2=true");


}
}



}
}







if(isset($_GET['send'])){
if($_GET['send'] == 'true'){


if(strlen($_POST['subject']) > 60){
$errors .= "The subject is to long<br />";
}

if(strlen($_POST['subject']) < 3){
$errors .= "The subject is to short<br />";
}

if(strlen($_POST['description']) > 500){
$errors .= "The subject is to long<br />";
}

if(strlen($_POST['description']) < 10){
$errors .= "The description is to short<br />";
}


if(empty($_POST['subject'])){
$errors .= "The subject is empty<br />";
}


if(empty($_POST['description'])){
$errors .= "The description is empty<br />";
}


if(empty($errors)){
if(isset($_POST['subject']) && isset($_POST['description'])){

$_POST['subject'] = trim(mysql_prep($_POST['subject']));
$_POST['description'] = trim(mysql_prep($_POST['description']));


badw($_POST['subject']);
$_POST['subject'] = badw($_POST['subject']);

badw($_POST['description']);
$_POST['description'] = badw($_POST['description']);


$date = date('ymdHi');


if (getenv('HTTP_CLIENT_IP')) {
$ip = getenv('HTTP_CLIENT_IP');
}
elseif (getenv('HTTP_X_FORWARDED_FOR')) {
$ip = getenv('HTTP_X_FORWARDED_FOR');
}
elseif (getenv('HTTP_X_FORWARDED')) {
$ip = getenv('HTTP_X_FORWARDED');
}
elseif (getenv('HTTP_FORWARDED_FOR')) {
$ip = getenv('HTTP_FORWARDED_FOR');
}
elseif (getenv('HTTP_FORWARDED')) {
$ip = getenv('HTTP_FORWARDED');
}
else {
$ip = $_SERVER['REMOTE_ADDR'];
}



$sql = "INSERT INTO errors (subject, description, ip, status, date) VALUES ('$_POST[subject]', '$_POST[description]', '$ip', 'pending', '$date')";
mysql_query($sql);


unset($_POST['subject']);
unset($_POST['description']);

header("Location: support.php?succ=true");

}
}


}
}




if(isset($_GET['succ'])){
if($_GET['succ'] == 'true'){

$gmess = 'Your question has been successfully sent to one of our staff. <br />To see if your question has been awnsered look in the handled page.';

}
}



if(isset($_GET['succ2'])){
if($_GET['succ2'] == 'true'){

$gmess = 'Your question has been successfully sent to one of our staff. <br />You will get message when we have awnsered your quetion.';

}
}


?>


<ul id="jsddm">
<li id="on"><a href="support.php" class="norm" title="Report an Error">Support</a></li>
<li><a href="signup.php" class="norm" title="Sign Up!">Sign Up</a></li>
<li><a href="login.php" class="norm" title="Log In">Log In</a></li>
<li><a href="aboutus.php" class="norm" title="About us">About Us</a></li>

<?php  

if(isset($_COOKIE['user'])){

?>
<li><a href="#" class="iit">Account</a>
<ul id="drop_men">
<li><a href="index.php">Overview</a></li>
<li><a href="editprofile.php">Edit Profile</a></li>
<li><a href="people.php">People</a></li>
<li><a href="friends.php">Friends</a></li>
<li><a href="logout.php" class="bott">Logout</a></li>
</ul>
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



<div id="SideBarR1">
<h3>Submit a request for assistance</h3>

You'll be notified when our administraters answers your request. 
</div>



<div id="Content">
<h2>Support</h2>



<?php


if(isset($_COOKIE['user'])){



if(!(empty($errors))){

?>

<div id="errors">
<?php echo $errors; ?>
</div>

<?php

}

if(!(empty($gmess))){

?>

<div id="gmess">
<?php echo $gmess; ?>
</div>

<?php

}

?>



<span id="red">Required*</span>
<br />
<br />

<form action="support.php?send2=true" method="post">
<label id="form_down">Subject<span id="red">*</span></label><br />
<input type="hidden" name="user" value="<?php echo $_COOKIE['user']; ?>" />
<input type="text" value="<?php if(isset($_POST['subject'])){ echo $_POST['description']; } ?>" name="subject" size="45" />
<br />
<br />
<label id="form_down">Description<span id="red">*</span></label><br />
<textarea name="description" cols="55" rows="8"><?php if(isset($_POST['description'])){ echo $_POST['description']; } ?></textarea>
<br />
<input type="submit" value="submit" id="esubmit31" />
</form>

</div>
<?php

} else {

?>
<a href="support.php" class="support">Submit Question</a> - <a href="support.php?pending=true" class="support">Pending</a> - <a href="support.php?handled=true" class="support">Handled</a>
<br />

<?php



if(isset($_GET['pending'])){
if($_GET['pending'] == 'true'){

echo '<br />';


if (getenv('HTTP_CLIENT_IP')) {
$ip = getenv('HTTP_CLIENT_IP');
}
elseif (getenv('HTTP_X_FORWARDED_FOR')) {
$ip = getenv('HTTP_X_FORWARDED_FOR');
}
elseif (getenv('HTTP_X_FORWARDED')) {
$ip = getenv('HTTP_X_FORWARDED');
}
elseif (getenv('HTTP_FORWARDED_FOR')) {
$ip = getenv('HTTP_FORWARDED_FOR');
}
elseif (getenv('HTTP_FORWARDED')) {
$ip = getenv('HTTP_FORWARDED');
}
else {
$ip = $_SERVER['REMOTE_ADDR'];
}



$query = "SELECT * FROM errors WHERE ip = '$ip' AND status = 'pending' ORDER BY date DESC";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$subject = $row['subject'];
$description = $row['description'];
$date = $row['date'];
$ip2 = $row['ip'];





?>

<ul id="support_show">
<li>
<div id="laston5">
<?php echo returnMess($date); ?>
</div>
<div id="about_people2">
<span id="support_spc">
<?php echo $subject; ?>
</span>
<br />
<?php echo $description; ?>
</div>
</li>
</ul>

<?php

}


}
} else {


if(isset($_GET['handled'])){
if($_GET['handled'] == 'true'){

echo '<br />';


if (getenv('HTTP_CLIENT_IP')) {
$ip = getenv('HTTP_CLIENT_IP');
}
elseif (getenv('HTTP_X_FORWARDED_FOR')) {
$ip = getenv('HTTP_X_FORWARDED_FOR');
}
elseif (getenv('HTTP_X_FORWARDED')) {
$ip = getenv('HTTP_X_FORWARDED');
}
elseif (getenv('HTTP_FORWARDED_FOR')) {
$ip = getenv('HTTP_FORWARDED_FOR');
}
elseif (getenv('HTTP_FORWARDED')) {
$ip = getenv('HTTP_FORWARDED');
}
else {
$ip = $_SERVER['REMOTE_ADDR'];
}



$query = "SELECT * FROM errors WHERE ip = '$ip' AND status = 'handled' ORDER BY date DESC";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$subject = $row['subject'];
$description = $row['description'];
$solution = $row['solution'];
$date = $row['date'];
$ip2 = $row['ip'];





?>

<ul id="support_show">
<li>
<div id="laston5">
<?php echo returnMess($date); ?>
</div>
<div id="about_people2">
<span id="support_spc">
<?php echo $subject; ?>
</span>
<br />
<?php echo $description; ?>
<br />
<br />
<span id="support_spc">
Awnser:
</span>
<br />
<?php echo $solution; ?>
</div>
</li>
</ul>

<?php

}

}
} else {



if(!(empty($errors))){

?>

<div id="errors">
<?php echo $errors; ?>
</div>

<?php

}



if(!(empty($gmess))){

?>

<div id="gmess">
<?php echo $gmess; ?>
</div>

<?php

}

?>

<br />

<span id="red">Required*</span>	
<br />
<br />

<form action="support.php?send=true" method="post">
<label id="form_down">Subject<span id="red">*</span></label><br />
<input type="text" name="subject" value="<?php if(isset($_POST['description'])){ echo $_POST['subject']; } ?>" size="45" maxlength="60" />
<br />
<br />
<label id="form_down">Description<span id="red">*</span></label><br />
<textarea name="description" cols="55" rows="8" maxlength="500"><?php if(isset($_POST['description'])){ echo $_POST['description']; } ?></textarea>
<br />
<input type="submit" value="submit" id="esubmit31" />
</form>
	
<?php


}

}

}


?>
</div>


<?php

include('Includes/footer.php');

?>