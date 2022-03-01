 
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
if (!empty($_GET['id'])) {
    $orderid = $_GET['id'];
}
if (!empty($_SESSION['current_admin'])) {
   
        $products = mysqli_query($conn, "select * from order_detail where order_id = '$orderid' ");
       
    
}
    ?>
      <?php
          include('./menu.php');
          ?>
                <div class="right">
                    <div class="right__content">
            
                        <p class="right__desc">Chi tiết đơn hàng</p>
                        <div class="right__table">
                           
                            
                            
                            <div class="right__tableWrapper">
                                
<table>
    <tr>
       <!--  <th class="product-number">STT</th> -->
        <th class="product-name">Giống</th>
        <th class="product-img">Ảnh sản phẩm</th>
        <th class="product-name">Đơn giá</th>
        <th class="product-name">Số lượng</th>
        <th class="product-name">Thành tiền</th>
        
    </tr>
    <hr>
    <?php
    if (!empty($products)) {
        $total = null;  
        $total = 0;
        $num = 1;
        while ($row = mysqli_fetch_array($products)) {

        $post =  mysqli_query($conn, "select * from post where id='".$row['post_id']."' ");
        $row2 = mysqli_fetch_array($post);
            ?>
            <tr>
              
                <td class="product-kind"><?= $row2['kind'] ?></td>
                <td class="product-img"><img src="../<?= $row2['image'] ?>" /></td>
                <td class="product-name"><?= number_format($row['price'], 0, ",", ".") ?></td>
                <td class="product-quantity"><a><?= $row['quantity'] ?> </a></td>
                <td class="product-name"><?= number_format($row['price'] * $row['quantity'], 0, ",", ".") ?></td>
               
            </tr>
            <?php
            // $total += $row['price'] * $_SESSION["cart"][$row['id']];
            $num++;
        }
        ?>

      
        
        <?php
    }
   
    ?>

</table>
                
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



