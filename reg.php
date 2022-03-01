<?php
	include 'config.php';
	session_start();
	$errors = array(); 
	if (isset($_POST['submit']) && $_POST["username"] != '' && $_POST["psw"] != ''  && $_POST["psw2"] != '' && $_POST["email"] != '') {
		
		$username = $_POST["username"];
		$email = $_POST["email"];
		$password = $_POST["psw"];
		$password2 = $_POST["psw2"];
		$level = 0;

		if ($password != $password2) {
			array_push($errors, "Mật khẩu không khớp nhau!");
		 }

		$user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query($conn, $user_check_query);
	 	$user = mysqli_fetch_assoc($result);
	  
	  	if ($user) { // if user exists
		    if ($user['username'] === $username) {
		      array_push($errors, "Tên tài khoản đã tồn tại!");
		    }

		    if ($user['email'] === $email) {
		      array_push($errors, "Email đã tồn tại!");
		    }
	  	}

	  	if (count($errors) == 0) {
		  	$password = md5($password);//encrypt the password before saving in the database

		  	$query = "insert into user(username,password,email,level) 
		  	values('$username','$password','$email','$level')";

		  	mysqli_query($conn, $query);
		  	$_SESSION['username'] = $username;
		  	echo "<script>alert('Đăng ký thành công!');
				location.href='./Sign-In-Sign-Up-Form/index.html'</script>";
	  		// header('location: index2.php');
	  }
	  else echo "<script>alert('Đăng ký thất bại!');
				location.href='./Sign-In-Sign-Up-Form/index.html'</script>";
	}
?>