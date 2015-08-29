<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, login, log in';
$des = 'We support all wechitchat users.  If you need help or want to report an error, this is the place.';

$title = 'Login';

include('Includes/header.php');

$errors = "";



if(isset($_GET['login'])){
if($_GET['login'] == 'true'){
if(isset($_POST['lname']) && isset($_POST['lpassword']) && empty($errors)){



$query = "SELECT * FROM users WHERE name = '$_POST[lname]' AND password = '$_POST[lpassword]'";


$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$name = $row['name'];
$password = $row['password'];

if($name === $_POST['lname'] && $password === $_POST['lpassword']){


$query = "SELECT * FROM users WHERE name = '$_POST[lname]' AND password = '$_POST[lpassword]'";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$class = $row['class'];

if($class === 'kid'){
setcookie("user","$_POST[lname]",time() + (3600* 7));
} elseif($class === 'parent'){
setcookie("parent","$_POST[lname]",time() + (3600* 7));
}


}


$date = date('ymdHi');

$sql = "UPDATE users SET last_logged = '$date' WHERE name= '$_POST[lname]'";
mysql_query($sql);


header('Location: index.php');


} else {
$errors .= 'There was an error please visit <a href="support.php">Support</a>'; 
}

}

$num = mysql_num_rows($result);

if($num < 1){
$errors .= 'That user does not exist<br />';
}




}
}
}


?>


<ul id="jsddm">
<li><a href="support.php" class="norm" title="Report an Error">Support</a></li>
<li><a href="signup.php" class="norm" title="Sign Up!">Sign Up</a></li>
<li id="on"><a href="login.php" class="norm" title="Log In">Log In</a></li>
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




<?php


if(!(isset($_COOKIE['user'])) && !(isset($_COOKIE['parent']))){


?>



<div id="SideBarR1">
<h3>Trouble Logging In?</h3>

Are you having trouble logging into your account?  
There are three things that could be causing this:
<ol>
<li>That account does not exist</li>
<li>You forgot your account login</li>
<li>There is an error</li>
</ol>

<a href="get_pass.php">Retreve Lost Account</a>
<br /><br />
If you believe this to be an error please see <a href="support.php">Support</a> and let us know so we can fix it as fast as possible.
</div>



<div id="Content">
<h1>Login</h1>


<?php

if(isset($errors)){

?>

<div id="errors">
<?php echo $errors; ?>
</div>

<?php


}


?>

<form action="login.php?login=true" method="post">
<p>
<label>Name</label><br /> <input type="text" name="lname" size="45" value="
<?php

if(isset($_POST['lname'])){
echo $_POST['lname'];
}


?>
" maxlength="100" />
<br />
<br />
<label>Password</label><br /> <input type="password" size="45" value="
<?php

if(isset($_POST['lpassword'])){
echo $_POST['lpassword'];
}


?>
" name="lpassword" maxlength="100" />
<br />
<input type="submit" value="Login" id="bsp" />
</p>
</form>
</div>

<?php

} else {

?>

<div id="Content1">
<h2>Login</h2>

<?php 

if(isset($_COOKIE['user'])){
echo 'Your already logged in as '.$_COOKIE['user'].'.'; 
}

if(isset($_COOKIE['parent'])){
echo 'Your already logged in as '.$_COOKIE['parent'].'.'; 
}



?>
<br /><a href="logout.php">Logout</a>


</div>

<?php

}

include('Includes/footer.php');

?>