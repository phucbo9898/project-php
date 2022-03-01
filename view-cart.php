<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
	<style type="text/css">
		button {
 	margin-top: 20px;
	  outline: 0;
	  padding: 5px;
	  color: white;
 	border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    border-width: 2px;
    border-style: solid;
    border-color: rgb(250, 194, 0);
 
  text-align: center;
  cursor: pointer;
  width: 200px;
  font-size: 18px;
   background: orange;
}

a{
	text-decoration: none;
	font-size: 15px;
	color: white;
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

	</style>
<body>

</body>
</html>
<center>
	<table id="customers">
<?php
session_start();
$conn=mysqli_connect("localhost","root","","petshop");
mysqli_query($conn,'SET NAMES "utf8"'); // hiển thị tiếng việt trên form 		//khởi động phiên làm việc
$products=!empty($_SESSION['cart'])?$_SESSION['cart']:[];


echo "<tr>
       <th>Giống</th><th>Giá</th><th>Số lượng</th>
       </tr>";
foreach ($products as $item): ?> 
<tr>

	<td><?php echo $item['kind']; ?> </td>
	<td><?php echo $item['price']; ?> </td>
	
	<td><?php echo $item['quantily']; ?> </td>
	</tr>
<?php endforeach; ?>
</table>
<button><a href="hoadon.php">Xem Hóa đơn</a></button>
</center>