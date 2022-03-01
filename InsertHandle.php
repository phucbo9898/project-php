<?php
	if(isset($_POST["add"]))
	{
		$connect = mysqli_connect('localhost','root','','petshop');
		mysqli_set_charset($connect,'utf8');
		$ma	 = $_POST['id'];
		$tieude = $_POST['title'];
		$gia	 = $_POST ['price'];
		$giong 	 = $_POST ['kind'];
		$tuoi = $_POST ['age'];
		$add 	 = "insert into post value('$ma','$tieude','$gia','$giong','$tuoi')";
		if(mysqli_query($connect,$add))
		{
			echo "<script>alert('Thêm thành công');location.href='ShowAllPost.php'</script>";
		}
		else
		{
			echo "<script>alert('Thêm thành công!');location.href='ShowAllPost.php'</script>";
		}
	}
?>