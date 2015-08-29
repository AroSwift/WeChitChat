
<?php 

require_once("Includes/connection.php");



$per_page = 5;


if(isset($_GET['start'])){
$start = $_GET['start'];
} else {
$start = 0;
}

$record_count = mysql_num_rows(mysql_query("SELECT * FROM cc WHERE c_from = '$_COOKIE[user]' OR c_from = '$_GET[user]'"));

$max_pages = $record_count / $per_page;

if(!$start){

$start = 0;

}



if(isset($_GET['user'])){
$user = $_GET['user'];
}


$get = mysql_query("SELECT * FROM cc WHERE c_from = '$_COOKIE[user]' OR c_from = '$_GET[user]' ORDER BY id DESC LIMIT $start, $per_page");
while($row = mysql_fetch_assoc($get)){

$under = $row['under'];
$by = $row['c_to'];
$from = $row['c_from'];
$message = $row['message'];
$date = $row['date'];




if($under === $_COOKIE['user'].'_'.$user){
$from = '';
} else {
$from = '<b>'.$from.':</b> ';
}


if($under === $_COOKIE['user'].'_'.$user || $under === $user.'_'.$_COOKIE['user']){

echo $from.''.$message.'<br />';

}

}


$number = mysql_num_rows(mysql_query("SELECT * FROM cc"));

if($number > $per_page){



echo '<hr style="width: 300px; float: left;" /> <br />';

$prev = $start - $per_page;
$next = $start + $per_page;



if(!($start<=0)){
echo '<a href="chitchat.php?start='.$prev.'&user='.$user.'">Prev</a>&ensp;';
}



$i = 1;

for($x=0; $x<$record_count; $x = $x + $per_page){

if($start != $x){

echo' <a href="chitchat.php?start='.$x.'&user='.$user.'">'.$i.'</a> ';

} else {
echo' <a href="chitchat.php?start='.$x.'&user='.$user.'" style="font-size: 20px;"><b>'.$i.'</b></a> ';
}

$i++;


}


if(!($start>=$record_count-$per_page)){
echo '&ensp;<a href="chitchat.php?start='.$next.'&user='.$user.'">Next</a>';
}




}


?>