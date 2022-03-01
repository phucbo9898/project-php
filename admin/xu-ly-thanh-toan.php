<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1>Xóa sản phẩm</h1>
        <div id="content-box">
            <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include '../config.php';
                $productInOrder = mysqli_query($conn, "select order_detail.quantity, order_detail.post_id from order_detail, orders where order_detail.order_id = orders.id and orders.id = " . $_GET['id']);
                while ($row = mysqli_fetch_array($productInOrder)) {
                    $product = mysqli_query($conn, "SELECT * FROM `post` WHERE `id` = ".$row['post_id']);
                    $product =  mysqli_fetch_array($product);
                    $newQuantityProduct = (int)$product['quantity'] - (int)$row['quantity'];
                    if ($newQuantityProduct < 0) {
                        echo "Hết Sản PHẩm";
                    }
                    mysqli_query($conn, "Update post set quantity = '" . $newQuantityProduct . "' where id =" . $row['post_id']);
                }
                $result = mysqli_query($conn, "Update `orders` set `status` = 1  WHERE `id` = " . $_GET['id']);
                if (!$result) {
                    $error = "Cập nhật thành công!";
                }
                mysqli_close($conn);
                if ($error !== true) {
                    ?>
                    <script>alert('Cập nhật thành công!');
                    location.href='don-hang.php'</script>;
        <?php } else { ?>
                   <script>
                    location.href='don-hang.php'</script>;
                <?php } ?>
    <?php } ?>
        </div>
    </div>
    <?php
}
include 'footer.php';
?>