<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
<style type="text/css">
		form
		{
		  position: static;
		  z-index: 1;
		  background: yellow;
		  max-width: 500px;
		  margin: 70px auto 100px;
		  padding: 60px;
		  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
		}

	</style> 
</head>
<body>
	<form method= "post" action="" >
	<center>
	<h2>Thêm Bài Viết</h2>
	<table  cellpadding="2" bgcolor="yellow">

		<tr> 
			<td> Mã bài viết </td>
			<td> <input type = "text" name ="id"> </td>
		</tr>

		<tr>
			<td> Tiêu đề </td>
			<td> <input type = "text" name = "title"> </td>
		</tr>

		<tr>
			<td> Giá </td>
			<td> <input type =" text" name = "price"> </td>
		</tr>

		<tr>
			<td> Giống </td>
			<td> <input type= "text" name = "kind">  </td>
		</tr>

		<tr> 
			<td> Tuổi </td>
			<td> <input type="text" name = "age">  </td>
		</tr> 
</table>
		<br>
		<td><input type = "submit" name = "Thêm" value="Thêm" > </td>
		</center>
		<!-- <b><button> Thêm </button> </b> </center> -->
<?php
	if(isset($_POST["Thêm"]))
	{
		$connect = mysqli_connect('localhost','root','','petshop');
		mysqli_set_charset($connect,'utf8');
		$ma	 = $_POST['id'];
		$tieude = $_POST['title'];
		$gia	 = $_POST ['price'];
		$giong 	 = $_POST ['kind'];
		$tuoi = $_POST ['age'];
		$add 	 = "insert into post(id,title,price,kind,age) value('$ma','$tieude','$gia','$giong','$tuoi')";
		if(mysqli_query($connect,$add))
		{
			//echo "Đã Thêm!";
			 header('location:ShowAllPost.php');
		}
		else
		{
			echo "<center>";
			echo "<br>";
			echo "Mã Bị Trùng!";
			echo "</center>";
		}
	}
?>


</body>
</html>
