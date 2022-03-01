<?php 
session_start();
error_reporting(0);
$conn=mysqli_connect("localhost","root","","petshop");
mysqli_query($conn,'SET NAMES "utf8"'); // hiển thị tiếng việt
$sql="select * from orders";
$kq=mysqli_query($conn,$sql);
 //$a=$_GET['export_excel'];
$output='';
//if (isset($a)) {
$output.='<span style="color: black;font-size:24px">Cửa hàng thú cưng PETSHOP</span><br>
<span style="color: black;font-size:24px">MÃ SỐ THUẾ:1221343444</span><br>
<span style="color: black;font-size:24px">ĐIA CHỈ: 16 LẠC TRUNG, HAI BÀ TRƯNG, HÀ NỘI</span><br>
<br><br><style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>';

    if (mysqli_num_rows($kq)) {
        $output.='<table>
            <tr>
           
           
                <th style="background: orange;">Số TT</th>
                <th style="background: orange;">ID</th>
                <th style="background: orange;">Tên khách hàng</th>
                <th style="background: orange;">Số điện thoại</th>
                <th style="background: orange;">Địa chỉ</th>

                <th style="background: orange;">Sản phẩm đã mua</th>
                <th style="background: orange;">Thanh toán</th>
                <th style="background: orange;">Tổng hóa đơn</th>
            </tr>';
            $i=1;
        while($hang=mysqli_fetch_object($kq))
        {

            $sql1="select * from order_detail where order_id = ".$hang->id;
            $kq1=mysqli_query($conn,$sql1);
            // $detail = mysqli_fetch_object($kq1);

           $thanhtoan = "";
            if ($hang->status == 1) {
                $thanhtoan = "Yes";
            }else $thanhtoan = "No";
            $sql2="select * from user where id = ".$hang->userID;
            $kq2=mysqli_query($conn,$sql2);
            $user = mysqli_fetch_object($kq2);
$chitietdonhang = "";
             while($donhang=mysqli_fetch_object($kq1))
            {
                
                $sql3="select * from post where id = ".$donhang->post_id;
                $kq3=mysqli_query($conn,$sql3);
                $donhang1=mysqli_fetch_object($kq3);
                $chitietdonhang = $chitietdonhang.$donhang1->kind." - ".$donhang->quantity." . ";
            }

            $output.='
            <tr>
             
                 <td style="background: #ccc;">'.$i.'</td>
                <td style="background: #ccc;">'.$hang->id.'</td>
                <td style="background: #ccc;">'.$user->username.'</td>
               <td style="background: #ccc;">'.$user->sodienthoai.'</td>
                <td style="background: #ccc;">'.$user->diachi.'</td>
               
                
                <td style="background: #ccc;">'.$chitietdonhang.'</td>
                <td style="background: #ccc;">'.$thanhtoan.'</td>
                <td style="background: #ccc;">'.number_format($hang->total,0,",",".").' đ</td>  
            </tr>
            ';
            $i++;
        }
        $output.='</table></center>';

        header("Content-Type:application/xls");
        header("Content-Disposition: attachment; filename=download.xls");
        echo $output;
    }

//}
 ?>