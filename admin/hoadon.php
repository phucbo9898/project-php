<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<link rel="stylesheet" type="text/css" href="css/styleHoaDon.css">
<script src="../resources/ckeditor/ckeditor.js"></script>
</head>
<body>
<?php
session_start();
if (!empty($_SESSION['current_user'])) {
    include '../config.php';
    $orders = mysqli_query($conn, "SELECT *, order_detail.*, post.kind as product_name 
FROM orders
INNER JOIN order_detail ON orders.id = order_detail.order_id
INNER JOIN post ON post.id = order_detail.post_id
WHERE orders.id = " . $_GET['id']);
    $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
}
$user_name = $_SESSION['current_user'];
$user1 = mysqli_query($conn, "SELECT * FROM `user` WHERE `username` = '$user_name'");
$rowUser = mysqli_fetch_array($user1);
?>
<div id="page" class="page">
    <div class="header">
        <div class="logo"><img src="assets/logo.png"/></div>
        <div class="company">Cửa Hàng Thú Cưng PetShop<br>Mã số thuế:1221343444<br>Đia chỉ: 98 Phố Hồng Tiến, Long Biên,
            Hà Nội
        </div>
    </div>
    <br/>
    <div class="title">
        <br>
        HÓA ĐƠN THANH TOÁN
        <br/>
        <br>
    </div>
    <div id="infor-khachhang">
        <label>Người nhận: </label><span> <?= $rowUser['username'] ?></span><br/>
        <label>Điện thoại: </label><span> <?= $rowUser['diachi'] ?></span><br/>
        <label>Địa chỉ: </label><span> <?= $rowUser['sodienthoai'] ?></span><br/>
        <hr/>
    </div>
    <br/>
    <br/>
    <table class="TableData">
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        <?php
        $tongsotien = 0;
        $pos = 1;
        $tongsotien = 0;
        foreach ($orders as $row) {
            $tongsotien += $row['quantity'] * $row['price'];
            echo "<tr>";
            echo "<td class=\"cotSTT\">" . $pos++ . "</td>";
            echo "<td class=\"cotTenSanPham\">" . $row['kind'] . "</td>";
            echo "<td class=\"cotTenSanPham\">" . $row['price'] . "</td>";

            // echo "<td class=\"cotGia\"><div id='giasp".$row['price']."' name='giasp".$row['sp_id']."' value='".$row['sp_dongia']."'>".number_format($row['sp_dongia'],0,",",".")."</div></td>";
            echo "<td class=\"cotSoLuong\" align='center'>" . $row['quantity'] . "</td>";
            echo "<td class=\"cotSo\">" . number_format(($row['quantity'] * $row['price']), 0, ",", ".") . "</td>";
            echo "</tr>";
        }
        ?>
        <tr>
            <td colspan="4" class="tong">Tổng cộng</td>
            <td class="cotSo"><?php echo number_format(($tongsotien), 0, ",", ".") ?></td>
        </tr>
    </table>
    <div class="footer-left"> Hà Nội, ngày 21 tháng 7 năm 2021<br/>
        Khách hàng
    </div>
    <div class="footer-right"> Hà Nội, ngày 21 tháng 7 năm 2021<br/>
        Nhân viên
    </div>
</div>
</body>
</html>