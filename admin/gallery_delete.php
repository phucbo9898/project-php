<?php include 'header.php'; ?>
<div class="main-content">
    <h1>Xóa sản phẩm</h1>
    <div id="content-box">
    <?php
    $idpost = $_GET['idp'];
            $url= "cap-nhat-san-pham.php?id=$idpost";
    $error = false;
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        include '../config.php';
        $result = mysqli_query($conn, "DELETE FROM `image_library` WHERE `id` = ".$_GET['id']);
        if (!$result) {
            $error = "Không thể xóa ảnh trong thư viện.";
        }
        mysqli_close($conn);
        if ($error !== false) {
            
           echo "<script>alert('Xóa thất bại!');
                location.href=$url</script>";
        } else { 
           
           header( "Location: $url" );
         } ?>
    <?php } ?>
    </div>
</div>
<?php include 'footer.php'; ?>