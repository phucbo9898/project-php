
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

if (!empty($_SESSION['current_admin'])) {
    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $kind = $_POST['kind'];
    }
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($kind)){
        $totalRecords = mysqli_query($conn, "select * from post where kind like '%$kind%'");
    }else{
        $totalRecords = mysqli_query($conn, "SELECT * FROM `post`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($kind)){
        $products = mysqli_query($conn, "select * from post where kind like '%$kind%' ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $products = mysqli_query($conn, "SELECT * FROM `post` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($conn);
}else echo "<script>alert('Bạn chưa đăng nhập!');
                location.href='../Sign-In-Sign-Up-Form/index.html'</script>";
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
                        <div class="left__logo">PET SHOP</div>
                        <div class="left__profile">
                            <div class="left__image"><a href="./index.php"><img src="assets/MOM_1679.JPG" alt=""></a></div>
                            <p class="left__name"><?= $_SESSION['current_user'] ?></p>
                        </div>
                        <ul class="left__menu">
                            <li class="left__menuItem">
                                <a href="index.php" class="left__title"><img src="assets/icon-dashboard.svg" alt="">Dashboard</a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-tag.svg" alt="">Sản Phẩm<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="./cap-nhat-san-pham.php">Thêm <?=$config_title?></a>
                                    <a class="left__link" href="xem-san-pham.php">Xem Sản Phẩm</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-book.svg" alt="">Vouchers</div>
                                <div class="left__text">
                                    <a class="left__link" href="cap-nhat-vouchers.php">Thêm voucher</a>
                                    <a class="left__link" href="danh-sach-vouchers.php">DS voucher</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-book.svg" alt="">Doanh thu<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                   
                                    <a class="left__link" href="view_coupons.html">Doanh thu ngày</a>
                                    <a class="left__link" href="view_coupons.html">Doanh thu tháng</a>
                                </div>
                            </li>
                             <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-book.svg" alt="">Người dùng<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                   
                                    <a class="left__link" href="./cap-nhat-nguoi-dung.php">Thêm người dùng</a>
                                    <a class="left__link" href="./view_customers.php">DS người dùng</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="./don-hang.php" class="left__title"><img src="assets/icon-book.svg" alt="">Đơn Đặt Hàng</a>
                            </li>
                         
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-user.svg" alt="">Admin<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="export-data.php">Back-up Dữ Liệu</a>
                                    <a class="left__link" href="import-data.php">Import Dữ Liệu</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="../logout.php" class="left__title"><img src="assets/icon-logout.svg" alt="">Đăng Xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                      
                        <div class="right__cards">
                            <a class="right__card" href="xem-san-pham.php">
                                <div class="right__cardTitle">Sản Phẩm</div>
                                <div class="right__cardNumber"><?= $totalRecords?></div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="assets/arrow-right.svg" alt=""></div>
                            </a>
                            <a class="right__card" href="./don-hang.php">
                                <div class="right__cardTitle">Đơn Hàng</div>
                                <div class="right__cardNumber">72</div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="assets/arrow-right.svg" alt=""></div>
                            </a>
                        </div>
                        <p class="right__desc">Xem sản phẩm</p>
                        <div class="right__table">
                           
                             <div class="listing-search">
                                <form id="<?=$config_name?>-search-form" action="xem-san-pham.php?action=search" method="POST">
                                    <fieldset>
                                       
                                      <!--   ID: <input type="text" name="id" value="<?=!empty($id)?$id:""?>" /> -->
                        Tên <?=$config_title?>: <input type="text" name="kind" />
                                        <!-- <input type="submit" value="Tìm" /> -->
                                        <button type="submit">Tìm</button>

                                    </fieldset>
                                   
                                </form>
                            </div>
                             <div class="total-items">
                                <span>Có tất cả <strong><?=$totalRecords?></strong> <?=$config_title?> trên <strong><?=$totalPages?></strong> trang</span>
                            </div>
                            <div class="right__tableWrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                           <!--  <th>Tiêu Đề</th> -->
                                            <th>Hình ảnh</th>
                                            <th>Giá SP</th>
                                            <th>Giống</th>
                                             <th>Địa chỉ</th>
                                           <th>Tuổi</th>
                                            <th>Thời gian tạo</th>
                                          

                                            <th>Sửa</th>
                                            <th>Xoá</th>
                                        </tr>
                                    </thead>


                <?php
                $stt = 0;
                while ($row = mysqli_fetch_array($products)) {
                    $stt ++;
                ?>
                     <tbody>
                        <tr>
                            <td><?= $stt ?></td>
                          <!--   <td ><?= $row['title'] ?></td> -->
                            <td id="anhsp"><img src="../<?= $row['image'] ?>" alt="<?= $row['kind'] ?>" title="<?= $row['kind'] ?>"/></td>
                            <td><?=number_format(($row['price']),0,",",".")  ?></td>
                           
                            <td><?= $row['kind'] ?></td>
                           
                            <td><?= $row['address'] ?></td> <td><?= $row['age'] ?></td>
                            <td><?= date('d/m/Y H:i', $row['created_time']) ?></td>
                          
                            <td data-label="Sửa" class="right__iconTable"><a href="./cap-nhat-san-pham.php?id=<?= $row['id'] ?>"><img src="assets/icon-edit.svg" alt=""></a></td>
                            <td data-label="Xoá" class="right__iconTable"><a href="./<?=$config_name?>_delete.php?id=<?= $row['id'] ?>"><img src="assets/icon-trash-black.svg" alt=""></a></td>
                        </tr>
                 <?php } ?>
                                
                                </table>
                                <?php
            include './pagination.php';
            ?>
            <div class="clear-both"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="js/main.js"></script>
</body>
</html>
