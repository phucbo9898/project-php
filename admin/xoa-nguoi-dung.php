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
                $result = mysqli_query($conn, "DELETE FROM `user` WHERE `id` = " . $_GET['id']);
                if (!$result) {
                    $error = "Không thể xóa người dùng.";
                }
                mysqli_close($conn);
                if ($error !== false) {
                    ?>
                    <script>alert('Xóa thất bại!');
                    location.href='view-customers.php'</script>;
        <?php } else { ?>
                   <script>alert('Xóa thành công!');
                    location.href='view-customers.php'</script>;
                <?php } ?>
    <?php } ?>
        </div>
    </div>
    <?php
}
include 'footer.php';
?>