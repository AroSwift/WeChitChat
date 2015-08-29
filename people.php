<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, people';
$des = 'Search for people on wechitchat.';

$title = 'Account - People';
$change = 'false';

include('Includes/header.php');



$per_page = 10;


if(isset($_GET['start'])){
$start = $_GET['start'];
} else {
$start = 0;
}


$record_count = mysql_num_rows(mysql_query("SELECT * FROM users WHERE class = 'kid'"));

$max_pages = $record_count / $per_page;

if(!$start){

$start = 0;

}




if(!(isset($_COOKIE['user']))){


header("Location: login.php");



} elseif(isset($_COOKIE['user'])){

$date = date('ymdHi');

$sql = "UPDATE users SET last_logged = '$date' WHERE name= '$_COOKIE[user]'";
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
<li><a href="editprofile.php">Edit Profile</a></li>
<li><a href="people.php" class="dropper">People</a></li>
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
<div id="fleft">

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
<li><a href="people.php" id="onp">People</a></li>
<li><a href="friends.php">Friends</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

</div>


<div id="fright">


<h1 id="prof">
<div id="bord">
People
</div>

</h1>

<div id="pcontent">


<form action="people.php" method="get" id="search_p">
<input type="hidden" name="tsearch" value="true">
Search: <input type="text" id="search_in" size="50" value="
<?php

if(isset($_GET['search'])){
echo $_GET['search'];
}


?>
" name="search" />
<input type="submit" id="ssubmit" value="Search" />

</form>


<?php


if(isset($_GET['tsearch'])){
if($_GET['tsearch'] === 'true' && !(empty($_GET['search']))){


$_GET['search'] = htmlentities(stripslashes(trim(mysql_prep($_GET['search']))));
$_GET['search'] = trim(mysql_prep($_GET['search']));

$query = "SELECT * FROM users WHERE name LIKE '$_GET[search]%' AND class = 'kid' LIMIT $start, $per_page";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$name = $row['name'];
$password = $row['password'];
$pic = $row['image'];
$about = $row['about'];
$last_logged = $row['last_logged'];
$gender = $row['gender'];



if($pic == 'none'){
$pic = 'none.png';
}

if($about === 'none'){
if($gender == 'Boy'){
$about = 'This user has not written about himself.';
} elseif($gender == 'Girl'){
$about = 'This user has not written about herself.';
} else {
$about = 'This user has not written about themself.';
}
}



?>



<ul id="people_show">
<li>

<?php



$query3 = "SELECT * FROM users WHERE name = '$name' LIMIT 1";
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

<a href="people_profile.php?user=<?php echo $name; ?>"><?php echo $name; ?></a>
<div id="laston">
<?php echo returnDate($last_logged); ?>
</div>
<div id="about_people">
<?php echo $about; ?>
</div>
</li>
</ul>


<?php


}


$number2 = mysql_num_rows(mysql_query("SELECT * FROM users WHERE name LIKE '$_GET[search]%' AND class = 'kid'"));

if($number2 < 1){
echo '<br />The query has turned up empty';
}



$number = mysql_num_rows(mysql_query("SELECT * FROM users WHERE class = 'kid'"));

if($number > $per_page){



echo '<hr style="border: 1px solid #DDDDDD; width: 100%; float: left;" /> <br /><span class="pag"></span>';


$prev = $start - $per_page;
$next = $start + $per_page;



if(!($start<=0)){
echo '<a href="people.php?start='.$prev.'">Prev</a>&ensp;';
}



$i = 1;

for($x=0; $x<$record_count; $x = $x + $per_page){

if($start != $x){

echo' <a href="people.php?start='.$x.'">'.$i.'</a> ';

} else {
echo' <a href="people.php?start='.$x.'" style="font-size: 20px;"><b>'.$i.'</b></a> ';
}

$i++;


}


if(!($start>=$record_count-$per_page)){
echo '&ensp;<a href="people.php?start='.$next.'">Next</a>';
}



}




} else {

// If empty


$query = "SELECT * FROM users WHERE class = 'kid' ORDER BY last_logged DESC LIMIT $start, $per_page";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$name = $row['name'];
$password = $row['password'];
$pic = $row['image'];
$about = $row['about'];
$last_logged = $row['last_logged'];
$gender = $row['gender'];



if($pic == 'none'){
$pic = 'none.png';
}

if($about === 'none'){
if($gender == 'Boy'){
$about = 'This user has not written about himself.';
} elseif($gender == 'Girl'){
$about = 'This user has not written about herself.';
} else {
$about = 'This user has not written about themself.';
}
}





?>




<ul id="people_show">
<li>

<?php

$query3 = "SELECT * FROM users WHERE name = '$name' LIMIT 1";
$result3 = mysql_query($query3);


while($row3 = mysql_fetch_array($result3)){
$pic = $row3['pic'];


if($pic === ''){

?>

<a href="people_profile.php?user=<?php echo $name; ?>"><img src="User_Images/none.png" id="user" width="50" height="50" alt=""></a>

<?php } else { ?>

<a href="people_profile.php?user=<?php echo $name; ?>"><img src="User_Images/<?php echo $pic; ?>" id="user" width="50" height="50" alt=""></a>

<?php

}

}

?>

<a href="people_profile.php?user=<?php echo $name; ?>"><?php echo $name; ?></a>
<div id="laston">
<?php echo returnDate($last_logged); ?>
</div>
<div id="about_people">
<?php echo $about; ?>
</div>
</li>
</ul>

<?php


}

}



$number = mysql_num_rows(mysql_query("SELECT * FROM users WHERE class = 'kid'"));

if($number > $per_page){


echo '<hr style="border: 1px solid #DDDDDD; width: 100%; float: left;" /> <br /><span class="pag"></span>';


$prev = $start - $per_page;
$next = $start + $per_page;


if(!($start<=0)){
echo '<a href="people.php?start='.$prev.'">Prev</a>&ensp;';
}


$i = 1;

for($x=0; $x<$record_count; $x = $x + $per_page){

if($start != $x){

echo' <a href="people.php?start='.$x.'">'.$i.'</a> ';

} else {
echo' <a href="people.php?start='.$x.'" style="font-size: 20px;"><b>'.$i.'</b></a> ';
}

$i++;


}


if(!($start>=$record_count-$per_page)){
echo '&ensp;<a href="people.php?start='.$next.'">Next</a>';
}




}



} else{



$query = "SELECT * FROM users WHERE class = 'kid' ORDER BY last_logged DESC LIMIT $start, $per_page";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$name = $row['name'];
$password = $row['password'];
$pic = $row['image'];
$about = $row['about'];
$last_logged = $row['last_logged'];
$gender = $row['gender'];



if($pic == 'none'){
$pic = 'none.png';
}

if($about === 'none'){
if($gender == 'Boy'){
$about = 'This user has not written about himself.';
} elseif($gender == 'Girl'){
$about = 'This user has not written about herself.';
} else {
$about = 'This user has not written about themself.';
}
} elseif(empty($about)) {
if($gender == 'Boy'){
$about = 'This user has not written about himself.';
} elseif($gender == 'Girl'){
$about = 'This user has not written about herself.';
} else {
$about = 'This user has not written about themself.';
}
}

if(strlen($about) > 150){
$about = substr($about, 0, 150).'...';
}





?>




<ul id="people_show">
<li>

<?php

$query3 = "SELECT * FROM users WHERE name = '$name' LIMIT 1";
$result3 = mysql_query($query3);


while($row3 = mysql_fetch_array($result3)){
$pic = $row3['pic'];


if($pic === ''){

?>

<a href="people_profile.php?user=<?php echo $name; ?>"><img src="User_Images/none.png" id="user" width="50" height="50" alt=""></a>

<?php } else { ?>

<a href="people_profile.php?user=<?php echo $name; ?>"><img src="User_Images/<?php echo $pic; ?>" id="user" width="50" height="50" alt=""></a>

<?php

}

}

?>

<a href="people_profile.php?user=<?php echo $name; ?>"><?php echo $name; ?></a>
<div id="laston">
<?php echo returnDate($last_logged); ?>
</div>
<div id="about_people">
<?php echo $about; ?>
</div>
</li>
</ul>

<?php

}
}



$number = mysql_num_rows(mysql_query("SELECT * FROM users WHERE class = 'kid'"));

if($number > $per_page){


echo '<hr style="border: 1px solid #DDDDDD; width: 100%; float: left;" /> <br /><span class="pag"></span>';


$prev = $start - $per_page;
$next = $start + $per_page;


if(!($start<=0)){
echo '<a href="people.php?start='.$prev.'">Prev</a>&ensp;';
}


$i = 1;

for($x=0; $x<$record_count; $x = $x + $per_page){

if($start != $x){

echo' <a href="people.php?start='.$x.'">'.$i.'</a> ';

} else {
echo' <a href="people.php?start='.$x.'" style="font-size: 20px;"><b>'.$i.'</b></a> ';
}

$i++;


}


if(!($start>=$record_count-$per_page)){
echo '&ensp;<a href="people.php?start='.$next.'">Next</a>';
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