
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
                            $result = mysqli_query($conn, "UPDATE `post` SET `title` = '" . $_POST['title'] . "', `quantity` = '" . $_POST['quantity'] . "',`image` =  '" . $image . "', `price` = " . str_replace('.', '', $_POST['price']) . ", `age` = '" . $_POST['age'] . "', `kind` = '" . $_POST['kind'] . "', `address` = '" . $_POST['address'] . "', `last_updated` = " . time() . " WHERE `post`.`id` = " . $_GET['id']);
                        } else { //Thêm sản phẩm
                            $result = mysqli_query($conn, "INSERT INTO `post` VALUES (NULL, '" . $_POST['title'] . "','" . $_POST['quantity'] . "',  " . str_replace('.', '', $_POST['price']) . ", '" . $_POST['kind'] . "', '" . $_POST['age'] . "', '" . $_POST['address'] . "','" . $image . "',0, " . time() . ", " . time() . ");");
                        }
                        if (!$result) { //Nếu có lỗi xảy ra
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        } else { //Nếu thành công
                            if (!empty($galleryImages)) {
                                $post_id = ($_GET['action'] == 'edit' && !empty($_GET['id'])) ? $_GET['id'] : $conn->insert_id;
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
                location.href='./xem-san-pham.php'</script>";
                </div>
                <?php
            } else {
                if (!empty($_GET['id'])) {
                    $result = mysqli_query($conn, "SELECT * FROM `post` WHERE `id` = " . $_GET['id']);
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
                   <?php
          include('./menu.php');
          ?>
        <div class="right">
            <div class="right__content">
                <div class="right__title">Bảng điều khiển</div>
                <p class="right__desc"><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "Copy sản phẩm" : "Sửa sản phẩm") : "Thêm sản phẩm" ?></p>
                <div class="right__formWrapper">
                            
                <form id="editing-form" method="POST" action="<?= (!empty($product) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"  enctype="multipart/form-data">
                   
                   <!--  <div class="clear-both"></div> -->
                    <div class="right__inputWrapper">
                        <label>Tiêu đề: </label>
                        <input type="text" name="title" value="<?= (!empty($product) ? $product['title'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                     
                     <div class="right__inputWrapper">
                        <label>Giống: </label>
                        <input type="text" name="kind" value="<?= (!empty($product) ? $product['kind'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                     <div class="right__inputWrapper">
                        <label>Tuổi: </label>
                        <input type="text" name="age" value="<?= (!empty($product) ? $product['age'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="right__inputWrapper">
                        <label>Xuất xứ: </label>
                        <input type="text" name="address" value="<?= (!empty($product) ? $product['address'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="right__inputWrapper">
                        <label>Giá sản phẩm: </label>
                        <input type="text" name="price" value="<?= (!empty($product) ? number_format($product['price'], 0, ",", ".") : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="right__inputWrapper">
                        <label>Tồn kho: </label>
                        <input type="text" name="quantity" value="<?= (!empty($product) ? number_format($product['quantity'], 0, ",", ".") : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="right__inputWrapper">
                        <label>Ảnh đại diện: </label>
                        <div class="right-wrap-field">
        <?php if (!empty($product['image'])) { ?>
                                <img src="../<?= $product['image'] ?>" /><br/>
                                <input type="hidden" name="image" value="<?= $product['image'] ?>" />
        <?php } ?>
                            <input type="file" name="image" />
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Thư viện ảnh: </label>
                        <div class="right-wrap-field">
                                <?php
                                if (!empty($_GET['id'])) {
                                    $idpost = $_GET['id'];
                                }
                                
                                if (!empty($product['gallery'])) { ?>
                                <ul>
            <?php foreach ($product['gallery'] as $image) { ?>
                                        <li>
                                            <img src="../<?= $image['path'] ?>" />
    <a style="color: red;" href="gallery_delete.php?id=<?= $image['id'] ?>&idp=<?=$idpost?>">Xóa</a>
                                        </li>
                                <?php } ?>
                                </ul>
                            <?php } ?>
                            <?php if (isset($_GET['task']) && !empty($product['gallery'])) { ?>
                                <?php foreach ($product['gallery'] as $image) { ?>
                                    <input type="hidden" name="gallery_image[]" value="<?= $image['path'] ?>" />
                                <?php } ?>
        <?php } ?>
                            <input multiple="" type="file" name="gallery[]" />

                        </div>
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