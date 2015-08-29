<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, friends';
$des = 'Your wechitchat friends.';

$title = 'Account - Friends';
$change = 'false';

include('Includes/header.php');



$per_page = 10;

if(isset($_GET['start'])){
$start = $_GET['start'];
} else {
$start = 0;
}

$record_count = mysql_num_rows(mysql_query("SELECT * FROM $_COOKIE[user] WHERE maker = 'no' and verifed = 'yes'"));

$max_pages = $record_count / $per_page;

if(!$start){

$start = 0;

}




$per_page2 = 10;

if(isset($_GET['start2'])){
$start2 = $_GET['start2'];
} else {
$start2 = 0;
}

$record_count2 = mysql_num_rows(mysql_query("SELECT * FROM $_COOKIE[user] WHERE maker = 'no' and verifed = 'no'"));

$max_pages2 = $record_count2 / $per_page2;

if(!$start2){

$start2 = 0;

}



if(!(isset($_COOKIE['user']))){


header("Location: index.php");



} elseif(isset($_COOKIE['user'])){


$date = date('ymdHi');

$sql = "UPDATE users SET last_logged = '$date' WHERE name= '$_COOKIE[user]'";
mysql_query($sql);





$gmess = '';


if(isset($_GET['edit'])){
if($_GET['edit'] == 'true'){
if(isset($_POST['con_name'])){




if(isset($_POST['confirm'])){

$sql = "INSERT INTO $_POST[con_name] (name, verifed, maker) VALUES ('$_COOKIE[user]', 'yes', 'no')";
mysql_query($sql);

$sql2 = "DELETE FROM $_COOKIE[user] WHERE name = '$_POST[con_name]'";
mysql_query($sql2);

$sql3 = "INSERT INTO $_COOKIE[user] (name, verifed, maker) VALUES ('$_POST[con_name]', 'yes', 'no')";
mysql_query($sql3);

header("Location: friends.php?success_c=true&name=$_POST[con_name]");

}




if(isset($_POST['notn'])){

$sql = "DELETE FROM $_COOKIE[user] WHERE name = '$_POST[con_name]'";
mysql_query($sql);

header("Location: friends.php");

}




} else {
echo 'Sorry an error has acured.';
}
}
}





if(isset($_GET['success_c'])){
if($_GET['success_c'] == 'true'){

$gmess .= 'You have successfully added '.$_GET['name'].' to your friends list';

}
}



if(isset($_GET['type'])){
if($_GET['type'] == 'remove_f'){
if(isset($_GET['user'])){

$sql = "DELETE FROM $_GET[user] WHERE name = '$_COOKIE[user]'";
mysql_query($sql);

$sql = "DELETE FROM $_COOKIE[user] WHERE name = '$_GET[user]'";
mysql_query($sql);

header("Location: friends.php");

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
<li><a href="messages.php">Messages</a></li>
<li><a href="editprofile.php">Edit Profile</a></li>
<li><a href="people.php">People</a></li>
<li><a href="friends.php" id="onp">Friends</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

</div>


<div id="fright">


<h1 id="prof">
<div id="bord">
Friends
</div>

</h1>

<div id="pcontent">



<?php



$number = mysql_num_rows(mysql_query("SELECT * FROM $name WHERE maker = 'no' and verifed = 'yes'"));


 if($number < 1){
echo 'You do not have any friends yet.<br />Search for <a href="people.php" title="people">people</a>';
} else {

if($number > 1){
echo 'You have '.$number.' friends';
} elseif($number = 1) {
echo 'You have '.$number.' friend';
}

}



echo '<br />';


if(!(empty($gmess))){

?>

<div id="gmess">
<?php echo $gmess; ?>
</div>

<?php

}



$query = "SELECT * FROM $_COOKIE[user] WHERE maker = 'no' and verifed = 'yes' LIMIT $start, $per_page";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$name = $row['name'];



$query1 = "SELECT * FROM users WHERE name = '$name'";
$result1 = mysql_query($query1);

while($rowt = mysql_fetch_array($result1)){
$pic = $rowt['pic'];



if($pic === ''){

?>

<a href="people_profile.php?user=<?php echo $name; ?>"><img src="User_Images/none.png" id="user" width="50" height="50" alt="" class="specic"></a>

<?php } else { ?>

<a href="people_profile.php?user=<?php echo $name; ?>"><img src="User_Images/<?php echo $pic; ?>" id="user" width="50" height="50" alt="" class="specic"></a>

<?php

}

?>

<form action="friends.php" method="get">
<input type="hidden" name="user" value="<?php echo $name; ?>" />
<input type="hidden" name="type" value="remove_f" />
<input type="submit" id="esubmit15" onclick="return confirm('Are you sure you want to remove <?php echo $name; ?> from your friends?')" value="Remove Friend" />
</form>


<?php


echo '<div id="friends"><a href="people_profile.php?user='.$name.'" class="specic">'.$name.'</a></div>';

}

}




$number = mysql_num_rows(mysql_query("SELECT * FROM $_COOKIE[user] WHERE maker = 'no' AND verifed = 'yes'"));

if($number > $per_page){
 


echo '<br /><br /><hr style="border: 1px solid #DDDDDD; width: 100%; float: left;" /> <br /><span class="pag"></span>';


$prev = $start - $per_page;
$next = $start + $per_page;



if(!($start<=0)){
echo '<a href="friends.php?start='.$prev.'">Prev</a>&ensp;';
}



$i = 1;

for($x=0; $x<$record_count; $x = $x + $per_page){

if($start != $x){

echo' <a href="friends.php?start='.$x.'">'.$i.'</a> ';

} else {
echo' <a href="friends.php?start='.$x.'" style="font-size: 20px;"><b>'.$i.'</b></a> ';
}

$i++;


}


if(!($start>=$record_count-$per_page)){
echo '&ensp;<a href="friends.php?start='.$next.'">Next</a>';
}




}





echo '<br /><br />';

$number = mysql_num_rows(mysql_query("SELECT * FROM $_COOKIE[user] WHERE maker = 'no' AND verifed = 'no'"));


if($number >= 1){


?>


<br />

<fieldset>
<legend><b>Friend Requests</b></legend>
<div id="lkn"></div>
<br />
<?php

$query = "SELECT * FROM $_COOKIE[user] WHERE maker = 'no' and verifed = 'no' LIMIT $start2, $per_page2";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$name = $row['name'];


$query1 = "SELECT * FROM users WHERE name = '$name'";
$result1 = mysql_query($query1);

while($rowt = mysql_fetch_array($result1)){
$pic = $rowt['pic'];
$name = $row['name'];


?>


<a href="people_profile.php?user=<?php echo $name; ?>"><img src="User_Images/none.png" class="specic2" id="user" width="80" height="80"></a>
<?php

echo '<div id="friends2"><a href="people_profile.php?user='.$name.'" class="specic2">'.$name.'</a><br /></div>';

?>

<div id="confirm_f">
<form action="friends.php?edit=true" method="post">
<input type="hidden" name="con_name" value="<?php echo $name; ?>" />
<input type="submit" name="confirm" id="esubmit" value="Confirm" />
<input type="submit" name="notn" id="esubmit2" value="Not Now" />
</form>
</div>

<?php

}
}


$number2 = mysql_num_rows(mysql_query("SELECT * FROM $_COOKIE[user] WHERE maker = 'no' AND verifed = 'no'"));

if($number2 > $per_page2){
 


echo '<br /><br /><hr style="border: 1px solid #DDDDDD; width: 100%; float: left;" /> <br /><span class="pag"></span>';


$prev2 = $start2 - $per_page2;
$next2 = $start2 + $per_page2;



if(!($start2<=0)){
echo '<a href="friends.php?start2='.$prev2.'">Prev</a>&ensp;';
}



$i2 = 1;

for($x2=0; $x2<$record_count2; $x2 = $x2 + $per_page2){

if($start2 != $x2){

echo' <a href="friends.php?start2='.$x2.'">'.$i2.'</a> ';

} else {
echo' <a href="friends.php?start2='.$x2.'" style="font-size: 20px;"><b>'.$i2.'</b></a> ';
}

$i2++;


}


if(!($start2>=$record_count2-$per_page2)){
echo '&ensp;<a href="friends.php?start2='.$next2.'">Next</a>';
}




}



?>
<br /><br />
</fieldset>
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