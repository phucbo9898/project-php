
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
   
        $products = mysqli_query($conn, "select * from vouchers ");
    mysqli_close($conn);
}
    ?>
      <?php
          include('./menu.php');
          ?>
                <div class="right">
                    <div class="right__content">
            
                        <p class="right__desc">Danh sách vouchers</p>
                        <div class="right__table">
                           
                            
                            
                            <div class="right__tableWrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                           <!--  <th>Tiêu Đề</th> -->
                                            <th>ID</th>
                                            <th>Phần trăm giảm</th>
                                            <th>Code</th>
                                           <th>Sửa</th>
                                           <th>Xóa</th>
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
                           
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['discount'] ?></td>
                           
                            <td><?= $row['code'] ?></td> 
                           
                           
                            <td data-label="Sửa" class="right__iconTable"><a href="./cap-nhat-san-pham.php?id=<?= $row['id'] ?>"><img src="assets/icon-edit.svg" alt=""></a></td>
                            <td data-label="Xoá" class="right__iconTable"><a href="./<?=$config_name?>_delete.php?id=<?= $row['id'] ?>"><img src="assets/icon-trash-black.svg" alt=""></a></td>
                        </tr>
                 <?php } ?>
                                <!--     <tbody>
                                        <tr>
                                            <td data-label="STT">1</td>
                                            <td data-label="Tên sản phẩm">Dada Dress</td>
                                            <td data-label="Hình ảnh"><img src="images/product1.jpg" alt=""></td>
                                            <td data-label="Giá SP">590.000 ₫</td>
                                            <td data-label="Đã bán">1</td>
                                            <td data-label="Từ khoá">dress, vay</td>
                                            <td data-label="Thời gian">2020-07-13 21:31:05</td>
                                            <td data-label="Sửa" class="right__iconTable"><a href=""><img src="assets/icon-edit.svg" alt=""></a></td>
                                            <td data-label="Xoá" class="right__iconTable"><a href=""><img src="assets/icon-trash-black.svg" alt=""></a></td>
                                        </tr>
                                        <tr>
                                            <td data-label="STT">2</td>
                                            <td data-label="Tên sản phẩm">Cobi Top, Tuta Skirt</td>
                                            <td data-label="Hình ảnh"><img src="images/product2.jpg" alt=""></td>
                                            <td data-label="Giá SP">810.000 ₫</td>
                                            <td data-label="Đã bán">0</td>
                                            <td data-label="Từ khoá">top skirt</td>
                                            <td data-label="Thời gian">2020-07-13 22:19:01</td>
                                            <td data-label="Sửa" class="right__iconTable"><a href=""><img src="assets/icon-edit.svg" alt=""></a></td>
                                            <td data-label="Xoá" class="right__iconTable"><a href=""><img src="assets/icon-trash-black.svg" alt=""></a></td>
                                        </tr>
                                        <tr>
                                            <td data-label="STT">3</td>
                                            <td data-label="Tên sản phẩm">Beda Dress</td>
                                            <td data-label="Hình ảnh"><img src="images/product3.jpg" alt=""></td>
                                            <td data-label="Giá SP">590.000 ₫</td>
                                            <td data-label="Đã bán">1</td>
                                            <td data-label="Từ khoá">dress, vay</td>
                                            <td data-label="Thời gian">2020-07-13 21:30:41</td>
                                            <td data-label="Sửa" class="right__iconTable"><a href=""><img src="assets/icon-edit.svg" alt=""></a></td>
                                            <td data-label="Xoá" class="right__iconTable"><a href=""><img src="assets/icon-trash-black.svg" alt=""></a></td>
                                        </tr>
                                    </tbody> -->
                                </table>
                               
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
