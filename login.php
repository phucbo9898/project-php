<?php
	session_start();
	include('config.php');
	if (isset($_POST['submit']) && $_POST["username"] != '' && $_POST["psw"] != '') {
	 	$username = $_POST["username"];
		$password = $_POST["psw"];
		$password = md5($password);

		$sql = mysqli_query($conn,"SELECT * FROM user WHERE username='$username' AND password = '$password'");
		
		if (mysqli_num_rows($sql) > 0) {
			$row = mysqli_fetch_array($sql);
			$_SESSION['current_user'] = $row['username'];
			$_SESSION['current_userinfo'] = $row;

			// $_SESSION['current_userID'] = $row['id'];
			if ($row['level'] == 1) {
				$_SESSION['current_admin'] = $row['level'];
				echo "<script>alert('Đăng nhập thành công!');
				location.href='./admin/xem-san-pham.php'</script>";
			}
			else{
				echo "<script>alert('Đăng nhập thành công!');
				location.href='index.php'</script>";
			}
		}else
		{
			 echo "<script>alert('Đăng nhập thất bại!');location.href='./Sign-In-Sign-Up-Form/index.html'</script>";
		}

				
		

	} else echo "<script>alert('Đăng nhập thất bại!');
				</script>";
 ?>
