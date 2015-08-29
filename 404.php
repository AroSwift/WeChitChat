<?php

$title = '404 Error';

include('Includes/header.php');

?>


<ul id="jsddm">
<li><a href="http://www.wechitchat.com/support.php" class="norm" title="Report an Error">Support</a></li>
<li><a href="http://www.wechitchat.com/signup.php" class="norm" title="Sign Up!">Sign Up</a></li>
<li><a href="http://www.wechitchat.com/login.php" class="norm" title="Log In">Log In</a></li>
<li><a href="http://www.wechitchat.com/aboutus.php" class="norm" title="About us">About Us</a></li>

<?php  

if(isset($_COOKIE['user'])){

?>
<li><a href="#" class="iit">Account</a>
<ul id="drop_men">
<li><a href="http://www.wechitchat.com/index.php">Overview</a></li>
<li><a href="http://www.wechitchat.com/editprofile.php">Edit Profile</a></li>
<li><a href="http://www.wechitchat.com/people.php">People</a></li>
<li><a href="http://www.wechitchat.com/friends.php">Friends</a></li>
<li><a href="http://www.wechitchat.com/logout.php" class="bott">Logout</a></li>
</ul>
<?php

} elseif(isset($_COOKIE['parent'])){

?>
<li><a href="#" class="iit">Account</a>
<ul id="drop_men">
<li><a href="http://www.wechitchat.com/index.php">Parental Controls</a></li>
<li><a href="http://www.wechitchat.com/logout.php" class="bott">Logout</a></li>
</ul>
<?php

} else {

?>
<li><a href="http://www.wechitchat.com/index.php" class="norm" title="Home Page">Home</a>
<?php

}

?>
</li>
</ul>


</div>




<div id="Content1">
<h2>404 Error</h2>
The page couldn't be found.  If you clicked on a link that should have taken you to a valid page please go to <a href="http://www.wechitchat.com/support.php" class="norm" title="Support">Support</a> to tell us at ounce!
</div>


<?php

include('Includes/footer.php');

?>