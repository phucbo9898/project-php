<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#customers {
	  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	  border-collapse: collapse;
	  width: 80%;
	}

	#customers td, #customers th {
	  border: 1px solid #ddd;
	  padding: 8px;
	  
	}

	#customers tr:nth-child(even){background-color: #f2f2f2;}

	#customers tr:hover {background-color: #ddd;}

	#customers th {
	  padding-top: 12px;
	  padding-bottom: 12px;
	  text-align: center;
	  background-color: #4CAF50;
	  color: white;
	}

	</style> 
</head>
<body>
<?php
$servername = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'petshop';
$connect    = mysqli_connect($servername,$username,$password,$database);
mysqli_set_charset($connect,'utf8');

$kind = $_POST['kind'];

$sql = "select * from post where kind like '%$kind%'";
$array_post = mysqli_query($connect,$sql);
?>
<center>
	<h2>Danh sách bài đăng tìm kiếm</h2>
<table id="customers">
	<tr> 
		<th>
			STT
		</th>
		<th>
			Mã Bài Viết
		</th>
		<th>
			Tiêu đề 
		</th>
		<th>
			Giá 
		</th>
		<th>
			Giống
		</th>
		<th>
			Tuổi
		</th>
		<th>
			Chỉnh sửa
		</th>
		
	</tr>
	<?php $i=0;
	foreach($array_post as $post){ ?>
		<tr align="center">
			<td>
				<?php echo ++$i ?>
			</td>
			<td>
				<?php echo $post['id'] ?>
			</td>
			<td>
				<?php echo $post['title'] ?>
			</td>
			<td>
				<?php echo $post['price'] ?>

			</td>
			<td>
				<?php echo $post['kind'] ?>
			</td>
			<td>
				<?php echo $post['age'] ?>
			</td>
			
			<td>
				<a href="InsertPost.php"><button> Thêm </button></a>

				<a href="UpdatePost.php?id=<?php echo $post['id'] ?>">
					<button> Sửa </button>
				</a>
			
			
				<a href="delete.php?id=<?php echo $post['id'] ?>">
					<button> Xóa </button>
				</a>
			</td>
		</tr>
	<?php } ?>
</table>
</center> 
<br>
<center>
<b> <big>
</center>
</body>
</html>