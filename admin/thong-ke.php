<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/tk.css">
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

    if (isset($_GET['time-start']) && isset($_GET['time-end'])) {
        $time_start = substr($_GET['time-start'], 0, -6);
        $time_start_stamp = new DateTime($time_start);
        $time_start_stamp = $time_start_stamp->getTimestamp();

        $time_end = substr($_GET['time-end'], 0, -6);
        $time_end_stamp = new DateTime($time_end);
        $time_end_stamp = $time_end_stamp->getTimestamp();

        $orderDetails = mysqli_query($conn, "SELECT post.title, post.kind, order_detail.price, order_detail.created_time FROM `order_detail`, `post` WHERE order_detail.post_id = post.id and order_detail.created_time between " . $time_start_stamp . " and " . $time_end_stamp);

    }

} else echo "<script>alert('Bạn chưa đăng nhập!');
                location.href='../Sign-In-Sign-Up-Form/index.html'</script>";
?>
<form action="">
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
                            <div class="left__image"><a href="../index.php"><img src="assets/bongbongno1.png" alt=""></a></div>
                            <p class="left__name">Admin</p>
                        </div>
                        <ul class="left__menu">
                            <li class="left__menuItem">
                                <a href="xem-san-pham.php" class="left__title"><img src="assets/icon-dashboard.svg" alt="">Dashboard</a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-tag.svg" alt="">Sản Phẩm<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="./cap-nhat-san-pham.php">Thêm <?=$config_title?></a>
                                    <a class="left__link" href="xem-san-pham.php">Xem Sản Phẩm</a>
                                </div>
                            </li>

                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-book.svg" alt="">Vouchers<img
                                            class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="cap-nhat-vouchers.php">Thêm voucher</a>
                                    <a class="left__link" href="danh-sach-vouchers.php">DS vouchers</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-book.svg" alt="">Người dùng<img
                                            class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">

                                    <a class="left__link" href="./cap-nhat-nguoi-dung.php">Thêm người dùng</a>
                                    <a class="left__link" href="view-customers.php">DS người dùng</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="./don-hang.php" class="left__title"><img src="assets/icon-book.svg" alt="">Đơn
                                    Đặt Hàng</a>
                            </li>
                            <li class="left__menuItem">
                                <a href="./thong-ke.php" class="left__title"><img src="assets/icon-book.svg" alt="">Thống
                                    kê</a>
                            </li>
                            <!--   <li class="left__menuItem">
                                  <a href="edit_css.html" class="left__title"><img src="assets/icon-pencil.svg" alt="">Chỉnh CSS</a>
                              </li> -->
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-user.svg" alt="">Admin<img
                                            class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">

                                    <!--   <a class="left__link" href="view_admins.html">Xem Admins</a> -->
                                    <a class="left__link" href="export-data.php">Back-up Dữ Liệu</a>
                                    <a class="left__link" href="import-data.php">Import Dữ Liệu</a>

                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="../logout.php" class="left__title"><img src="assets/icon-logout.svg" alt="">Đăng
                                    Xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng thống kê doanh thu</div>
                        <form action="" method="get">
                            <div class="p1">
                                <div class="p2">
                                    <p>Bắt đầu:</p>
                                    <input type="datetime-local" id="meeting-time" name="time-start">
                                </div>
                                <div class="p3">
                                    <input type="submit" value="Thống kê" style="width: 110px;height: 40px;border: 1px solid blue;">
                                </div>
                                <div class="p4">
                                    <p>Kết thúc:</p>
                                    <input type="datetime-local" id="meeting-time" name="time-end">
                                </div>
                            </div>
                        </form>
                        <table>
                            <?php
                            if (isset($_GET['time-start']) && isset($_GET['time-end'])) {
                                echo "<thead>
                                    <td>stt</td>
                                    <td>Tên</td>
                                    <td>Loại</td>
                                    <td>Giá</td>
                                    <td>Thời gian mua</td>
                                </thead>";
                                $stt = 0;
                                $total = 0;
                                while ($row = mysqli_fetch_array($orderDetails)) {
                                    $stt++;
                                    $total = $total + $row['price'];
                                    echo "<tr>";
                                    echo "<td>" . $stt . "</td>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['kind'] . "</td>";
                                    echo "<td>" . number_format($row['price'], 0, ",", ".") . " VNĐ</td>";
                                    echo "<td>" . date("Y-m-d", $row['created_time']) . "</td>";
                                    echo "</tr>";
                                }


                                echo " </table>
                        <div style='float: right; font-size: 30px; font-weight: bold'>
                            Tổng thu: " . number_format($total, 0, ",", ".") . " VNĐ
                        </div>
                        <span style='clear: both'></span>";
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>