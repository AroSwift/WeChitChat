<?php

$key = 'we chit chat, chit chat, safe chatting, kids chat room, kids chat, teens chat, free chatting for kids, free chatting, get password, retreve password';
$des = 'Forgot your password?  No problem, if you provided us with your email we can send it to you.';

$title = 'Retreve Lost Account';

include('Includes/header.php');

$errors = '';



if(isset($_GET['get'])){
if($_GET['get'] == 'true'){



if(empty($_POST['rname'])){
$errors .= "The name is empty<br />";
}


if(empty($_POST['remail'])){
$errors .= "The email is empty<br />";
}


if(isset($_POST['remail'])){
if(!(empty($_POST['remail']))){
if(!filter_var($_POST['remail'], FILTER_VALIDATE_EMAIL)){
$errors .=  "The E-mail is not valid<br />";
}
}
}



if(isset($_POST['rname']) && isset($_POST['remail']) && empty($errors)){


$query = "SELECT * FROM users WHERE name = '$_POST[rname]'";

$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$name = $row['name'];
$password = $row['password'];
$email = $row['email'];


if(empty($email)){
$errors .= "You didn'\t supply us with your email<br />";
} else {


$query2 = "SELECT * FROM users WHERE name = '$_POST[rname]'";

$result2 = mysql_query($query2);

while($row2 = mysql_fetch_array($result2)){
$name2 = $row2['name'];
$password2 = $row2['password'];
$email2 = $row2['email'];


if($email2 != $_POST['remail']){
$errors .= 'That is a incorrect email address for the name you have provided<br />';
}


}



}


// Get the password and email

if(empty($errors)){


$to  = $_POST['remail'];
$subject = 'Your Password for wechitchat.com';

$message = 'Your password is: '.$password2.'';


mail($to, $subject, $message, $headers);





// TEST


$to  = 'aaron-inc@charter.net'; // note the comma


// subject
$subject = 'Birthday Reminders for August';

// message
$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Aaron <aaron-inc@charter.net>' . "\r\n";
$headers .= 'From: Birthday Reminder <birthday@wechitchat.com>' . "\r\n";
$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);






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


<div id="Content1">
<h2>Retreve Lost Account</h2>


<?php

if(isset($errors)){

?>

<div id="errors">
<?php echo $errors; ?>
</div>

<?php


}


?>


<form action="get_pass.php?get=true" method="post">
<p>
<label>Name</label><br /> <input type="text" name="rname" size="45" value="
<?php

if(isset($_POST['rname'])){
echo $_POST['rname'];
}


?>
" maxlength="100" />
<br />
<br />
<label>Email</label><br /> <input type="text" size="45" value="
<?php

if(isset($_POST['remail'])){
echo $_POST['remail'];
}


?>
" name="remail" maxlength="100" />
<br />
<input type="submit" value="Retreve" id="bsp" />
</p>
</form>

</div>

<?php


include('Includes/footer.php');

?>