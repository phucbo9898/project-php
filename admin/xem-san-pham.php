
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
    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $kind = $_POST['kind'];
    }
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($kind)){
        $totalRecords = mysqli_query($conn, "select * from post where kind like '%$kind%'");
    }else{
        $totalRecords = mysqli_query($conn, "SELECT * FROM `post`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($kind)){
        $products = mysqli_query($conn, "select * from post where kind like '%$kind%' ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $products = mysqli_query($conn, "SELECT * FROM `post` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($conn);
}else echo "<script>alert('Bạn chưa đăng nhập!');
                location.href='../Sign-In-Sign-Up-Form/index.html'</script>";;
    ?>
    <?php
          include('./menu.php');
          ?>
                <div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                      <!--   <p class="right__desc">Bảng điều khiển</p> -->

                        <p class="right__desc">Xem sản phẩm</p>
                        <div class="right__table">
                           
                             <div class="listing-search">
                                <form id="<?=$config_name?>-search-form" action="xem-san-pham.php?action=search" method="POST">
                                    <fieldset>
                                       
                                      <!--   ID: <input type="text" name="id" value="<?=!empty($id)?$id:""?>" /> -->
                        Tên <?=$config_title?>: <input type="text" name="kind" />
                                        <!-- <input type="submit" value="Tìm" /> -->
                                        <button type="submit">Tìm</button>

                                    </fieldset>
                                   
                                </form>
                            </div>
                             <div class="total-items">
                                <span>Có tất cả <strong><?=$totalRecords?></strong> <?=$config_title?> trên <strong><?=$totalPages?></strong> trang</span>
                            </div>
                            <div class="right__tableWrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tiêu Đề</th>
                                            <th>Hình ảnh</th>
                                            <th>Giá SP</th>
                                            <th>Giống</th>
                                            <!--  <th>Địa chỉ</th> -->
                                           <th>Tuổi</th>
                                            <th>Thời gian về</th>

                                            <th>Copy</th>
                                            <th>Sửa</th>
                                            <th>Xoá</th>
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

                            <?php
                            $string = strip_tags($row['title']);
                            if (strlen($string) > 40) {

                                // truncate string
                                $stringCut = substr($string, 0, 40);
                                $endPoint = strrpos($stringCut, ' ');

                                //if the string doesn't contain any space then it will cut without word basis.
                                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                $string .= '... ';
                            }
                          
                            ?>

                          <td ><?= $string ?></td>



                            <td id="anhsp"><img src="../<?= $row['image'] ?>" alt="<?= $row['kind'] ?>" title="<?= $row['kind'] ?>"/></td>
                            <td><?=number_format(($row['price']),0,",",".")  ?></td>
                           
                            <td><?= $row['kind'] ?></td>
                           
                         <!--    <td><?= $row['address'] ?></td>  -->
                            <td><?= $row['age'] ?></td>
                            <td><?= date('d/m/Y H:i', $row['created_time']) ?></td>

                            
                       <td data-label="copy" class="right__iconTable"><a href="./cap-nhat-san-pham.php?id=<?= $row['id'].'&task=copy' ?>"><img src="assets/copy.png" alt=""></a></td>
                            
                          

                            <td data-label="Sửa" class="right__iconTable"><a href="./cap-nhat-san-pham.php?id=<?= $row['id'] ?>"><img src="assets/icon-edit.svg" alt=""></a></td>
                            <td data-label="Xoá" class="right__iconTable"><a href="./<?=$config_name?>_delete.php?id=<?= $row['id'] ?>"><img src="assets/icon-trash-black.svg" alt=""></a></td>
                        </tr>
                 <?php } ?>

                                </table>
                                <?php
            include './pagination.php';
            ?>
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
