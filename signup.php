<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, sign up, wechitchat sign up, create account';
$des = 'Sign up for a We Chit Chat account.  It\'s completly free, so join now!';

$title = 'Sign Up';

include('Includes/header.php');



$errors = "";
$mess = "";
$gmess = "";




if(isset($_GET['signup'])){
if($_GET['signup'] == 'true'){




if(isset($_POST['sname'])){
if($_POST['sname'] === 'useronline'){
$errors .= 'That user name already is taken<br />';
}
}

if(isset($_POST['sname'])){
if($_POST['sname'] === 'messages'){
$errors .= 'That user name already is taken<br />';
}
}

if(isset($_POST['sname'])){
if($_POST['sname'] === 'errors'){
$errors .= 'That user name already is taken<br />';
}
}

if(isset($_POST['sname'])){
if($_POST['sname'] === 'users'){
$errors .= 'That user name already is taken<br />';
}
}


// BAD WORD BLOCK

strtolower($_POST['sname']);

$_POST['sname'] = strtolower($_POST['sname']);


if(isset($_POST['sname'])){
if($_POST['sname'] === 'shit'){
$errors .= 'Bad words are not allowed<br />';
}
}


if(isset($_POST['sname'])){
if($_POST['sname'] === 'bloody'){
$errors .= 'Bad words are not allowed<br />';
}
}


if(isset($_POST['sname'])){
if($_POST['sname'] === 'fuck'){
$errors .= 'Bad words are not allowed<br />';
}
}


if(isset($_POST['sname'])){
if($_POST['sname'] === 'naked'){
$errors .= 'Bad words are not allowed<br />';
}
}


if(isset($_POST['sname'])){
if($_POST['sname'] === 'sex'){
$errors .= 'Bad words are not allowed<br />';
}
}


if(isset($_POST['sname'])){
if($_POST['sname'] === 'sexy'){
$errors .= 'Bad words are not allowed<br />';
}
}



if(isset($_POST['spassword'])){
if($_POST['spassword'] === 'shit'){
$errors .= 'Bad words are not allowed<br />';
}
}


if(isset($_POST['spassword'])){
if($_POST['spassword'] === 'bloody'){
$errors .= 'Bad words are not allowed<br />';
}
}


if(isset($_POST['spassword'])){
if($_POST['spassword'] === 'fuck'){
$errors .= 'Bad words are not allowed<br />';
}
}


if(isset($_POST['spassword'])){
if($_POST['spassword'] === 'naked'){
$errors .= 'Bad words are not allowed<br />';
}
}


if(isset($_POST['spassword'])){
if($_POST['spassword'] === 'sex'){
$errors .= 'Bad words are not allowed<br />';
}
}


if(isset($_POST['spassword'])){
if($_POST['spassword'] === 'sexy'){
$errors .= 'Bad words are not allowed<br />';
}
}


badw($_POST['sname']);
$_POST['sname'] = badw2($_POST['sname']);





if(isset($_POST['sname'])){
if(strlen($_POST['sname']) > 15){
$errors .= "The name is to long<br />";
}
}


if(!preg_match ("~^[A-Za-z0-9]*$~", $_POST['sname'])) {
$errors .=  "The name is not valid<br />";
}  


if(isset($_POST['spassword'])){
if(strlen($_POST['spassword']) > 30){
$errors .= "The password is to long<br />";
}
}

if(isset($_POST['spassword']) && isset($_POST['spassword_confirm'])){
if($_POST['spassword'] != $_POST['spassword_confirm']){
$errors .= "The Password doesn't match the Confirm Password<br />";
}
}


if(!preg_match ("~^[A-Za-z0-9]*$~", $_POST['spassword'])) {
$errors .=  "The password is not valid<br />";
} 


if(isset($_POST['sname'])){
if(strlen($_POST['sname']) < 3){
$errors .= "The name is to short<br />";
}
}


if(isset($_POST['spassword'])){
if(strlen($_POST['spassword']) < 5){
$errors .= "The password is to short<br />";
}
}


if(isset($_POST['semail'])){
if(!(empty($_POST['semail']))){
if(!filter_var($_POST['semail'], FILTER_VALIDATE_EMAIL)){
$errors .=  "The E-mail is not valid<br />";
}
}
}








if(isset($_POST['sname']) && isset($_POST['spassword']) && !($errors)){


$sname = htmlentities(stripslashes(trim(mysql_prep($_POST['sname']))));
$spassword = htmlentities(stripslashes(trim(mysql_prep($_POST['spassword']))));

if(isset($_POST['semail'])){
$semail = htmlentities(stripslashes(trim(mysql_prep($_POST['semail']))));
}


$query = "SELECT * FROM users WHERE name = '$sname'";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$name = $row['name'];

$num = mysql_num_rows($result);

if($num < 1){
$errors .= 'That user does not exist<br />';
}


if($name === $sname){

$errors .= 'That user name already is taken<br />';

}
}

}
}






if(isset($_GET['signup'])){
if($_GET['signup'] == 'true'){
if(isset($sname) && isset($spassword) && empty($errors)){



$date = date('ymdHi');


/* Step 1 */

if(isset($semail)){
$sql = "INSERT INTO users (name, password, email, image, about, last_logged, joined, class, banded) VALUES ('$sname', '$spassword', '$semail', 'none', 'none', '$date', '$date', 'kid', 'no')";
} else {
$sql = "INSERT INTO users (name, password, image, about, last_logged, joined, class, banded) VALUES ('$sname', '$spassword', 'none', 'none', '$date', '$date', 'kid', 'no')";
}

$result = mysql_query($sql);
echo $result ? '  ' : '';



/* Step 2 */

$sql2 = "CREATE TABLE $sname
(
id int AUTO_INCREMENT,
PRIMARY KEY(id),
name varchar(15),
verifed varchar(25),
maker varchar(15)
)";

$result2 = mysql_query($sql2);
echo $result2 ? '  ' : '';


/* Step 3 */

$sql3 = "INSERT INTO $sname (name, verifed, maker) VALUES ('$sname', 'yes', 'yes')";
$result3 = mysql_query($sql3);
echo $result3 ? '  ' : '';





if(isset($_POST['sname']) && $result == '  ' && $result2 == '  ' && $result3 == '  '){

setcookie("user","$sname",time() + (3600* 7));

$_POST['sname'] = '';
$_POST['spassword'] = '';
$_POST['semail'] = '';

unset($_POST['sname']);
unset($_POST['spassword']);
unset($_POST['semail']);
unset($sname);
unset($spassword);
unset($semail);

header("Location: signup.php?success=true");

} else {

$_POST['sname'] = $sname;
$_POST['spassword'] = $spassword;
$_POST['semail'] = $semail;


header("Location: signup.php?failed=true");

}



}
}
}
}




if(isset($_GET['success'])){
if($_GET['success'] == 'true'){

$gmess .= 'Account created!<br/>You are now logged in and ready to chat!<br />';

}
}





if(isset($_GET['failed'])){
if($_GET['failed'] == 'true'){

$errors .= 'Account was not successfully created!<br />
Please checkout <a href="support.php">Suppot</a> to tell us at once!';

}
}

?>



<ul id="jsddm">
<li><a href="support.php" class="norm" title="Report an Error">Support</a></li>
<li id="on"><a href="signup.php" class="norm" title="Sign Up!">Sign Up</a></li>
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
<h3>Why Sign Up?</h3>
Because we provide safe chatting, messaging, parent monitoring, admin monitoring and bad word blocking.
</div>


<div id="Content">
<h2>Sign Up</h2>

<a href="signup.php" class="support">Sign Up</a> - <a href="signup_parent.php" class="support">Parent Sign Up</a>
<br /><br />

Fill out this one-step form and you�ll be chatting seconds later!
<br />


<?php

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



if(!(empty($mess))){

?>

<div id="mess">
<?php echo $mess; ?>
</div>

<?php

}

?>



<span id="red">Required*</span>
<br />
<br />


<form action="signup.php?signup=true" method="post">
<p>
<label id="form_down">Username<span id="red">*</span></label><br /> <input type="text" size="45" value="
<?php

if(isset($_POST['sname'])){
echo $_POST['sname'];
}


?>
" name="sname" maxlength="15" />
<br />
<br />
<label id="form_down">Password<span id="red">*</span></label><br /> <input type="text" size="45" value="
<?php

if(isset($_POST['spassword'])){
echo $_POST['spassword'];
}


?>
" name="spassword" maxlength="30" />
<br />
<br />
<label id="form_down">Confirm Password<span id="red">*</span></label><br /> <input type="text" size="45" value="
<?php

if(isset($_POST['spassword_confirm'])){
echo $_POST['spassword_confirm'];
}


?>
" name="spassword_confirm" maxlength="30" />
<br />
<br />
<label id="form_down">Email</label><br /> <input type="text" size="45" value="
<?php

if(isset($_POST['semail'])){
echo $_POST['semail'];
}


?>
" name="semail" maxlength="50" />
<br />
<br />
<span id="terms">You agree to our <a href="privacy.php">Privacy</a> by submiting this form. Your email will only be used for retreving your password or for important inforamtion concerning your safty.</span>
<input type="submit" value="Sign Up!" id="bsp" />
</p>
</form>
</div>


<?php

include('Includes/footer.php');

?>