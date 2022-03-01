<?php 
$servername = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'petshop';
$connect    = mysqli_connect($servername,$username,$password,$database);
mysqli_set_charset($connect,'utf8');
$ma	 = $_POST['id'];
$tieude = $_POST['title'];
$gia	 = $_POST ['price'];
$giong 	 = $_POST ['kind'];
$tuoi = $_POST ['age'];
$sql = "update post
set 
title 	= '$tieude',
price	= '$gia',
kind	= '$giong',
age     = '$tuoi'
where id = '$ma'";
mysqli_query($connect,$sql);
$error = mysqli_error($connect);
if(empty($error)){
	
	 header('location:ShowAllPost.php');
}
else{
	echo "$error";
}

mysqli_close($connect);