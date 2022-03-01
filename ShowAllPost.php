<!DOCTYPE html>
<html>
<head>
	<title>Hiển Thị Đồng Hồ</title>
	<style type="text/css">
		body{
			background-image: url("image/bg4.jpg");
		}
		#customers {
	  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	  border-collapse: collapse;
	  width: 1000px;

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
	  background-color: #20d69f;
	  color: white;
	}
	#table-title{
		width: 1000px;
		height: 40px;
		line-height: 40px;
		background-color:orange ;
	}

	#table-title h3{
		padding-left: 10px;
		text-align: center;

	}
	#table-title #title{

	}

	/*insert post*/
	* {box-sizing: border-box;}
.open-buttonIns {
  background-color: #555;
  color: white;
  border: none;
  cursor: pointer;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 80px;
}

/* The popup form - hidden by default */
.form-popupIns {
  display: none;	
  position: fixed;
  bottom: 0;
  /*right: 570px;*/
 top: 30px;
  z-index: 9;

  left: calc(39% - 50px)
}

/* Add styles to the form container */
.form-containerIns {
  max-width: 400px;
  padding: 10px;
  background-color: rgba(22,22,22,0.9);
}

/* Full-width input fields */
.form-containerIns input[type=text], .form-containerIns input[type=password] {
  width: 100%;
  padding: 10px;
  margin: 5px 0 15px 0;
  border: none;
  background: white;
}

/* When the inputs get focus, do something */
.form-containerIns input[type=text]:focus, .form-containerIns input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-containerIns .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
 
}

/* Add a red background color to the cancel button */
.form-containerIns .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-containerIns .btn:hover, .open-button:hover {
  opacity: 1;
}

.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: #f2dede; 
  border-radius: 5px; 
  text-align: left;
}
/*insert post*/

/*update*/
.open-buttonUpdate {
  background-color: #555;
  color: white;
  border: none;
  cursor: pointer;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 80px;
}

/* The popup form - hidden by default */
.form-popupUpdate {
  display: none;	
  position: fixed;
  bottom: 0;
  /*right: 570px;*/
 top: 30px;
  z-index: 9;

  left: calc(39% - 50px)
}

/* Add styles to the form container */
.form-containerUpdate {
  max-width: 400px;
  padding: 10px;
  background-color: rgba(22,22,22,0.9);
}

/* Full-width input fields */
.form-containerUpdate input[type=text], .form-containerUpdate input[type=password] {
  width: 100%;
  padding: 10px;
  margin: 5px 0 15px 0;
  border: none;
  background: white;
}

/* When the inputs get focus, do something */
.form-containerUpdate input[type=text]:focus, .form-containerUpdate input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-containerUpdate .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
 
}

/* Add a red background color to the cancel button */
.form-containerUpdate .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-containerUpdate .btn:hover, .open-button:hover {
  opacity: 1;
}

.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: #f2dede; 
  border-radius: 5px; 
  text-align: left;
}
/*update*/
	
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

$sql = "select * from post";
$array_post = mysqli_query($connect,$sql);
?>
<center>
	
	<div id="table-title">
		
		<div id="title"><h3>Quản lý bài đăng</h3>
	</div>
		
		
	</div>
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
				<!-- <a href="InsertPost.php" ><button style="background-color: lightgreen; border-style: inherit;"> Thêm </button></a> -->
				<!-- thêm -->
				<a onclick="openFormIns()"><button style="background-color: lightgreen; border-style: inherit;">Thêm</button></a>

				<div class="form-popupIns" id="myInsertForm">
				  <form action="InsertHandle.php" method="POST" class="form-containerIns">
				  
				   <!--  <h1> Thêm bài đăng</h1><br> -->
				   <h2 style="color: orange">Thêm bài đăng</h2>
				    <!-- <label for="email"><b>Email</b></label> -->
				    <input type="text" placeholder="Mã bài viết" name="id" required>
				    <input type="text" placeholder="Tiêu đề" name="title" required>
				    <!-- <label for="email"><b>Email</b></label> -->
				    <input type="text" placeholder="Giá" name="price" required>
				    <input type="text" placeholder="Giống" name="kind" required>
				    <input type="text" placeholder="Tuổi" name="age" required>
				   <!--  <label for="psw"><b>Mật Khẩu</b></label> -->
				   

				    <button type="submit" name="add" onclick="reg()" class="btn">Thêm</button>

				    <button type="button" class="btn cancel" onclick="closeFormIns()">Đóng</button>
				  </form>
				</div>

			

				<script>
				function openFormIns() {
				  document.getElementById("myInsertForm").style.display = "block";
				}

				function closeFormIns() {
				  document.getElementById("myInsertForm").style.display = "none";
				}

				
				</script>			
				</a>
			
				<a href="UpdatePost.php?id=<?php echo $post['id'] ?>">
					<button style="background-color: yellow; border-style: inherit;"> Sửa </button>
				</a>

				<a href="delete.php?id=<?php echo $post['id'] ?>">
					<button style="background-color: red; border-style: inherit;"> Xóa </button>
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