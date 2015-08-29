<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, messsage, messages, messaging';
$des = 'Send messages to your friends through wechitchat.';

$title = 'Account - Messages';
$change = 'false';

include('Includes/header.php');



if(!(isset($_COOKIE['user']))){


header("Location: index.php");



} elseif(isset($_COOKIE['user'])){


$date = date('ymdHi');

$sql = "UPDATE users SET last_logged = '$date' WHERE name= '$_COOKIE[user]'";
mysql_query($sql);




if(isset($_GET['delete'])){
if($_GET['delete'] == 'true'){
if(isset($_GET['id'])){


$sql2 = "DELETE FROM messages WHERE id = '$_GET[id]'";
mysql_query($sql2);


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
<form action="new_message.php" method="post">
Messages
<input type="submit" id="esubmit88" value="New Message" />
</form>
</div>

</h1>

<div id="pcontent">



<?php


$number = mysql_num_rows(mysql_query("SELECT * FROM messages WHERE m_to = '$_COOKIE[user]'"));


if($number < 1){
echo 'You do not have messages.';
} else {

if($number > 1){
echo 'You have '.$number.' messages';
} elseif($number = 1) {
echo 'You have '.$number.' message';
}

}



echo '<br /><br />';


if(!(empty($gmess))){

?>

<div id="gmess">
<?php echo $gmess; ?>
</div>


<?php

}


$per_page = 10;


if(isset($_GET['start'])){
$start = $_GET['start'];
} else {
$start = 0;
}


$record_count = mysql_num_rows(mysql_query("SELECT * FROM messages"));

$max_pages = $record_count / $per_page;

if(!$start){

$start = 0;

}


$query = "SELECT * FROM messages WHERE m_to = '$_COOKIE[user]' ORDER BY date DESC LIMIT $start, $per_page";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$id = $row['id'];
$to = $row['m_to'];
$from = $row['m_from'];
$message = $row['message'];
$date = returnMess($row['date']);



?>

<ul id="message_show">
<li>

<?php

$query3 = "SELECT * FROM users WHERE name = '$from' LIMIT 1";
$result3 = mysql_query($query3);


while($row3 = mysql_fetch_array($result3)){
$pic = $row3['pic'];


if($pic === ''){

?>

<a href="people_profile.php?user=<?php echo $from; ?>"><img src="User_Images/none.png" id="user" width="50" height="50" alt=""></a>

<?php } else { ?>

<a href="people_profile.php?user=<?php echo $from; ?>"><img src="User_Images/<?php echo $pic; ?>" id="user" width="50" height="50" alt=""></a>

<?php

}

}

?>

<div id="delete_mess">
<form action="messages.php" method="get">
<?php echo $date; ?>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="delete" value="true" />
<input type="submit" id="esubmit91" value="Delete" />
</form>
</div>
<div id="message_up"><a href="people_profile.php?user=<?php echo $from; ?>"><?php echo $from; ?></a><br /><?php echo $message; ?></div>
</li>
</ul>




<?php

}


$number = mysql_num_rows(mysql_query("SELECT * FROM messages WHERE m_to = '$_COOKIE[user]'"));

if($number > $per_page){
 
 

echo '<hr style="border: 1px solid #DDDDDD; width: 100%; float: left;" /> <br /><span class="pag"></span>';


$prev = $start - $per_page;
$next = $start + $per_page;



if(!($start<=0)){
echo '<a href="messages.php?start='.$prev.'">Prev</a>&ensp;';
}



$i = 1;

for($x=0; $x<$record_count; $x = $x + $per_page){

if($start != $x){

echo' <a href="messages.php?start='.$x.'">'.$i.'</a> ';

} else {
echo' <a href="messages.php?start='.$x.'" style="font-size: 20px;"><b>'.$i.'</b></a> ';
}

$i++;


}


if(!($start>=$record_count-$per_page)){
echo '&ensp;<a href="messages.php?start='.$next.'">Next</a>';
}




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