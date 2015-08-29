<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting';
$des = 'WeChitChat is a secure and safe place for young kids and teens to chat.';

if(isset($_COOKIE['parent'])){


$title = 'Account - Parental Controls';
$change = 'false';

include('Includes/header.php');

$errors = '';
$gmess = '';



if(isset($_GET['addc'])){
if($_GET['addc'] == 'true'){


if(isset($_POST['cname']) && isset($_POST['cpassword']) && empty($errors)){


$query = "SELECT * FROM users WHERE name = '$_POST[cname]' AND password = '$_POST[cpassword]'";
$result = mysql_query($query);



$num = mysql_num_rows($result);

if($num < 1){
$errors .= 'That user does not exist<br />';
}



while($row = mysql_fetch_array($result)){
$name = $row['name'];
$password = $row['password'];
$child = $row['child'];

if($name === $_POST['cname'] && $password === $_POST['cpassword']){


if($child === $_COOKIE['parent']){
$errors .= $_POST['cname'].' is already you child';
} else {


if($child === ''){


if(isset($_POST['cname']) && isset($_POST['cpassword']) && empty($errors)){

$sql = "UPDATE users SET child = '$_COOKIE[parent]' WHERE name = '$_POST[cname]' AND password = '$_POST[cpassword]'";
mysql_query($sql);


$gmess .= 'You have successfully set '.$_POST['cname'].' has your child';


} else {
$errors .= 'Error';
}


} else {
$errors .= $_POST['cname'].' is someone elses child';
}

}

} else {
$errors .= 'That user don\'t exist';
}


}

} else {
$errors .= 'That user don\'t exist';
}




}
}



if(isset($_GET['options'])){
if($_GET['options'] == 'true'){
if(isset($_GET['type'])){


if($_GET['type'] == 'Manage'){
header("Location: manage_kid.php?id=".$_GET["id"]."&name=".$_GET["name"]."&password=".$_GET["password"]."");
}


if($_GET['type'] == 'Detach User'){

$sql = "UPDATE users SET child = '' WHERE id = '$_GET[id]'";
mysql_query($sql);

header("Location: index.php");

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


<li><a href="#" class="iit" id="spec_on">Account</a>
<ul id="drop_men">
<li><a href="index.php" class="dropper">Parental Controls</a></li>
<li><a href="logout.php" class="bott">Logout</a></li>
</ul>

</li>
</ul>

</div>


<div id="Content1">
<div id="fleft">

<img src="User_Images/none.png" id="user" width="150" height="150" alt="">


<div id="LogLinks">
<ul>
<li><a href="index.php" id="onp">Parental Controls</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

</div>

<div id="fright">


<h1 id="prof">
<div id="bord">
Parental Controls
</div>
</h1>

<div id="pcontent">


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

?>


<form action="index.php?addc=true" method="post">
<p>
<label id="n">Child's Username</label> <input type="text" name="cname" id="name" value="<?php if(isset($_POST['cname'])){ echo $_POST['cname']; } ?>" maxlength="50" />
<br /><br />
<label id="n" class="nl">Child's Password</label> <input type="password" name="cpassword" id="password" value="<?php if(isset($_POST['cpassword'])){ echo $_POST['cpassword']; } ?>" maxlength="50" />
<br />
<input type="submit" value="Add Child" id="esubmit79" />
</p>
</form>

<?php

$query = "SELECT * FROM users WHERE child = '$_COOKIE[parent]'";
$result = mysql_query($query);

$num = mysql_num_rows($result);

if($num >= 1){

?>

<fieldset>
<legend><b>Manage Child Accounts</b></legend>

<div id="utop">Picture</div>
<div id="utop2">Name</div>
<div id="utop3">Last On</div>
<div id="utop4">Options</div>
<br /><br />
<?php

}


$per_page = 10;

if(isset($_GET['start'])){
$start = $_GET['start'];
} else {
$start = 0;
}

$record_count = mysql_num_rows(mysql_query("SELECT * FROM users WHERE child = '$_COOKIE[parent]' "));

$max_pages = $record_count / $per_page;

if(!$start){

$start = 0;

}



$query = "SELECT * FROM users WHERE child = '$_COOKIE[parent]' LIMIT $start, $per_page";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$id = $row['id'];
$name = $row['name'];
$password = $row['password'];
$email = $row['email'];
$image = $row['image'];
$about = $row['about'];
$pic = $row['pic'];
$last_logged = $row['last_logged'];
$joined = $row['joined'];
$age = $row['age'];
$gender = $row['gender'];





if($pic === ''){

?>

<a href="manage_kid.php?id=<?php echo $id; ?>&name=<?php echo $name; ?>&password=<?php echo $password; ?>"><img src="User_Images/none.png" id="user" width="50" height="50" alt=""></a>

<?php } else { ?>

<a href="manage_kid.php?id=<?php echo $id; ?>&name=<?php echo $name; ?>&password=<?php echo $password; ?>"><img src="User_Images/<?php echo $pic; ?>" id="user" width="50" height="50" alt=""></a>

<?php

}

?>

<div id="name_par"><?php echo $name; ?></div>
<div id="name_par2"><?php echo returnMess($last_logged); ?></div>

<form action="index.php" method="get">
<input type="hidden" name="options" value="true" />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="name" value="<?php echo $name; ?>" />
<input type="hidden" name="password" value="<?php echo $password; ?>" />
<input type="submit" name="type" id="esubmit175" value="Manage" />
<input type="submit" name="type" id="esubmit17" value="Detach User" />
</form>


<?php


}




$number = mysql_num_rows(mysql_query("SELECT * FROM users WHERE child = '$_COOKIE[parent]'"));

if($number > $per_page){
 
 

echo '<hr style="border: 1px solid #DDDDDD; width: 100%; float: left;" /> <br /><span class="pag"></span>';


$prev = $start - $per_page;
$next = $start + $per_page;



if(!($start<=0)){
echo '<a href="index.php?start='.$prev.'">Prev</a>&ensp;';
}



$i = 1;

for($x=0; $x<$record_count; $x = $x + $per_page){

if($start != $x){

echo' <a href="index.php?start='.$x.'">'.$i.'</a> ';

} else {
echo' <a href="index.php?start='.$x.'" style="font-size: 20px;"><b>'.$i.'</b></a> ';
}

$i++;


}


if(!($start>=$record_count-$per_page)){
echo '&ensp;<a href="index.php?start='.$next.'">Next</a>';
}




}






$query = "SELECT * FROM users WHERE child = '$_COOKIE[parent]'";
$result = mysql_query($query);

$num = mysql_num_rows($result);

if($num >= 1){

?>

</fieldset>

<?php

}

?>

</div>

</div>

</div>



<?php


} else {




if(!(isset($_COOKIE['user']))){


$title = 'Home'; 

include('Includes/header.php');




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



<div id="SideBarR1">
<h3>Login</h3>

<form action="login.php?login=true" method="post">
<p>
<div id="log_index">
<label id="n">Username</label> <input type="text" name="lname" id="name" maxlength="50" />
<br />	
Password <input type="password" name="lpassword" id="password" maxlength="50" />
</div>
<input type="submit" value="Login" id="isubmit" />
</p>
</form>
</div>



<div id="Content">
<h2>Chatting Safe With We Chit Chat</h2>
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!blab hub bub! Blabu il blab blah bla!
</div>


<div id="SideBarR2">
<h3>Sign Up</h3>

<form action="signup.php?signup=true" method="post">
<p>
<div id="log_index">
<label id="n">Username</label> <input type="text" value="
<?php

if(isset($_POST['sname'])){
echo $_POST['sname'];
}


?>
" name="sname" id="name" maxlength="50" />
<br />
Password <input type="text" value="
<?php

if(isset($_POST['spassword'])){
echo $_POST['spassword'];
}


?>
" name="spassword" id="password" maxlength="30" />
<br />
<label id="e">Email</label> <input type="text" value="
<?php

if(isset($_POST['semail'])){
echo $_POST['semail'];
}


?>
" name="semail" id="email" maxlength="50" />
</div>
<input type="submit" value="Sign Up" id="esubmit" />
</p>
</form>
</div>

<?php

} elseif(isset($_COOKIE['user'])){


$title = "Account - Overview";
$change = 'false';

include('Includes/header.php');





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
<li><a href="index.php" class="dropper">Overview</a></li>
<li><a href="messages.php">Messages</a></li>
<li><a href="editprofile.php">Edit Profile</a></li>
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





<div id="Content1">



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



$errors = '';


if(isset($_GET['post'])){
if($_GET['post'] == 'true'){


if(!(empty($_POST['message']))){




if(empty($errors)){

$date = date('ymdHi');

$_POST['message'] = htmlentities(stripslashes(trim(mysql_prep($_POST['message']))));
$_POST['message'] = trim(mysql_prep($_POST['message']));

badw($_POST['message']);
$_POST['message'] = badw($_POST['message']);

$sql = "INSERT INTO posts (under, p_by, message, date) VALUES ('$_POST[user]', '$_COOKIE[user]', '$_POST[message]','$date')";
mysql_query($sql);

header("Location: index.php");


}



} else {

$errors .= 'The post is empty';

}


}
}



if(isset($_GET['delete'])){
if($_GET['delete'] == 'true'){
if(isset($_GET['id'])){


$sql = "DELETE FROM posts WHERE id = '$_GET[id]'";
mysql_query($sql);

header("Location: index.php");


}
}
}



?>

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
<div id="LogLinks">
<ul>
<li><a href="index.php" id="onp">Overview</a></li>
<li><a href="messages.php">Messages</a></li>
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
<?php echo $_COOKIE['user']; ?>
</div>
</h1>

<div id="pcontent">


<?php

if(!(empty($errors))){

?>

<div id="errors">
<?php echo $errors; ?>
</div>

<?php

}

?>


<form action="index.php?post=true" method="post">
<input type="text" name="message" size="98" value="<?php if(isset($_POST['message'])){ echo $_POST['message']; }?>">
<input type="hidden" name="user" value="<?php echo $_COOKIE['user']; ?>">
<input type="submit" value="Post" id="psubmit" />
</form>

<?php


echo '<br /><br />';




$per_page = 10;


if(isset($_GET['start'])){
$start = $_GET['start'];
} else {
$start = 0;
}



$record_count = mysql_num_rows(mysql_query("SELECT * FROM posts"));

$max_pages = $record_count / $per_page;

if(!$start){

$start = 0;

}



$query = "SELECT * FROM posts WHERE under = '$_COOKIE[user]' ORDER BY date DESC LIMIT $start, $per_page";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$id = $row['id'];
$under = $row['under'];
$by = $row['p_by'];
$message = $row['message'];
$date = $row['date'];
$date = returnMess($row['date']);


if($under === $_COOKIE['user']){

?>


<ul id="post_show">
<li>


<?php



$query9 = "SELECT * FROM users WHERE name = '$by' LIMIT 1";
$result9 = mysql_query($query9);


while($row9 = mysql_fetch_array($result9)){
$pic = $row9['pic'];


if($pic === ''){

?>

<a href="people_profile.php?user=<?php echo $by; ?>"><img src="User_Images/none.png" id="user" width="50" height="50" alt="<?php echo $by; ?>"></a>

<?php } else { ?>

<a href="people_profile.php?user=<?php echo $by; ?>"><img src="User_Images/<?php echo $pic; ?>" id="user" width="50" height="50" alt="<?php echo $by; ?>"></a>

<?php

}

}



?>



<div id="delete_mess">
<form action="index.php" method="get">
<?php echo $date; ?>
<?php

if($by === $_COOKIE['user']){

?>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="delete" value="true" />
<input type="submit" id="esubmit91" value="Delete" />

<?php

}




}




?>

</form>
</div>
<div id="message_up"><a href="people_profile.php?user=<?php echo $by; ?>"><?php echo $by; ?></a><br /><?php echo $message; ?></div>
</li>
</ul>

<?php


}


$number = mysql_num_rows(mysql_query("SELECT * FROM posts WHERE under = '$_COOKIE[user]'"));

if($number > $per_page){



echo '<hr style="border: 1px solid #DDDDDD; width: 100%; float: left;" /> <br /><span class="pag"></span>';


$prev = $start - $per_page;
$next = $start + $per_page;



if(!($start<=0)){
echo '<a href="index.php?start='.$prev.'">Prev</a>&ensp;';
}



$i = 1;

for($x=0; $x<$record_count; $x = $x + $per_page){

if($start != $x){

echo' <a href="index.php?start='.$x.'">'.$i.'</a> ';

} else {
echo' <a href="index.php?start='.$x.'" style="font-size: 20px;"><b>'.$i.'</b></a> ';
}

$i++;


}


if(!($start>=$record_count-$per_page)){
echo '&ensp;<a href="index.php?start='.$next.'">Next</a>';
}






}


?>



</div>

</div>


<?php

} elseif(isset($_COOKIE['user'])){

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

} else {
echo 'There was an error please report this to us by going to the<a href="support.php">support</a> page';
}

}





?>
</div>

<?php

} else {

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
<li><a href="index.php" class="dropper">Overview</a></li>
<li><a href="messages.php">Messages</a></li>
<li><a href="editprofile.php">Edit Profile</a></li>
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





<div id="Content1">
There was an error!<br /> please go to <a href="support.php">Support</a> to submit it.  Sorry for the inconcence.
</div>




<?php



}

}


include('Includes/footer.php');

?>