<!DOCTYPE html>
<html>
<?php
include('errors.php');
?>
<head>
    <title>Pet Shop</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<?php

$trang = 1;
$servername = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'petshop';
$connect    = mysqli_connect($servername,$username,$password,$database);
mysqli_set_charset($connect,'utf8');

if( isset($_GET["trang"]) ){
    $trang = $_GET["trang"];
    settype($trang, "int");
}else{
    $trang = 1;
}
$from = ($trang -1 ) * 6;
if($from<0) $from=0;


if(!empty($_POST['kind'])){

    $kind = $_POST['kind'];
    $array_post = mysqli_query($conn, "select * from post where kind like '%$kind%' LIMIT $from , 6");
    $tongsotin = $array_post->num_rows;
}else{

    $array_post = mysqli_query($conn, "SELECT * FROM `post` ORDER BY kind DESC LIMIT $from , 6");
    $array_post1 = mysqli_query($conn, "SELECT * FROM `post` ORDER BY kind DESC");
    $tongsotin = $array_post1->num_rows;
}

$sp_noibat = mysqli_query($conn, "SELECT * FROM `post` where type = '1' ORDER BY `id` DESC");
// $sql = "select * from post LIMIT $from , 6";
// $array_post = mysqli_query($connect,$sql);
$tongSoTrang = $array_post->num_rows;
$soTrang = ceil($tongSoTrang / 6);

?>
<div style="background-image:url(image/HomeBanner-smaller_1800x.gif);
	height:250px;
	width: 1000px;
	overflow: auto;
	background-size:cover;
	background-position:center center;
	margin-bottom: 5px;
	margin-top: 2px;
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
                <a href="menuconmeo3.php">Mèo Anh Lông Ngắn</a>
                <a href="menuconmeo4.php">Mèo Ba Tư</a>
                <a href="menuconmeo5.php">Mèo Munchkin</a>
                <a href="menuconmeo6.php">Thôi Míu</a>
            </ul>
        </li>


        <li>
            <a href="#">Hamster</a>
            <ul class="sub-menu">
                <?php $array_post = mysqli_query($conn, "SELECT * FROM `post` where type = '8' ORDER BY `id` DESC");
                ?>
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
            <a href="#"target="_blank">Phối Giống</a>
            <ul class="sub-menu">
                <a href="https://www.facebook.com/groups/2548758838734750" target="_blank">Phối giống chó mèo</a>
            </ul>
        </li>
        <li style="width: auto">
            <!-- dang nhap -->


            <?php
            if (!empty($_SESSION['current_user'])) {
            echo '<a ><img src="image/treats.png" width="15">';
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
                    <input id="name" type="text" placeholder="Nhập vào Username" name="username" value='<?=$_SESSION['current_userinfo']['username']?>' required>

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

        <a style="z-index: -1;" href="addCart.php?id=<?php echo $_SESSION['current_user'] ?>"><img src="image/paw.png" width="15px">  Giỏ hàng </a>
    </li>
    </ul>
</div>



<div id="detail-search">
    <form action="index.php" method="POST">
        <center><h3 style="color: #FFFFFF ; padding-top: 15px;">Để lại đây những thông tin bạn muốn tìm</h3></center>
        <br>
        <div id="info-search">
            <div id="info-search1">
                <input style="padding-top: 10px;padding-bottom: 10px;width: 300px" type="text" name="kind" placeholder="Giống pet bạn cần...">
            </div>
            <div id="info-search2">
                <input style="padding-top: 10px;padding-bottom: 10px;width: 150px" type="text"  placeholder="Giống loài...">
            </div>
            <div id="info-search3">
                <input style="padding-top: 10px;padding-bottom: 10px;width: 150px" type="text"  placeholder="Chi nhánh...">
            </div>


            <div id="btnSearch">
                <button type="submit" name="search">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>
<!--<div style="background-image:url(image/08634887-5B87-4325-A6DF-6668AA32C130.gif);-->
<!--	height: 200px;-->
<!--	width: 1000px;-->
<!--	overflow: auto;-->
<!--	background-size:cover;-->
<!--	background-position:center center;-->
<!--	margin-bottom: 0px;-->
<!--	margin-top: 30px;-->
<!--	margin-right: 50px;-->
<!--	"></div>-->
<div class="body-content">




    <div id="post">


        <!-- tin phối giống -->

        <div class="slideshow-container">
            <div id="detail">
                <h3>Thú Cưng Nổi Bật</h3>
            </div>

            <?php
            $i = 0;

            $totalpet = mysqli_num_rows($sp_noibat);
            while($postNoibat = mysqli_fetch_array($sp_noibat)){
                $i++;
                ?>



                <div class="mySlides fade">
                    <div class="numbertext"><?php echo($i)."/".$totalpet; ?></div>
                    <div id="tin-phoi-giong">

                        <div id="anh">
                            <a href="detailPost.php?id=<?php echo $postNoibat['id'] ?>"><img src= <?php echo $postNoibat["image"]?> /></a>
                        </div>
                        <div id="chi-tiet">
                            <h3><?php echo $postNoibat["title"] ?></h3><br>
                            <p>
                                <strong>Giá: </strong>
                                <span><?php echo number_format($postNoibat['price'], 0, ",", ".") ?> đ</span>
                            </p>
                            <p>
                                <strong>Giống: </strong>
                                <span><?php echo $postNoibat["kind"] ?></span>
                            </p>
                            <p>
                                <strong>Tuổi: </strong>
                                <span><?php echo $postNoibat["age"] ?></span>
                            </p>
                            <p>
                                <strong>Xuất xứ: </strong>
                                <span><?php echo $postNoibat["address"] ?></span>
                            </p>
                            <p>
                                <strong>Số lượng: </strong>
                                <span><?php echo $postNoibat["quantity"] ?></span>
                            </p>

                        </div>
                    </div>
                </div>


            <?php } ?>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

        </div>
        <br>


        <div style="text-align:center;margin-bottom: 10px;">
            <?php for ($i=1; $i <= $totalpet ; $i++) {
                echo '<span class="dot" onclick="currentSlide(".$i")"></span>';
            } ?>
            <!--  <span class="dot" onclick="currentSlide(1)"></span>
             <span class="dot" onclick="currentSlide(2)"></span>
             <span class="dot" onclick="currentSlide(3)"></span>  -->
        </div>
        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }
            function currentSlide(n) {
                showSlides(slideIndex = n);
            }
            function showSlides(n) {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                if (n > slides.length) {slideIndex = 1}
                if (n < 1) {slideIndex = slides.length}
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex-1].style.display = "block";
                dots[slideIndex-1].className += " active";
            }
            var slideIndex = 0;
            showSlides();

            function showSlides() {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slideIndex++;
                if (slideIndex > slides.length) {slideIndex = 1}
                slides[slideIndex-1].style.display = "block";
                setTimeout(showSlides, 2000); // Change image every 2 seconds
            }
        </script>


        <!-- tin phối giống -->



        <div id="lastest-post"><h3>Thú Cưng Mới Nhất</h3></div>
        <div id="content-post">

            <div id="detail-post">

                <ul>
                    <?php

                    while($post = mysqli_fetch_array($array_post)){
                        ?>
                        <li>
                            <a href="detailPost.php?id=<?php echo $post['id'] ?>"><img src= <?php echo $post["image"]?> /></a>

                            <h3><?php echo $post["title"] ?></h3> <br>
                            <p>
                                <strong>Giá: </strong>
                                <span><?php echo number_format($post['price'], 0, ",", ".") ?> đ</span>
                            </p>
                            <p>
                                <strong>Giống: </strong>
                                <span><?php echo $post["kind"] ?></span>
                            </p>
                            <p>
                                <strong>Tuổi: </strong>
                                <span><?php echo $post["age"] ?></span>
                            </p>
                            <p>
                                <strong>Xuất xứ: </strong>
                                <span><?php echo $post["address"] ?></span>
                            </p>
                            <p>
                                <strong>Số lượng: </strong>
                                <span><?php echo $post["quantity"] ?></span>
                            </p>
                            <!-- <p>
									<strong>Địa chỉ: </strong>
									<span><?php echo $post["address"] ?></span>
								</p> -->

                        </li>
                    <?php } ?>
                </ul>

            </div>

        </div>
        <!-- phan trang -->
        <div class="pagination">
            <?php

            if(!empty($_POST['kind'])){

                $kind = $_POST['kind'];
                $array_post = mysqli_query($conn, "select * from post where kind like '%$kind%' LIMIT $from , 6");
            }else{

                $array_post = mysqli_query($conn, "SELECT * FROM `post` LIMIT $from , 6");
            }

            $sotrang = ceil($tongsotin / 6);
            $c="";
            // $page = $_GET['trang'];
            $page = isset($_GET['trang']) ? $_GET['trang'] : 1;
            if ($page > 1 && $sotrang > 1){

                echo '<a href="index.php?trang='.($page-1).'">&laquo;</a>';
            }
            for($t=1; $t<=$sotrang; $t++){
                if($page==$t)
                {
                    echo "<a class='active' href='index.php?trang=$t'>$t</a>";
                }
                else echo "<a href='index.php?trang=$t'>$t</a>";
            }

            if ($page >= 1 && $page < $sotrang) {
                // echo "<a href='index.php?trang=.($page+1).'>&raquo;</a>";
                echo '<a href="index.php?trang='.($page+1).'">&raquo;</a>';
            }
            ?>
            <!--  <a href="#">&raquo;</a> -->
        </div>
        <!-- phan trang -->



    </div>



    <!-- tặng thú cưng -->
    <div id="pet-gift"></div>


    <!-- tặng thú cưng -->
    <div id="ads">
        <div id="extention">
            <div id="extention-header"><b>Tiện Ích Hỗ Trợ</b></div>
            <div id="list-extention">
                <ul>
                    <li><a href="https://thucungonline.com/news/category/cam-nang-thu-cung/" target="_blank"><img src="image/dog.png"><b> Cẩm nang chăm sóc thú cưng</b></a></li>
                    <li><a href="https://www.chotot.com/kinh-nghiem/gia-meo-canh.html"target="_blank"><img src="image/cat.svg"><b> Bảng giá và cẩm nang loài mèo</b></a></li>
                    <li><a href="https://www.petmart.vn/cap-nhat-bang-gia-cho-canh-nuoi-nhieu-tai-viet-nam"target="_blank"><img src="image/dog.svg"><b> Bảng giá và cẩm nang loài chó</b></a></li>
                    <li><a href="https://biowish.vn/05-benh-thuong-gap-o-thu-cung-ban-nuoi-cho-meo-nen-biet/"target="_blank"><img src="image/paw.png"><b> Các bệnh thú cưng thường gặp</b></a></li>
                </ul>
            </div>
        </div>
        <div id="ads-fb">
            <br>
            <img src="image/064ce760c2bae304b8fc6c7efde667be.gif" width="260px">
        </div>
        <div id="ads-fb">
            <br>
            <img src="image/08634887-5B87-4325-A6DF-6668AA32C130.gif" width="260px">
        </div>

        <div id="ads-fb">
            <br>
            <img src="image/2e36bcc7f6072df06adad373ff4f1fae85976f7f_hq.gif" width="260px">
        </div>
    </div>







</div>



<div id="footer"><h4>PET SHOP THÚ CƯNG LỚN NHẤT HÀ NỘI</h4></div>
<div id="footer">Petshop – Thương hiệu kinh doanh thú cưng, phụ kiện uy tín, chuyên nghiệp</div>
<div id="footer">Người đại diện: Nguyễn Thị Ngọc Hiên</div>
<div id="footer">Địa chỉ: Phố Hồng Tiến - Long Biên - Hà nội</div>


</body>
</html>
