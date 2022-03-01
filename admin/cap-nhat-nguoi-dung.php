
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/main.css">

</head>
<body>
<?php
include '../config.php';
include '../function.php';
$config_name = "product";
$config_title = "sản phẩm";
session_start();
if (!empty($_SESSION['current_user'])) {
	?>
	<div class="main-content">
		<!-- <h1><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy thành viên" : "Sửa thành viên") : "Thêm thành viên" ?></h1> -->
		<div id="content-box">
			<?php
			if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
				if (isset($_POST['username']) && !empty($_POST['username']) 
					&& isset($_POST['password']) && !empty($_POST['password'])
					&& isset($_POST['re_password']) && !empty($_POST['re_password'])) {
					if (empty($_POST['username'])) {
						$error = "Bạn phải nhập tên đăng nhập";
					} elseif (empty($_POST['password'])) {
						$error = "Bạn phải nhập mật khẩu";
					} elseif (empty($_POST['re_password'])) {
						$error = "Bạn phải nhập xác nhận mật khẩu";
					} elseif ($_POST['password'] != $_POST['re_password']) {
						$error = "Mật khẩu xác nhận không khớp";
					}
					if (!isset($error)) {
						// $checkExistUser = mysqli_query($conn, "SELECT * FROM `user` WHERE `username` = '".$_POST['username']."' ");
      //               	if($checkExistUser->num_rows != 0){ //tồn tại user rồi
      //               		$error = "Username đã tồn tại. Bạn vui lòng chọn username khác";
      //               	}else{
                    		if ($_GET['action'] == 'edit' && !empty($_GET['id'])) { //Cập nhật lại thành viên
	                        	$result = mysqli_query($conn, "UPDATE `user` SET `username` = '".$_POST['username']."', `password` = MD5('".$_POST['password']."'),`email` = '".$_POST['email']."',`diachi` = '".$_POST['address']."',`sodienthoai` = '".$_POST['phone']."',`level` = '".$_POST['level']."' WHERE `user`.`id` = ".$_GET['id'].";");
                                
	                        } else { //Thêm thành viên
                        	$result = mysqli_query($conn, "INSERT INTO `user` (`id`, `username`,`password`, `email`,`sodienthoai`,`diachi`,`level`) VALUES (NULL, '".$_POST['username']."', MD5('".$_POST['password']."'),'".$_POST['email']."','".$_POST['phone']."','".$_POST['address']."','".$_POST['level']."')");
    //                             printf("Error: %s\n", mysqli_error($conn));
    // exit();
	                        }
                            
                    	
                        
                        if (isset($result) && empty($result)) { //Nếu có lỗi xảy ra
                        	$error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        } else { //Nếu thành công
                        	if (!empty($galleryImages)) {
                        		$user_id = ($_GET['action'] == 'edit' && !empty($_GET['id'])) ? $_GET['id'] : $con->insert_id;
                        		$insertValues = "";
                        		foreach ($galleryImages as $path) {
                        			if (empty($insertValues)) {
                        				$insertValues = "(NULL, " . $user_id . ", '" . $path . "', " . time() . ", " . time() . ")";
                        			} else {
                        				$insertValues .= ",(NULL, " . $user_id . ", '" . $path . "', " . time() . ", " . time() . ")";
                        			}
                        		}
                        		$result = mysqli_query($con, "INSERT INTO `image_library` (`id`, `product_id`, `path`, `created_time`, `last_updated`) VALUES " . $insertValues . ";");
                        	}
                        }
                    }
                } else {
                	$error = "Bạn chưa nhập thông tin thành viên.";
                }
                ?>
                <div class = "container">

                	 echo "<script>alert('Cập nhật thành công!');
                location.href='./view-customers.php'</script>";
                </div>
                <?php
            } else {
            	if (!empty($_GET['id'])) {
            		$result = mysqli_query($conn, "SELECT * FROM `user` WHERE `id` = " . $_GET['id']);
            		$user = $result->fetch_assoc();
            	}
            	?>


 <div class="wrapper">
        <div class="container">
            <div class="dashboard">
                <div class="left">
                    <span class="left__icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <div class="left__content">
                     
                        <div class="left__profile">
                           <div class="left__image"><img src="assets/pet-house-with-a-dog.png" alt=""></div>
                            <p class="left__name">Pet Shop</p>
                        </div>
                        <ul class="left__menu">
                            <li class="left__menuItem">
                                <a href="xem-san-pham.php" class="left__title"><img src="assets/icon-dashboard.svg" alt="">Dashboard</a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-tag.svg" alt="">Sản Phẩm<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="cap-nhat-san-pham.php">Thêm Sản Phẩm</a>
                                    <a class="left__link" href="xem-san-pham.php">Xem Sản Phẩm</a>
                                </div>
                            </li>
                           <!--  <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-edit.svg" alt="">Danh Mục SP<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_p_category.html">Chèn Danh Mục</a>
                                    <a class="left__link" href="view_p_category.html">Xem Danh Mục</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-book.svg" alt="">Thể Loại<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_category.html">Chèn Thể Loại</a>
                                    <a class="left__link" href="view_category.html">Xem Thể Loại</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-settings.svg" alt="">Slide<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_slide.html">Chèn Slide</a>
                                    <a class="left__link" href="view_slides.html">Xem Slide</a>
                                </div>
                            </li> -->
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-book.svg" alt="">Coupons<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_coupon.html">Chèn Coupon</a>
                                    <a class="left__link" href="view_coupons.html">Xem Coupons</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="view_customers.html" class="left__title"><img src="assets/icon-users.svg" alt="">Khách Hàng</a>
                            </li>
                            <li class="left__menuItem">
                                <a href="./don-hang.php" class="left__title"><img src="assets/icon-book.svg" alt="">Đơn Đặt Hàng</a>
                            </li>
                           <!--  <li class="left__menuItem">
                                <a href="edit_css.html" class="left__title"><img src="assets/icon-pencil.svg" alt="">Chỉnh CSS</a>
                            </li> -->
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-user.svg" alt="">Admin<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_admin.html">Thêm Admin</a>
                                    <a class="left__link" href="view_admins.html">Xem Admins</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="" class="left__title"><img src="assets/icon-logout.svg" alt="">Đăng Xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
                 <div class="right">
            <div class="right__content">
                <div class="right__title">Bảng điều khiển</div>
                <p class="right__desc"><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy người dùng" : "Sửa người dùng") : "Thêm người dùng" ?></p>
                <div class="right__formWrapper">
                            
               <form id="editing-form" method="POST" action="<?= (!empty($user) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"  enctype="multipart/form-data">
                    
                   <!--  <div class="clear-both"></div> -->
                    <div class="right__inputWrapper">
                        <label>Tên Đăng Nhập</label>
                        <input type="text" name="username" value="<?= (!empty($user) ? $user['username'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="right__inputWrapper">
                        <label>Mật khẩu: </label>
                        <input type="password" name="password" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="right__inputWrapper">
                        <label>Xác nhận mật khẩu: </label>
                        <input type="password" name="re_password" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="right__inputWrapper">
                        <label>Email: </label>
                        <input type="text" name="email" value="<?= !empty($user) ? $user['email'] : "" ?>" />
                        <div class="clear-both"></div>
                    </div>
                     <div class="right__inputWrapper">
                        <label>Số điện thoại: </label>
                        <input type="text" name="phone" value="<?= !empty($user) ? $user['sodienthoai'] : "" ?>" />
                        <div class="clear-both"></div>
                    </div>
                     <div class="right__inputWrapper">
                        <label>Địa chỉ: </label>
                        <input type="text" name="address" value="<?= !empty($user) ? $user['diachi'] : "" ?>" />
                        <div class="clear-both"></div>
                    </div>
                     <div class="right__inputWrapper">
                        <label>Quyền(1:Admin|0:User): </label>
                        <input type="text" name="level" value="<?= !empty($user) ? $user['level'] : "" ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <input style="background: orange ;width: auto;" type="submit" title="Lưu thành viên" value="Cập nhật" />
                </form>
                 </div>
        </div>
    </div>



            	
            	<div class="clear-both"></div>
            	<script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                </script>
            <?php } ?>
        </div>
    </div>

    <?php
}

?>