
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
    ?>
    <div class="main-content">
<!--      <h1><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy sản phẩm" : "Sửa sản phẩm") : "Thêm sản phẩm" ?></h1> -->
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
                if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['price']) && !empty($_POST['price'])) {
                    $galleryImages = array();
                    if (empty($_POST['title'])) {
                        $error = "Bạn phải nhập tiêu đề sản phẩm";
                    } elseif (empty($_POST['price'])) {
                        $error = "Bạn phải nhập giá sản phẩm";
                    } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                        $error = "Giá nhập không hợp lệ";
                    }
                    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                        $uploadedFiles = $_FILES['image'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $image = $result['path'];
                        }
                    }
                    if (!isset($image) && !empty($_POST['image'])) {
                        $image = $_POST['image'];
                    }
                    if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                        $uploadedFiles = $_FILES['gallery'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $galleryImages = $result['uploaded_files'];
                        }
                    }
                    if (!empty($_POST['gallery_image'])) {
                        $galleryImages = array_merge($galleryImages, $_POST['gallery_image']);
                    }
                    if (!isset($error)) {
                        if ($_GET['action'] == 'edit' && !empty($_GET['id'])) { //Cập nhật lại sản phẩm
                            $result = mysqli_query($conn, "UPDATE `post` SET `title` = '" . $_POST['title'] . "',`image` =  '" . $image . "', `price` = " . str_replace('.', '', $_POST['price']) . ", `age` = '" . $_POST['age'] . "', `kind` = '" . $_POST['kind'] . "', `address` = '" . $_POST['address'] . "', `last_updated` = " . time() . " WHERE `post`.`id` = " . $_GET['id']);
                        } else { //Thêm sản phẩm
                            $result = mysqli_query($conn, "INSERT INTO `post` VALUES (NULL, '" . $_POST['title'] . "', " . str_replace('.', '', $_POST['price']) . ", '" . $_POST['kind'] . "', '" . $_POST['age'] . "', '" . $_POST['address'] . "','" . $image . "', " . time() . ", " . time() . ");");
                        }
                        if (!$result) { //Nếu có lỗi xảy ra
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        } else { //Nếu thành công
                            if (!empty($galleryImages)) {
                                $post_id = ($_GET['action'] == 'edit' && !empty($_GET['id'])) ? $_GET['id'] : $con->insert_id;
                                $insertValues = "";
                                foreach ($galleryImages as $path) {
                                    if (empty($insertValues)) {
                                        $insertValues = "(NULL, " . $post_id . ", '" . $path . "', " . time() . ", " . time() . ")";
                                    } else {
                                        $insertValues .= ",(NULL, " . $post_id . ", '" . $path . "', " . time() . ", " . time() . ")";
                                    }
                                }
                                $result = mysqli_query($conn, "INSERT INTO `image_library` (`id`, `post_id`, `path`, `created_time`, `last_updated`) VALUES " . $insertValues . ";");
                            }
                        }
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                }
                ?>
                <div class = "container">
                    echo "<script>alert('Cập nhật thành công!');
                location.href='./index.php'</script>";
                </div>
                <?php
            } else {
                if (!empty($_GET['id'])) {
                    $result = mysqli_query($conn, "SELECT * FROM `Vouchers` WHERE `id` = " . $_GET['id']);
                    $product = $result->fetch_assoc();
                    $gallery = mysqli_query($conn, "SELECT * FROM `image_library` WHERE `post_id` = " . $_GET['id']);
                    if (!empty($gallery) && !empty($gallery->num_rows)) {
                        while ($row = mysqli_fetch_array($gallery)) {
                            $product['gallery'][] = array(
                                'id' => $row['id'],
                                'path' => $row['path']
                            );
                        }
                    }
                }
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
                            <div class="left__image"><a href="../index.php"><img src="assets/MOM_1679.JPG" alt=""></a></div>
                            <p class="left__name">Admin</p>
                        </div>
                        <ul class="left__menu">
                            <li class="left__menuItem">
                                <a href="xem-san-pham.php" class="left__title"><img src="assets/icon-dashboard.svg" alt="">Dashboard</a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-tag.svg" alt="">Sản Phẩm<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="cap-nhat-san-pham.php">Thêm Sản Phẩm</a>
                                    <a class="left__link" href="xem-san-pham.php">Xem Sản Phẩm</a>
                                </div>
                            </li>
                           <!--  <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-edit.svg" alt="">Danh Mục SP<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_p_category.html">Chèn Danh Mục</a>
                                    <a class="left__link" href="view_p_category.html">Xem Danh Mục</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-book.svg" alt="">Thể Loại<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_category.html">Chèn Thể Loại</a>
                                    <a class="left__link" href="view_category.html">Xem Thể Loại</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-settings.svg" alt="">Slide<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_slide.html">Chèn Slide</a>
                                    <a class="left__link" href="view_slides.html">Xem Slide</a>
                                </div>
                            </li> -->
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-book.svg" alt="">Vouchers</div>
                                <div class="left__text">
                                    <a class="left__link" href="cap-nhat-vouchers.php">Thêm voucher</a>
                                    <a class="left__link" href="danh-sach-vouchers.php">DS voucher</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="view_customers.html" class="left__title"><img src="assets/icon-users.svg" alt="">Khách Hàng</a>
                            </li>
                            <li class="left__menuItem">
                                <a href="./don-hang.php" class="left__title"><img src="assets/icon-book.svg" alt="">Đơn Đặt Hàng</a>
                            </li>
                            <li class="left__menuItem">
                                <a href="./thong-ke.php" class="left__title"><img src="assets/icon-book.svg" alt="">Thống
                                    kê</a>
                            </li>
                           <!--  <li class="left__menuItem">
                                <a href="edit_css.html" class="left__title"><img src="assets/icon-pencil.svg" alt="">Chỉnh CSS</a>
                            </li> -->
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-user.svg" alt="">Admin<img class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_admin.html">Thêm Admin</a>
                                    <a class="left__link" href="view_admins.html">Xem Admins</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="" class="left__title"><img src="assets/icon-logout.svg" alt="">Đăng Xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
               <!--   <div class="right"> -->
                    <!-- <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div> -->
                      <!--   <p class="right__desc">Bảng điều khiển</p> -->
                        <!-- <div class="right__cards">
                            <a class="right__card" href="xem-san-pham.php">
                                <div class="right__cardTitle">Sản Phẩm</div>
                                <div class="right__cardNumber">72</div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="assets/arrow-right.svg" alt=""></div>
                            </a>
                            <a class="right__card" href="view_customers.html">
                                <div class="right__cardTitle">Khách Hàng</div>
                                <div class="right__cardNumber">12</div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="assets/arrow-right.svg" alt=""></div>
                            </a>
                            <a class="right__card" href="view_p_category.html">
                                <div class="right__cardTitle">Danh Mục</div>
                                <div class="right__cardNumber">4</div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="assets/arrow-right.svg" alt=""></div>
                            </a>
                            <a class="right__card" href="view_orders.html">
                                <div class="right__cardTitle">Đơn Hàng</div>
                                <div class="right__cardNumber">72</div>
                                <div class="right__cardDesc">Xem Chi Tiết <img src="assets/arrow-right.svg" alt=""></div>
                            </a>
                        </div> -->
        <div class="right">
            <div class="right__content">
                <div class="right__title">Bảng điều khiển</div>
                <p class="right__desc"><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy sản phẩm" : "Sửa sản phẩm") : "Thêm sản phẩm" ?></p>
                <div class="right__formWrapper">
                            
                <form id="editing-form" method="POST" action="<?= (!empty($product) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"  enctype="multipart/form-data">
                   
                   <!--  <div class="clear-both"></div> -->
                    <div class="right__inputWrapper">
                        <label>Phần trăm giảm </label>
                        <input type="text" name="discount" value="<?= (!empty($product) ? $product['title'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                     
                     <div class="right__inputWrapper">
                        <label>Mã Voucher</label>
                        <input type="text" name="code" value="<?= (!empty($product) ? $product['kind'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                     <div class="right__inputWrapper">
                        <label>Số lượng</label>
                        <input type="text" name="quantity" value="<?= (!empty($product) ? $product['age'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                <button class="btn" type="submit">Cập nhật</button>
                </form>
                 </div>
        </div>
    </div>

    <script src="js/main.js"></script>

                <div class="clear-both"></div>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                </script>
    <?php } ?>
        </div>
    </div>

    <?php
}

?>