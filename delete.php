<?php 
$id= $_GET['id'];

$servername = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'petshop';
$connect    = mysqli_connect($servername,$username,$password,$database);
mysqli_set_charset($connect,'utf8');

$sql = "delete from post
where id = '$id'";

mysqli_query($connect,$sql);
$error = mysqli_error($connect);

if(empty($error)){
	
	header('location:ShowAllPost.php');
}
else{
	echo "$error";
}

mysqli_close($connect);