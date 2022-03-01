
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
		 $products = mysqli_query($conn, "SELECT * FROM `orders`");

         $output='';
	?>

      <?php
          include('./menu.php');
          ?>
                <div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <div id="exel">
                             <p style="float: left;padding-right: 656px;" class="right__desc">Xem đơn hàng</p>
                            <button style="float: right;"><a href="outputexcel.php">Xuất Excel</a></button>
                        </div>
                        <div class="right__table">
                            <div class="right__tableWrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            
                                            <th>Số hoá đơn</th>
                                            <th>Tên Khách Hàng</th>
                                           <!--  <th>Tên sản phẩm</th> -->
                                            <th>SĐT</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày</th>
                                            <th>Tổng</th>
                                            <th>Trạng thái</th>
                                            <th>Xoá</th>
                                            <th>In</th>
                                            <th>Chi tiết</th>
                                            <th>Thanh toán</th>
                                            
                                        </tr>
                                    </thead>
                            
                                    <tbody>

                                    	 <?php
                $stt = 0;
                while ($row = mysqli_fetch_array($products)) {
                    $user = mysqli_query($conn, "SELECT * FROM `user` WHERE `id` = ".$row['userID']);
                    $rowUser =  mysqli_fetch_array($user);
                    $stt ++;
                ?>
                     <tbody>
                        <tr>
                            <td><?= $stt ?></td>
                          <!--   <td ><?= $row['title'] ?></td> -->
                            <td><?= $row['id'] ?></td> 
                           
                            <td><?= $row['username'] ?></td>
                           
                            <td><?= $row['sdt'] ?></td> 
                             <td><?= $row['diachi'] ?></td>
                            <td><?= date('d/m/Y H:i', $row['created_time']) ?></td>
                            <td><?= number_format(($row['total']),0,",",".") ?></td>
                           
                           <td data-label="Trạng thái">
                               <?php
                                if ($row['status'] == 0) {
                                     echo "Chưa TT";
                                 }
                                 else
                                     echo "Đã TT";
                               ?>
                           </td>
                            <td data-label="Xoá" class="right__iconTable"><a  href="./xoa-hoa-don.php?id=<?= $row['id'] ?>"><img src="assets/icon-trash-black.svg" alt=""></a></td>
                            <td data-label="In" class="right__iconTable"><a href="hoadon.php?id=<?=$row['id']?>"><img src="assets/print.svg" alt=""></a></td>
                            <td data-label="In" class="right__iconTable"><a href="./chi-tiet-don-hang.php?id=<?=$row['id']?>"><img src="assets/detail.png" alt=""></a></td>




                            <td data-label="Thanh toán" class="right__confirm">
                                <a href="./xu-ly-thanh-toan.php?id=<?=$row['id']?>" class="right__iconTable"><img src="assets/icon-check.svg" alt=""></a>
                                <a href="./xu-ly-chua-thanh-toan.php?id=<?=$row['id']?>" class="right__iconTable"><img src="assets/icon-x.svg" alt=""></a>
                            </td>
                                             
                           
                        </tr>
                 <?php } ?>

                                </tbody>
                                </table>

                               
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