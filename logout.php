<?php

if(isset($_COOKIE['user'])){

setcookie("user","$_POST[name]",time() - (3600* 7));
header('Location: login.php');

} else {
header('Location: login.php');
}



if(isset($_COOKIE['parent'])){

setcookie("parent","$_POST[name]",time() - (3600* 7));
header('Location: login.php');

} else {
header('Location: login.php');
}



?>