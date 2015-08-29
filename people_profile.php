<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, people\'s profile';
$des = 'People\'s profiles.';


if(isset($_GET['user'])){

$title = 'Account - '.$_GET['user'].'\'s Profile';
$change = 'false';


include('Includes/header.php');


if(!(isset($_COOKIE['user']))){


header("Location: index.php");



} elseif(isset($_COOKIE['user'])){

$date = date('ymdHi');

$sql = "UPDATE users SET last_logged = '$date' WHERE name= '$_COOKIE[user]'";
mysql_query($sql);



// Message


if(isset($_GET['type'])){
if($_GET['type'] == 'Mess_F'){
if(isset($_GET['user'])){

header("Location: new_message.php?name=$_GET[user]");

}
}
}





// Add Friend

if(isset($_GET['type'])){
if($_GET['type'] == 'Add_F'){
if(isset($_GET['user'])){

$sql = "INSERT INTO $_GET[user] (name, verifed, maker) VALUES ('$_COOKIE[user]', 'no', 'no')";
mysql_query($sql);

header("Location: people_profile.php?user=$_GET[user]");

}
}
}




// Accept Friend

if(isset($_GET['type'])){
if($_GET['type'] == 'Accept_F'){
if(isset($_GET['user'])){

$sql = "INSERT INTO $_GET[user] (name, verifed, maker) VALUES ('$_COOKIE[user]', 'yes', 'no')";
mysql_query($sql);

$sql2 = "DELETE FROM $_COOKIE[user] WHERE name = '$_GET[user]'";
mysql_query($sql2);

$sql3 = "INSERT INTO $_COOKIE[user] (name, verifed, maker) VALUES ('$_GET[user]', 'yes', 'no')";
mysql_query($sql3);

header("Location: people_profile.php?user=$_GET[user]");

}
}
}



// posts

if(isset($_GET['post'])){
if($_GET['post'] == 'true'){

if(!(empty($_POST['message']))){


if(empty($errors)){

$date = date('ymdHi');

badw($_POST['message']);
$_POST['message'] = badw($_POST['message']);

$sql = "INSERT INTO posts (under, p_by, message, date) VALUES ('$_POST[user]', '$_COOKIE[user]', '$_POST[message]','$date')";
mysql_query($sql);

header("Location: people_profile.php?user=$_POST[user]");

}

} else {

$errors .= 'The post is empty';

}


}
}




if(isset($_GET['type'])){
if($_GET['type'] == 'remove_f'){
if(isset($_GET['user'])){

$sql = "DELETE FROM $_GET[user] WHERE name = '$_COOKIE[user]'";
mysql_query($sql);

$sql = "DELETE FROM $_COOKIE[user] WHERE name = '$_GET[user]'";
mysql_query($sql);

header("Location: people_profile.php?user=$_GET[user]");

}
}
}




if(isset($_GET['delete'])){
if($_GET['delete'] == 'true'){
if(isset($_GET['id'])){


$sql = "DELETE FROM posts WHERE id = '$_GET[id]'";
mysql_query($sql);

header("Location: people_profile.php?user=$_GET[user]");


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
<li><a href="editprofile.php">Edit Profile</a></li>
<li><a href="people.php"  class="dropper">People</a></li>
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

$query = "SELECT * FROM users WHERE name = '$_GET[user]' LIMIT 1";

$result = mysql_query($query);


while($row = mysql_fetch_array($result)){
$name = $row['name'];
$about = $row['about'];

if($about == 'none'){
$about = '';
}



?>

<div id="Content1">
<div id="fleft">

<?php

$query = "SELECT * FROM users WHERE name = '$_GET[user]' LIMIT 1";
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

?>



<div id="LogLinks">
<ul>
<li><a href="index.php">Overview</a></li>
<li><a href="messages.php">Messages</a></li>
<li><a href="editprofile.php">Edit Profile</a></li>
<li><a href="people.php" id="onp">People</a></li>
<li><a href="friends.php">Friends</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

</div>


<div id="fright">


<h1 id="prof">
<div id="bord">
<?php 


if(isset($_GET['user'])){
if(empty($_GET['user'])){

echo 'There was an error';

} else {



// If it is you

if($_COOKIE['user'] === $_GET['user']){
header("Location: index.php");
}





$query4 = "SELECT * FROM $_GET[user] WHERE name = '$_COOKIE[user]' and maker = 'no' and verifed = 'yes'";
$result4 = mysql_query($query4);

while($row4 = mysql_fetch_array($result4)){
$name = $row4['name'];


// If he is your friend


$messagei = ''.$_GET['user'].'\'s Profile
<form action="people_profile.php" method="get">
<input type="hidden" name="user" value="'.$_GET['user'].'" />
<input type="hidden" name="type" value="Mess_F" />
<input type="submit" id="esubmit4" value="Message" />
</form>
';


}






$query2 = "SELECT * FROM $_COOKIE[user] WHERE name = '$_GET[user]' and maker = 'no' and verifed = 'no'";
$result2 = mysql_query($query2);

while($row2 = mysql_fetch_array($result2)){
$name = $row2['name'];

// If he has asked you to be his friend


$messagei = '<form action="people_profile.php" method="get">'.$_GET['user'].'\'s Profile
<input type="hidden" name="user" value="'.$_GET['user'].'" />
<input type="hidden" name="type" value="Accept_F" />
<input type="submit" id="esubmit3" value="Accept Friend" />
</form>

<form action="people_profile.php" method="get">
<input type="hidden" name="user" value="'.$_GET['user'].'" />
<input type="hidden" name="type" value="Mess_F" />
<input type="submit" id="esubmit4" value="Message" />
</form>
';


}







$query3 = "SELECT * FROM $_COOKIE[user] WHERE name = '$_GET[user]' and maker = 'no' and verifed = 'yes'";
$result3 = mysql_query($query3);

while($row3 = mysql_fetch_array($result3)){
$name = $row3['name'];


// If you are his friend


$messagei = ''.$_GET['user'].'\'s Profile
<form action="people_profile.php" method="get">
<input type="hidden" name="user" value="'.$_GET['user'].'" />
<input type="hidden" name="type" value="Mess_F" />
<input type="submit" id="esubmit4" value="Message" />
</form>

<form action="chitchat.php" method="get">
<input type="hidden" name="user" value="'.$_GET['user'].'" />
<input type="hidden" name="start" value="0" />
<input type="submit" id="esubmit18" value="Chit Chat" />
</form>

<form action="people_profile.php" method="get">
<input type="hidden" name="user" value="'.$_GET['user'].'" />
<input type="hidden" name="type" value="remove_f" />

';

?>

<input type="submit" id="esubmit16" onclick="return confirm('Are you sure you want to remove <?php echo $name; ?> from your friends?')" value="Remove Friend" />
</form>

<?php

}





// Last worked on spot


$query11 = "SELECT * FROM $_GET[user] WHERE name = '$_COOKIE[user]' and maker = 'no' and verifed = 'no'";
$result11 = mysql_query($query11);

while($row11 = mysql_fetch_array($result11)){
$name = $row11['name'];


$messagei = ''.$_GET['user'].'\'s Profile
<form action="people_profile.php" method="get">
<input type="hidden" name="user" value="'.$_GET['user'].'" />
<input type="hidden" name="type" value="Mess_F" />
<input type="submit" id="esubmit4" value="Message" />
</form>
';


}




if(isset($messagei)){
if(empty($messagei)){

echo ''.$_GET['user'].'\'s Profile
<form action="people_profile.php" method="get">
<input type="hidden" name="user" value="'.$_GET['user'].'" />
<input type="hidden" name="type" value="Mess_F" />
<input type="submit" id="esubmit4" value="Message" />
</form>
';


} else {

echo $messagei;



}

} else {
echo '<form action="people_profile.php" method="get">'.$_GET['user'].'\'s Profile
<input type="hidden" name="user" value="'.$_GET['user'].'" />
<input type="hidden" name="type" value="Add_F" />
<input type="submit" id="esubmit3" value="Add Friend" />
</form>

<form action="people_profile.php" method="get">
<input type="hidden" name="user" value="'.$_GET['user'].'" />
<input type="hidden" name="type" value="Mess_F" />
<input type="submit" id="esubmit4" value="Message" />
</form>
';
}




}
} else {
echo 'There was an error';
}



?>
</div>

</h1>

<div id="pcontent">


<?php

$query = "SELECT * FROM $_COOKIE[user] WHERE name = '$_GET[user]' AND verifed = 'yes'";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$id = $row['id'];
$name = $row['name'];
$verifed = $row['verifed'];
$maker = $row['maker'];


?>


<form action="people_profile.php?post=true&user=<?php echo $_GET['user']; ?>" method="post">
<input type="text" name="message" size="98">
<input type="hidden" name="user" value="<?php echo $_GET['user']; ?>">
<input type="submit" value="Post" id="psubmit" />
</form>



<?php

}

$query = "SELECT * FROM $_COOKIE[user] WHERE name = '$_GET[user]' AND verifed = 'yes'";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){



echo '<br /><br />';


$query = "SELECT * FROM posts WHERE under = '$_GET[user]' ORDER BY date DESC LIMIT 25";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$id = $row['id'];
$under = $row['under'];
$by = $row['p_by'];
$message = $row['message'];
$date = $row['date'];
$date = returnMess($row['date']);


if($under === $_GET['user']){

?>


<ul id="post_show">
<li>
<a href="people_profile.php?user=<?php echo $by; ?>"><img src="User_Images/none.png" id="user" width="50" height="50" alt="<?php echo $by; ?>"></a>

<div id="delete_mess">
<form action="people_profile.php" method="get">
<?php echo $date; ?>
<?php

if($by === $_COOKIE['user']){

?>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="user" value="<?php echo $_GET['user']; ?>" />
<input type="hidden" name="delete" value="true" />
<input type="submit" id="esubmit91" value="Delete" />

<?php






}

?>

</form>
</div>
<div id="message_up"><a href="people_profile.php?user=<?php echo $by; ?>"><?php echo $by; ?></a><br /><?php echo $message; ?></div>
</li>
</ul>


<?php

}

}



}

?>



</div>

</div>

</div>

<?php

include('Includes/footer.php');



}

} else {

header("Location: people_profile.php");

}

?>