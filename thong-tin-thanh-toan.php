<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
  #menu{
    width: 1000px;
    height: 40px;
    background-color: #4CAF50;
    margin: 5px auto;
    font-size: 13px;
}

#menu ul{
    list-style-type: none;
    background-color: #4CAF50;
    text-align: center;


}

#menu ul li{
    color: #FFFF;
    float: left;
    display: inline-table;
    width: 100px;
    height: 40px;
    line-height: 40px;
    position: relative;
    z-index: 1;

}

#menu ul li a{

    color: #FFFF;
    text-decoration: none;
    display: block;


}

#menu ul li a:hover{
    background-color: #2aedcf;


}

#menu ul li > .sub-menu{
    display: none;
    position: absolute;
    text-align: left;
    width: 170px;
    text-indent: 5px;


}

#menu ul li:hover .sub-menu{
    display: block;
}
body {
  font-family: Arial;
  font-size: 15px;
  padding: 8px;
  width: 1000px;
  margin-left: 120px;
}
  #footer{
      color: #000000;
      text-align: center;
      background-color: #45a049;
      min-height: 27px;
      line-height: 27px;
      clear: both;
      opacity: 0.7;
      border-radius: 4px;
  }
* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 5%; /* IE10 */
  flex: 5%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 30%; /* IE10 */
  flex: 30%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  margin-bottom: 50px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: orange;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>

</head>
<body>
  <div style="background-image:url(image/HomeBanner-smaller_1800x.gif);
  height:250px;
  width: 1000px;
  overflow: auto;
  background-size:cover;
  background-position:center center;
  margin-bottom: 5px;
  "></div>

        <!-- dang nhap -->


          <?php
          $voucher = NULL;
          $resultVoucher = NULL;
          $valueVoucher = NULL;
          $thanhtien = NULL;
            if (!empty($_SESSION['current_user'])) {
              echo '<a ><img src="image/petFood.png" width="15">';
              echo " " .$_SESSION['current_user'];
              echo '<ul class="sub-menu">';
                if (!empty($_SESSION['current_admin']) && $_SESSION['current_admin'] == 1) {
//                echo '<a href="./admin/xem-san-pham.php">Quản trị</a>';
              }
              ?>

              </div>

              <script>
              function openForm() {
                document.getElementById("myForm").style.display = "block";
              }

              function closeForm() {
                document.getElementById("myForm").style.display = "none";
              }
              function login() {

                // alert("Đăng nhập thành công !");

              }
              </script>
              </ul>
          <?php
            }else{
              echo '<a href="./Sign-In-Sign-Up-Form/index.html"><img src="image/petFood.png" width="15">';
             echo " Đăng nhập";
            }

          ?>

        </a>


      </li>

<!--      <li>-->
<!--        <a style="z-index: -1;" href="addCart.php?id=--><?php //echo $_SESSION['current_user'] ?><!--">  Giỏ hàng </a>-->
<!--      </li>-->
    </ul>
  </div>
 <body>

 <?php

        if (empty($_SESSION['current_user'])) {
            echo "<script>alert('Mời bạn đăng nhập để sử dụng chức năng!');
                location.href='Sign-In-Sign-Up-Form/index.html'</script>";
        }

        if ($_SESSION["cart"] == NULL) {
          echo "<script>alert('Mời bạn chọn sản phẩm để mua!');
                location.href='index.php'</script>";
        }
       include './config.php';
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }
        $user_name = $_SESSION['current_user'];
         $user1 = mysqli_query($conn, "SELECT * FROM `user` WHERE `username` = '$user_name'");
        $rowUser =  mysqli_fetch_array($user1);

        $userID = $rowUser['id'];
        $error = false;
        $success = false;
        if (isset($_GET['action'])) {

            function update_cart($add = false) {
                foreach ($_POST['quantity'] as $id => $quantity) {
                    if ($quantity == 0) {
                        unset($_SESSION["cart"][$id]);
                    } else {
                        if ($add) {
                            $_SESSION["cart"][$id] += $quantity;
                        } else {
                            $_SESSION["cart"][$id] = $quantity;
                        }
                    }
                }
            }

            switch ($_GET['action']) {
                case "add":
                    update_cart(true);
                    header('Location: ./addCart.php');
                    break;
                case "delete":
                    if (isset($_GET['id'])) {
                        unset($_SESSION["cart"][$_GET['id']]);
                    }
                    header('Location: ./addCart.php');
                    break;
                case "submit":
                    // if (isset($_POST['update_click'])) { //Cập nhật số lượng sản phẩm
                    //     update_cart();
                    //     header('Location: ./addCart.php');
                    if (!empty($_POST['order_click']) && $_POST['order_click']) { //Đặt hàng sản phẩm

                        if (empty($_POST['name'])) {
                            $error = "Bạn chưa nhập tên của người nhận";
                        } elseif (empty($_POST['phone'])) {
                            $error = "Bạn chưa nhập số điện thoại người nhận";
                        } elseif (empty($_POST['address'])) {
                            $error = "Bạn chưa nhập địa chỉ người nhận";
                        } elseif (empty($_POST['quantity'])) {
                            $error = "Giỏ hàng rỗng";
                        }
                        if ($error == false && !empty($_POST['quantity'])) { //Xử lý lưu giỏ hàng vào d

                            $products = mysqli_query($conn, "SELECT * FROM `post` WHERE `id` IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
                            $total = 0;
                            $orderProducts = array();
                            while ($row = mysqli_fetch_array($products)) {
                                $orderProducts[] = $row;
                                $total += $row['price'] * $_POST['quantity'][$row['id']];

                            }
                            // if ($thanhtien !=NULL) {
                            //       $total = $thanhtien;
                            //     }
                            if (!empty($_SESSION['thanhtien'])) {
                                  $total = $_SESSION['thanhtien'];
                                }
                            $insertOrder = mysqli_query($conn, "INSERT INTO `orders` (`id`, `userID`, `note`, `total`, `created_time`, `last_updated`) VALUES (NULL, '" . $userID . "', '', '" . $total . "', '" . time() . "', '" . time() . "');");
                            $orderID = $conn->insert_id;
                            $insertString = "";
                            foreach ($orderProducts as $key => $product) {
                                $insertString .= "(NULL, '" . $orderID . "', '" . $product['id'] . "', '" . $_POST['quantity'][$product['id']] . "', '" . $product['price'] . "', '" . time() . "', '" . time() . "')";
                                if ($key != count($orderProducts) - 1) {
                                    $insertString .= ",";
                                }
                            }
                            $insertOrder = mysqli_query($conn, "INSERT INTO `order_detail` (`id`, `order_id`, `post_id`, `quantity`, `price`, `created_time`, `last_updated`) VALUES " . $insertString . ";");
                            $success = "Đặt hàng thành công";
                           echo "<script>alert('Đặt hàng thành công!');
                        location.href='index.php'</script>";
                            unset($_SESSION['cart']);
                        }
                    }
                    elseif ($_POST['apply']){
                      if (empty($_POST['voucher']))
                        $resultVoucher = "Mời bạn nhập mã giảm giá!";
                      else {
                        $voucher = $_POST['voucher'];
                        $sql = "select * from vouchers where code = '$voucher'";
                         $voucherCode = mysqli_query($conn,$sql);

                            $rowVC = mysqli_fetch_array($voucherCode);
                            if ($rowVC > 0) {
                              $valueVoucher = $rowVC[1];
                            }
                            else $resultVoucher = "Mã khuyến mại không hợp lệ!";
                      }
                    }
                    break;
            }
        }
        if (!empty($_SESSION["cart"])) {
            $products = mysqli_query($conn, "SELECT * FROM `post` WHERE `id` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");

            $products1 = mysqli_query($conn, "SELECT * FROM `post` WHERE `id` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
            }
  ?>
<h2>Thông Tin Thanh Toán</h2>

<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="thong-tin-thanh-toan.php?action=submit" method="POST">

        <div class="row">
          <div class="col-50">
            <h3>Thông Tin Người Nhận</h3>

            <label for="fname"><i class="fa fa-user"></i> Họ Tên:</label>
            <input type="text" id="fname" name="name" value="<?= $rowUser['username'] ?>">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" value="<?= $rowUser['email'] ?>">
            <label for="adr"><i class="fa fa-address-card-o"></i> Địa Chỉ:</label>

            <input type="text" id="city" name="address" value="<?= $rowUser['diachi'] ?>">

            <div class="row">
              <div class="col-50">
                <label for="state">Số điện thoại</label>
                <input type="text" id="state" name="phone" value="<?= $rowUser['sodienthoai'] ?>">
              </div>

            </div>
          </div>
          <?php
  while ($row = mysqli_fetch_array($products)) {
              ?>
          <input type="hidden" value="<?= $_SESSION["cart"][$row['id']] ?>" name="quantity[<?= $row['id'] ?>]" />
        <?php }
          ?>

        </div>
       <!--  <label>
          <input type="checkbox" checked="checked" name="sameadr"> Địa
        </label> -->
        <input type="submit" name="order_click" value="Mua hàng" class="btn">

      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <h4>Giỏ hàng <span class="price" style="color:black">Số tiền <b></b></span></h4>
       <?php
      if (!empty($products1)) {
          $total = 0;
          $num = 1;
          while ($row = mysqli_fetch_array($products1)) {
              ?>
            <p><a href="#"><img style="width: 80px;" src="<?= $row['image'] ?>" /></a> <span class="price"><?= number_format($row['price'] * $_SESSION["cart"][$row['id']], 0, ",", ".") ?> đ</span></p>

            <hr>

             <?php
                $total += $row['price'] * $_SESSION["cart"][$row['id']];
                $num++;
            }
          }
            ?>
      <form action="thong-tin-thanh-toan.php?action=submit" method="POST">


      <input style="width: 230px;height: 30px;margin-right: 10px;margin-top: 10px;" type="text" name="voucher" placeholder="Nhập mã giảm giá">

      <input style="height: 30px;border-radius: 2px;background-color: orange;border: none;" type="submit" name="apply" value="Áp dụng">
      </form>
       <hr>

      <p>Tạm tính <span class="price" style="color:black"><b><?= number_format($total, 0, ",", ".")?> đ</b></span></p>
       <?php

          if ($resultVoucher != NULL) {
            echo $resultVoucher;
          }
           else{
            $tiengiam = $total * $valueVoucher;
            $thanhtien = $total - $tiengiam;
            $tiengiam = number_format($tiengiam, 0, ",", ".");
            $thanhtien1 = number_format($thanhtien, 0, ",", ".");

            echo '<p>Giảm giá: <span class = "price" style="color:black"><b>'.$tiengiam.' đ'.'</b></span></p>';
            echo '<p>Thành tiền: <span class = "price" style="color:red"><b>'.$thanhtien1.' đ'.'</b></span></p>';

            $_SESSION['thanhtien'] = $thanhtien;
           }

       ?>

    </div>
  </div>
</div>
 <div id="footer"><h4>PET SHOP THÚ CƯNG LỚN NHẤT HÀ NỘI</h4></div>
 <div id="footer">Petshop – Thương hiệu kinh doanh thú cưng, phụ kiện uy tín, chuyên nghiệp</div>
 <div id="footer">Người đại diện: Nguyễn Thị Ngọc Hiên</div>
 <div id="footer">Địa chỉ: Phố Hồng Tiến - Long Biên - Hà nội</div>


<!--               <style>-->
<!--  .suntory-alo-phone {-->
<!--    background-color: transparent;-->
<!--    cursor: pointer;-->
<!--    height: 120px;-->
<!--    position: fixed;-->
<!--    transition: visibility 0.5s ease 0s;-->
<!--    width: 120px;-->
<!--    z-index: 200000 !important;-->
<!--    top: initial !important;-->
<!--  }-->
<!--  .suntory-alo-ph-circle {-->
<!--    animation: 1.2s ease-in-out 0s normal none infinite running suntory-alo-circle-anim;-->
<!--    background-color: transparent;-->
<!--    border: 2px solid rgba(30, 30, 30, 0.4);-->
<!--    border-radius: 100%;-->
<!--    height: 100px;-->
<!--    left: 0px;-->
<!--    opacity: 0.1;-->
<!--    position: absolute;-->
<!--    top: 0px;-->
<!--    transform-origin: 50% 50% 0;-->
<!--    transition: all 0.5s ease 0s;-->
<!--    width: 100px;-->
<!--  }-->
<!--  .suntory-alo-ph-circle-fill {-->
<!--    animation: 2.3s ease-in-out 0s normal none infinite running suntory-alo-circle-fill-anim;-->
<!--    border: 2px solid transparent;-->
<!--    border-radius: 100%;-->
<!--    height: 70px;-->
<!--    left: 15px;-->
<!--    position: absolute;-->
<!--    top: 15px;-->
<!--    transform-origin: 50% 50% 0;-->
<!--    transition: all 0.5s ease 0s;-->
<!--    width: 70px;-->
<!--  }-->
<!--  .suntory-alo-ph-img-circle {-->
<!--    / animation: 1s ease-in-out 0s normal none infinite running suntory-alo-circle-img-anim; /-->
<!--    border: 2px solid transparent;-->
<!--    border-radius: 100%;-->
<!--    height: 50px;-->
<!--    left: 25px;-->
<!--    opacity: 0.7;-->
<!--    position: absolute;-->
<!--    top: 25px;-->
<!--    transform-origin: 50% 50% 0;-->
<!--    width: 50px;-->
<!--  }-->
<!--  .suntory-alo-phone.suntory-alo-hover, .suntory-alo-phone:hover {-->
<!--    opacity: 1;-->
<!--  }-->
<!--  .suntory-alo-phone.suntory-alo-active .suntory-alo-ph-circle {-->
<!--    animation: 1.1s ease-in-out 0s normal none infinite running suntory-alo-circle-anim !important;-->
<!--  }-->
<!--  .suntory-alo-phone.suntory-alo-static .suntory-alo-ph-circle {-->
<!--    animation: 2.2s ease-in-out 0s normal none infinite running suntory-alo-circle-anim !important;-->
<!--  }-->
<!--  .suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-circle, .suntory-alo-phone:hover .suntory-alo-ph-circle {-->
<!--    border-color: #00aff2;-->
<!--    opacity: 0.5;-->
<!--  }-->
<!--  .suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-circle, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-circle {-->
<!--    border-color: #EB278D;-->
<!--    opacity: 1;-->
<!--  }-->
<!--  .suntory-alo-phone.suntory-alo-green .suntory-alo-ph-circle {-->
<!--    border-color: #bfebfc;-->
<!--    opacity: 1;-->
<!--  }-->
<!--  .suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-circle-fill, .suntory-alo-phone:hover .suntory-alo-ph-circle-fill {-->
<!--    background-color: rgba(0, 175, 242, 0.9);-->
<!--  }-->
<!--  .suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-circle-fill, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-circle-fill {-->
<!--    background-color: #EB278D;-->
<!--  }-->
<!--  .suntory-alo-phone.suntory-alo-green .suntory-alo-ph-circle-fill {-->
<!--    background-color: rgba(0, 175, 242, 0.9);-->
<!--  }-->
<!---->
<!--  .suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-img-circle, .suntory-alo-phone:hover .suntory-alo-ph-img-circle {-->
<!--    background-color: #00aff2;-->
<!--  }-->
<!--  .suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-img-circle, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-img-circle {-->
<!--    background-color: #EB278D;-->
<!--  }-->
<!--  .suntory-alo-phone.suntory-alo-green .suntory-alo-ph-img-circle {-->
<!--    background-color: #00aff2;-->
<!--  }-->
<!--  @keyframes suntory-alo-circle-anim {-->
<!--    0% {-->
<!--      opacity: 0.1;-->
<!--      transform: rotate(0deg) scale(0.5) skew(1deg);-->
<!--    }-->
<!--    30% {-->
<!--      opacity: 0.5;-->
<!--      transform: rotate(0deg) scale(0.7) skew(1deg);-->
<!--    }-->
<!--    100% {-->
<!--      opacity: 0.6;-->
<!--      transform: rotate(0deg) scale(1) skew(1deg);-->
<!--    }-->
<!--  }-->
<!---->
<!--  @keyframes suntory-alo-circle-img-anim {-->
<!--    0% {-->
<!--      transform: rotate(0deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    10% {-->
<!--      transform: rotate(-25deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    20% {-->
<!--      transform: rotate(25deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    30% {-->
<!--      transform: rotate(-25deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    40% {-->
<!--      transform: rotate(25deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    50% {-->
<!--      transform: rotate(0deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    100% {-->
<!--      transform: rotate(0deg) scale(1) skew(1deg);-->
<!--    }-->
<!--  }-->
<!--  @keyframes suntory-alo-circle-fill-anim {-->
<!--    0% {-->
<!--      opacity: 0.2;-->
<!--      transform: rotate(0deg) scale(0.7) skew(1deg);-->
<!--    }-->
<!--    50% {-->
<!--      opacity: 0.2;-->
<!--      transform: rotate(0deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    100% {-->
<!--      opacity: 0.2;-->
<!--      transform: rotate(0deg) scale(0.7) skew(1deg);-->
<!--    }-->
<!--  }-->
<!--  .suntory-alo-ph-img-circle i {-->
<!--    animation: 1s ease-in-out 0s normal none infinite running suntory-alo-circle-img-anim;-->
<!--    font-size: 30px;-->
<!--    line-height: 50px;-->
<!--    padding-left: 13px;-->
<!--    color: #fff;-->
<!--  }-->
<!---->
<!--  /*=================== End phone ring ===============*/-->
<!--  @keyframes suntory-alo-ring-ring {-->
<!--    0% {-->
<!--      transform: rotate(0deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    10% {-->
<!--      transform: rotate(-25deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    20% {-->
<!--      transform: rotate(25deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    30% {-->
<!--      transform: rotate(-25deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    40% {-->
<!--      transform: rotate(25deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    50% {-->
<!--      transform: rotate(0deg) scale(1) skew(1deg);-->
<!--    }-->
<!--    100% {-->
<!--      transform: rotate(0deg) scale(1) skew(1deg);-->
<!--    }-->
<!--  }-->
<!--</style>-->
<!--<a href="tel:0375259646" class="suntory-alo-phone suntory-alo-green" id="suntory-alo-phoneIcon" style="left: 0px; bottom: 0px;">-->
<!--  <div class="suntory-alo-ph-circle"></div>-->
<!--  <div class="suntory-alo-ph-circle-fill"></div>-->
<!--  <div class="suntory-alo-ph-img-circle"><i class="fa fa-phone"></i></div>-->
<!--</a>-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
// s1.src='https://embed.tawk.to/5f9fbbce520b4b7986a06403/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
</body>
</html>
