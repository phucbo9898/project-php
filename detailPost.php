
	
<!DOCTYPE html>
<html>
<?php include('errors.php');
$id= $_GET['id'];
$config_name = "product";
$config_title = "sản phẩm";
if(!empty($kind)){
    $totalRecords = mysqli_query($conn, "select * from post where kind like '%$kind%'");
}else{
    $totalRecords = mysqli_query($conn, "SELECT * FROM `post`");
}
$totalRecords = $totalRecords->num_rows;
//$totalPages = ceil($totalRecords / $item_per_page);
?>
<head>
	<title>Pet Shop</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	 <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
	<div style="background-image:url(image/HomeBanner-smaller_1800x.gif);
	height:250px;
	width: 1000px;
	overflow: auto;
	background-size:cover;
	background-position:center center;
	margin-bottom: 5px;
	margin-top: 5px;
	"></div>

	<div id="menu">
		<ul>
			<li>
				<a href="index.php"><img src="image/pet-house.png" width="15px"> Trang Chủ</a>
			</li>

            <li>
                <a href="menucon.php">Chó</a>
                <ul class="sub-menu">
                    <a href="menucon.php">Chó Pug</a>
                    <a href="menucon2.php">Chó Puddle</a>
                    <a href="menucon3.php">Chó Husky</a>
                    <a href="menucon4.php">Chó Chihuahua</a>
                    <a href="menucon5.php">Chó Corgi</a>
                    <a href="menucon6.php">Chó Beagle</a>
                </ul>
            </li>

            <li>
                <a href="#">Mèo</a>
                <ul class="sub-menu">
                    <a href="menuconmeo.php">Mèo Scottish</a>
                    <a href="menuconmeo2.php">Shynx</a>
                    <a href="menuconmeo3.php">Mèo Anh</a>
                    <a href="menuconmeo4.php">Mèo Ba Tư</a>
                    <a href="menuconmeo5.php">Mèo Munchkin</a>
                    <a href="menuconmeo6.php">Thôi Míu</a>
                </ul>
            </li>


            <li>
                <a href="#">Hamster</a>
                <ul class="sub-menu">
                    <a href="menuconhamster.php">Hamster ww</a>
                    <a href="menuconhamster2.php">Hamster bear</a>
                    <a href="menuconhamster3.php">Hamster robo</a>
                </ul>
            </li>

            <li>
                <a href="#">Các loại khác</a>
                <ul class="sub-menu">
                    <a href="menuconother.php">Thỏ cảnh</a>
                    <a href="menuconother2.php">Nhím cảnh</a>
                    <a href="menuconother3.php">Sóc bay Úc</a>
                </ul>
            </li>
            <li>
                <a href="#">Tặng</a>
                <ul class="sub-menu">
                    <a href="https://www.facebook.com/groups/275533527544721" target="_blank">Tặng Thú Cưng</a>
                </ul>
            </li>

            <li>
                <a href="#">Tìm</a>
                <ul class="sub-menu">
                    <a href="https://www.facebook.com/groups/239307076889720" target="_blank">Tìm Kiếm Pet Thất Lạc</a>
                </ul>
            </li>
            <li>
                <a href="#">Phối Giống</a>
                <ul class="sub-menu">
                    <a href="https://www.facebook.com/groups/2548758838734750" target="_blank">Phối giống chó mèo</a>
                </ul>
            </li>
			<li style="width: auto">
				<!-- dang nhap -->
				
				
					<?php 
						if (!empty($_SESSION['current_user'])) {
							echo '<a ><img src="image/petFood.png" width="15">';
							echo " " .$_SESSION['current_user'];
							echo '<ul class="sub-menu">';
								if (!empty($_SESSION['current_admin']) && $_SESSION['current_admin'] == 1) {
								echo '<a href="./admin/xem-san-pham.php">Quản trị</a>';
							}
							?>
							
								 <a onclick="openForm()">Thông tin</a>

								 <div class="form-popup" id="myForm">
							  <form action="login.php" method="POST" class="form-container">

							    <h2 style="text-align: center;">Thông tin cá nhân</h2>
							    <!-- <label for="email"><b>Email</b></label> -->
							    <label><b>Họ tên</b></label>
							    <input id="name" type="text" placeholder="Nhập vào Username" name="username" required>
								<label><b>Mật khẩu</b></label>
							   <!--  <label for="psw"><b>Mật Khẩu</b></label> -->
							    <input type="password" placeholder="Nhập vào Password" name="psw" required>
							    	<label><b>Email</b></label>
							    <input type="text" placeholder="Email" name="email" value='<?=$_SESSION['current_userinfo']['email']?>' required>
							    <label><b>Địa chỉ</b></label>
							    <input type="text" placeholder="Địa chỉ" name="address" value='<?=$_SESSION['current_userinfo']['diachi']?>'required>
							    <label><b>SĐT</b></label>
							    <input type="text" placeholder="Số điện thoại" name="slideshow-container" value='<?=$_SESSION['current_userinfo']['sodienthoai']?>' required>

							    <!-- <button type="submit" name="submit" class="btn" onclick="login()">Cập nhật</button> -->
							    <button style="margin-left: 130px" type="button" class="btn cancel" onclick="closeForm()">Đóng</button>
							  </form>
							</div>

							<script>
							function openForm() {
							  document.getElementById("myForm").style.display = "block";
							}

							function closeForm() {
							  document.getElementById("myForm").style.display = "none";
							}
							function login() {
								
								// alert("Đăng nhập thành công !");
								
							}
							</script>
				<!-- dangnhap -->

							     <a href="logout.php">Đăng xuất</a>   
							</ul>
					<?php
						}else{
							echo '<a href="./Sign-In-Sign-Up-Form/index.html"><img src="image/petFood.png" width="15">'; 
						 echo " Đăng nhập";
						}
						
					?>
					
				</a>


			</li>
			
			<li>
				<a style="z-index: -1;" href="addCart.php?id=<?php echo $_SESSION['current_user'] ?>">  Giỏ hàng </a>
			</li>
		</ul>
	</div>






	<div id="detail-search">
		<form action="searchPost.php" method="POST">
			<center><h3 style="color: #FFFFFF ; padding-top: 15px;">Điền thông tin bạn cần tìm kiếm</h3></center>
			<br>
			<div id="info-search">
				<div id="info-search1">				
						<input style="padding-top: 10px;padding-bottom: 10px;width: 300px" type="text" name="kind" placeholder="Giống pet cần tìm kiếm...">					
				</div>
				<div id="info-search2">				
						<input style="padding-top: 10px;padding-bottom: 10px;width: 150px" type="text" name="job" placeholder="Giống loài ...">										
				</div>
				<div id="info-search3">				
						<input style="padding-top: 10px;padding-bottom: 10px;width: 150px" type="text" name="job" placeholder="Tất cả địa điểm">										
				</div>

				<div id="btnSearch">
					<button type="submit" name="search">Tìm kiếm</button>
				</div>
			</div>
		</form>
	</div>

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
					$sqlimage = "select * from image_library where post_id = '$id'";
					$array_dongho = mysqli_query($connect,$sql);
					$post = mysqli_fetch_array($array_dongho);

					$array_image = mysqli_query($connect,$sqlimage);
				// 	if (!$array_image) {
    // printf("Error: %s\n", mysqli_error($connect));
    // exit();
// }
					?>
	<div id="chitietpost">
		<div id="left">
			<br>
			<br>
			<div id="title"><h2><?php echo $post['title'] ?></h2></div>
			<br>
			<div id="time-upload"><p>9 giờ trước</p></div>
			
			
				
			<div id="listImage">
				
					
						<div id="content-wrapper">
							<div class="column">
								<img id=featured src="<?php echo $post['image'] ?>">

								<div id="slide-wrapper" >
									<!-- <img id="slideLeft" class="arrow" src="image/arrow-left.png"> -->

									<div id="slider">

										<img class="thumbnail active" src=<?php echo $post['image'] ?>>
										<?php
											while($image = mysqli_fetch_array($array_image)){?>
												<img class="thumbnail active" src=<?php echo $image['path'] ?>>
											<?php } ?>
										 
										
										<!-- <img class="thumbnail" src="image/pd3.jpg"> -->
										<!-- <img class="thumbnail" src="image/pd4.jpg">
										<img class="thumbnail" src="image/pd4.jpg"> -->
										
									</div>

									<!-- <img id="slideRight" class="arrow" src="image/arrow-right.png"> -->
								</div>
							</div>

						</div>

	<script type="text/javascript">
		let thumbnails = document.getElementsByClassName('thumbnail')

		let activeImages = document.getElementsByClassName('active')

		for (var i=0; i < thumbnails.length; i++){

			thumbnails[i].addEventListener('mouseover', function(){
				console.log(activeImages)
				
				if (activeImages.length > 0){
					activeImages[0].classList.remove('active')
				}
				

				this.classList.add('active')
				document.getElementById('featured').src = this.src
			})
		}


		let buttonRight = document.getElementById('slideRight');
		let buttonLeft = document.getElementById('slideLeft');

		buttonLeft.addEventListener('click', function(){
			document.getElementById('slider').scrollLeft -= 180
		})

		buttonRight.addEventListener('click', function(){
			document.getElementById('slider').scrollLeft += 180
		})


	</script>
				<br>
				<div id="info">
				<!-- <p>
					<strong>Giá:</strong>
					<span>4.000.000 đ</span>
				</p> -->


				<div id="giohang">
					<div id="gia">
						<strong><?php echo number_format($post['price'], 0, ",", ".")  ?> đ</strong>
					</div>

                    <?php if ($post['quantity'] >0 ) { ?>
<!--                    <div class="post-quantity">--><?//= $post['quantity'] ?><!--</div>-->
					<form id="add-to-cart-form" action="addCart.php?action=add" method="POST">
						<div id="quantity">
							
	                        <input type="text" value="1" name="quantity[<?=$post['id']?>]" size="2" /><br/>
						</div>
						<div id="card">
<!-- href="addCart.php?id=<?php echo $post['id'] ?> " -->
							<p><button type="submit"><strong><a >Thêm vào giỏ hàng</a> </strong></button></p>
							
						</div>
					</form>
                    <?php } else { ?>
                    <span class="error">Hết hàng</span>
                    <?php } ?>


				</div>	
				<br>
				<p style="padding-left: 50px;">
					<strong>Giống:</strong>
					<span><?php echo $post['kind'] ?></span>
				</p>
				<p style="padding-left: 50px;">
					<strong>Giới tính:</strong>
					<span>Đực</span>
				</p>
				<p style="padding-left: 50px;">
					<strong>Tuổi:</strong>
					<span><?php echo $post['age'] ?></span>
				</p>
				<p style="padding-left: 50px;">
					<strong>Đã tiêm chủng:</strong>
					<span>Có</span>
				</p>
				<p style="padding-left: 50px;">
					<strong>Bảo hành sức khỏe:</strong>
					<span>Có</span>
				</p>
                    <p style="padding-left: 50px;">
                        <strong>Số lượng:</strong>
                        <span><?=$post['quantity']?></span>
                    </p>


				<!-- <p>
					<strong>Địa chỉ:</strong>
					<span><?php echo $post['address'] ?></span>
				</p> -->
			</div>

				<!-- <div id="related-pet">
					<div id="box-top"><h6>Bài Đăng Liên Quan</h6></div>
					<img src="image/baidangtuongtu.png" width="1000px" style="border-width: 1px;
    border-style: solid;
    border-color: rgb(250, 194, 0);">
				</div>
			</div> -->

		</div>
<!--		<div id="ads">-->
<!--			<div id="extention">-->
<!--				<div id="extention-header"><b>Tiện Ích Hộ Trợ</b></div>-->
<!--					<div id="list-extention">-->
<!--					<ul>-->
<!--					<li><a href="#"><b>Cẩm nang chăm sóc thú cưng</b></a></li>-->
<!--						<li><a href="#"><b>Bảng giá và cẩm nang loài mèo</b></a></li>-->
<!--					<li><a href="#"><b>Bảng giá và cẩm nang loài chó</b></a></li>-->
<!--						<li><a href="#"><b>Các bệnh thú cưng thường gặp</b></a></li>-->
<!--				</ul>-->
<!--				</div>-->
<!--			</div>-->

<!--			<div id="ads-fb">-->
<!--				-->
<!--<br>        <img src="image/08634887-5B87-4325-A6DF-6668AA32C130.gif" width="270px" height="300x">-->
<!--			</div>-->
<!--			<div id="ads-fb">-->
<!--				<br>-->
<!--				<img src="image/a6a7ad02-18c2-d079-5712-ebabbd8717fd-1610677037684.gif" width="270px" height="400px" >-->
<!--				<br><br>-->
<!--			</div>-->

		</div>


	</div>
<br>
<br>
		  <div id="footer"><h4>PET SHOP THÚ CƯNG LỚN NHẤT HÀ NỘI/h4></div>
        <div id="footer">Petshop – Thương hiệu kinh doanh thú cưng, phụ kiện uy tín, chuyên nghiệp</div>
             <div id="footer">gười đại diện: Nguyễn Thị Ngọc Hiên</div>
              <div id="footer">Địa chỉ: Phố Hồng Tiến - Long Biên - Hà nội</div>
 <?php
//          include('phonecall.html');
          ?>


</body>
</html>