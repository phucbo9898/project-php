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
                $result = mysqli_query($conn, "Update `orders` set `status` = 0  WHERE `id` = " . $_GET['id']);
                if (!$result) {
                    $error = "Không thể cập nhật!";
                }
                mysqli_close($conn);
                if ($error !== false) {
                    ?>
                    <script>alert('Không thể cập nhật!');
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