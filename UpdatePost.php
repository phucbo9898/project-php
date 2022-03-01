<!DOCTYPE html>
<html>
<head>
	<title>Sửa Bài Viết </title>
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
<?php 

$id = $_GET['id'];
$servername = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'petshop';
$connect    = mysqli_connect($servername,$username,$password,$database);
mysqli_set_charset($connect,'utf8');

$sql = "select * from post
where id = '$id'";

$array_dongho = mysqli_query($connect,$sql);
$post = mysqli_fetch_array($array_dongho);
?>
<form action="UpdateHandle.php" method="POST">
	<fieldset>
	<table align="center">
	<tr>
	<b><i> Sửa Bài Viết </i></b> </tr>
	<input type="hidden" name="id" value="<?php echo $post['id'] ?>">
	<tr> <td> Tiêu đề </td>
	<td> <input type="text" name="title" value="<?php echo $post['title'] ?>"> </td>
	</tr>
	<br>
	<tr>
	<td> Giá </td> 
	<td> <input type="text" name="price" value="<?php echo $post['price'] ?>"> </td>
	</tr>
	<br>
	<tr>
	<td> Giống </td> 
	<td> <input type="text" name="kind" value="<?php echo $post['kind'] ?>"> </td>
	</tr>
	<br>
	<tr>
	<td> Tuổi </td>
	<td> <input type="text" name="age" value="<?php echo $post['age'] ?>"> </td>
	</tr>
	<br>
	<tr>
	
	</tr>
	</table>
	<br>
	<center> <b><button>Sửa</button></b> </center>
	</fieldset>

</form>
</body>
</html>
