<?php
	session_start();
	session_destroy();
	unset($_SESSION['current_user']);
	echo "<script>alert('Đăng xuất thành công!');
				location.href='index.php'</script>";
 ?>