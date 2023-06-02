<?php
get_header();
?>
<div id="main-content-wp" class="cart-page">
  <div class="section" id="breadcrumb-wp">
    <div class="wp-inner">
      <div class="section-detail">
        <div class="success-message">
          <div class="">
            <span class="text-success display-4">
              <i class="fa-solid fa-circle-check"></i>
            </span>
          </div>
          <h2 class="mt-2">Đặt hàng thành công!</h2>
          <p class="h5">Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được gửi thành công.</p>
          <h3 class="text-left my-3 h6 text-info">Thông tin khách hàng</h3>
           <table class="table table-bordered">
            <thead class="table-success">
              <th scope="col">Tên khách hàng</th>
              <th scope="col">Địa chỉ</th>
              <th scope="col">Số điện thoại</th>
              <th scope="col">Số lượng sản phẩm</th>
              <th scope="col">Tổng hóa đơn</th>
              <th scope="col">Hình thức thanh toán</th>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $order['fullname'];?></td>
                <td><?php echo $order['address'];?></td>
                <td><?php echo $order['phone_number'];?></td>
                <td><?php echo $order['num_order'];?></td>
                <td><?php echo currency_format($order['total_money']);?></td>
                <td><?php echo render_status($order['pay_method']);?></td>
              </tr>
            </tbody>
           </table>
           <h3 class="text-left mt-5 mb-3 h6 text-info">Chi tiết đơn hàng</h3>
           <table class="table table-bordered">
            <thead class="table-success">
              <th>Mã sản phẩm</th>
              <th>Ảnh sản phẩm</th>
              <th>Tên sản phẩm</th>
              <th>Số lượng</th>
              <th>Giá sản phẩm</th>
            </thead>
            <tbody>
              <?php 
              foreach($list_product as $item){
              ?>
              <tr>
                <td><?php echo $item['code'] ?></td>
                <td style="width:120px;"><img src="<?php echo "admin/".$item['thumb']; ?>" alt="" class="img-fluid img-thumbnail"></td>
                <td><?php echo $item['title'];?></td>
                <td><?php echo $item['qty'];?></td>
                <td><?php echo currency_format($item['sub_total']);?></td>
              </tr>
              <?php
              }
              ?>
            </tbody>
           </table>
          <p class="mt-3 h6">Nếu có cung cấp email vui lòng <a href="https://<?php echo $order['email']?>"> kiểm tra email</a> để xem thông tin chi tiết về đơn hàng.</p>
          <p class="h6">Mọi thắc mắc xin hãy gọi về đường dây nóng chúng tôi <span class="text-danger">hottline: 09876543211 </span> để được hổ trợ kịp thời. Xin cảm ơn quý khách đã tin tưởng và ủng hộ!</p>
          <p><a href="?" class="h6">Quay lại trang chủ</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
get_footer();
?>