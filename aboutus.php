<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, about us, Aaron';
// Put part of the aboutus page below
$des = 'WeChitChat is a secure and safe place for young kids and teens to chat.';


$title = 'About Us';

include('Includes/header.php');

?>


<ul id="jsddm">
<li><a href="support.php" class="norm" title="Report an Error">Support</a></li>
<li><a href="signup.php" class="norm" title="Sign Up!">Sign Up</a></li>
<li><a href="login.php" class="norm" title="Log In">Log In</a></li>
<li id="on"><a href="aboutus.php" class="norm" title="About us">About Us</a></li>

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




<div id="Content1">
<h2>About Us</h2>
Wechitchat.com is safe place for kids to chat and make new friends and is completly free.
We make sure your child is safe by blocking bad words, monatering and parental controls.
Wechitchat.com is happly brought to you by Aaron Barlow.
</div>


<?php

include('Includes/footer.php');

?>