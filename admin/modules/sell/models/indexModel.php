<?php

// ========= ĐƠN HÀNG ==========
// Lấy danh sách đơn hàng

use Aws\Common\Enum\Time;

function get_list_order(){
    $result = db_fetch_array("SELECT *, `tbl_orders_status`.`status_name`, `tbl_orders_status`.`status_tag` FROM `tbl_order` JOIN `tbl_orders_status` ON `tbl_order`.`status_id` = `tbl_orders_status`.`status_id`");
    return $result;
}

// Lấy số lượng đơn hàng thành công
function get_order_success(){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE `status_id` = '5'");
    return $result;
}

// Lấy doanh thu 
function get_sales_orders(){
    $result = db_query("SELECT SUM(`total_money`) FROM `tbl_order` WHERE `status_id` = '5'");
    $row = $result->fetch_assoc();
    $result->free();
    $total = $row['SUM(`total_money`)'];
    return $total;
}


// Lấy số lượng đơn hàng đang xử lí
function get_order_processing(){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE `status_id` IN (3, 4)");
    return $result;
}

// Lấy số lượng đơn hàng bị hủy, thất bại
function get_order_failure(){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE `status_id` IN (6, 7)");
    return $result;
}

// Lấy tổng số lượng đơn hàng
function get_total_order(){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE  `status_id` IN (1, 2, 3, 4, 5, 6, 7, 8)");
    return $result;
}

// Lấy các đơn hàng theo trang
function list_order_in_page($start, $num_per_page){
    $result = db_fetch_array("SELECT *, `tbl_orders_status`.`status_name`, `tbl_orders_status`.`status_tag` FROM `tbl_order` LEFT JOIN `tbl_orders_status` ON `tbl_order`.`status_id` = `tbl_orders_status`.`status_id` WHERE `tbl_order`.`status_id` IN (1, 2, 3, 4, 5, 6, 7, 8) LIMIT {$start}, {$num_per_page} ");
    return $result;
}

// Lấy đơn hàng theo Id
function get_order_by_id($id){
    $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_id` = '{$id}'");
    return $result;
}

// Lấy danh sách chi tiết của đơn hàng
function get_detail_order($id){
    $result = db_fetch_array("SELECT * FROM `tbl_order_detail` LEFT JOIN `tbl_products` ON `tbl_order_detail`.`product_id` = `tbl_products`.`product_id` WHERE `tbl_order_detail`.`order_id` = '{$id}'");
    return $result;
}

// Lấy danh sách các trạng thái của đơn hàng
function get_status_order(){
    $result = db_fetch_array("SELECT * FROM `tbl_orders_status`");
    return $result;
}

// Cập nhật trạng thái đơn hàng
function update_status_order_by_id($data, $order_id){
    $result = db_update("tbl_order", $data, "`order_id` = '{$order_id}'");
    return $result;
}

// Cập nhật trạng thái các đơn hàng được chọn
function update_status_orders_by_check($data, $where){
   $result = db_update("tbl_order", $data, "`order_id` IN ($where)");
   return $result;
}

// Lấy đơn hàng trong thùng rác 
function get_orders_trash(){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE `status_id` = '9'");
    return $result;
}

// Lấy đơn hàng chờ xác nhận
function get_order_confirmation(){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE `status_id` = '1'");
    return $result;
}

// Lấy danh sách đơn hàng trong thùng rác
function get_list_orders_trash($start, $num_per_page){
    $result = db_fetch_array("SELECT * FROM `tbl_order` WHERE `status_id` = '9' LIMIT {$start}, $num_per_page");
    return $result;
}

// Đem đơn hàng vào thùng rác
function order_in_the_trash($id){
    $data = array(
        'status_id' => 9,
    );
    $result = db_update("tbl_order", $data, "`order_id` = '{$id}'");
    return $result;
}

// Cập nhật thông tin khách hàng
function update_infor_customer($data, $id){
    $result = db_update("tbl_order", $data, "`order_id` = '{$id}'");
    return $result;
}

// Tổng số lượng sản phẩm trong thùng rác
function get_num_order_trash(){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE `status_id` = '9'");
    return $result;
}

// Xóa đơn hàng
function delete_order($where){
    $result = db_delete("tbl_order", $where);
    return $result;
}

// Xóa các chi tiết đơn hàng
function delete_order_detail($where){
    $result = db_delete("tbl_order_detail", $where);
    return $result;
}

// Lấy tổng số lượng đơn hàng chờ xác nhận
function get_num_order_confirm(){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE `status_id` = '1'");
    return $result;
}

// Lấy danh sách đơn hàng chờ xác nhận
function get_list_order_confirm($start, $num_per_page){
    $result = db_fetch_array("SELECT * FROM `tbl_order` WHERE `status_id` = '1' LIMIT {$start}, {$num_per_page}");
    return $result;
}

// Xác nhận những đơn hàng được chọn
function update_order_confirm($data, $str_id_order){
    $result = db_update("tbl_order", $data, "`order_id` IN ({$str_id_order})");
    return $result;
}


// Tìm đơn hàng theo từ khóa
function get_order_by_key($key, $start, $num_per_page){
    $result = db_fetch_array("SELECT *, `tbl_orders_status`.`status_name`, `tbl_orders_status`.`status_tag` FROM `tbl_order` LEFT JOIN `tbl_orders_status` ON `tbl_order`.`status_id` = `tbl_orders_status`.`status_id` WHERE (`tbl_order`.`address` LIKE '%{$key}%' OR `tbl_order`.`fullname` LIKE '%{$key}%' OR `tbl_order`.`phone_number` LIKE '%{$key}%') AND NOT (`tbl_order`.`status_id` = '9') LIMIT {$start}, {$num_per_page}");
    return $result;
}

// Tổng đơn hàng tìm kiếm được 
function get_total_order_by_key($key){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE (`fullname` LIKE '%{$key}%' OR `address` LIKE '%{$key}%' OR `phone_number` LIKE '%{$key}%') AND NOT `status_id` = '9'");
    return $result;
}


// =============== KHÁCH HÀNG =============

// Lấy tổng khách hàng trong hệ thống
function get_total_customer(){
   $result = db_num_rows("SELECT * FROM `tbl_order` GROUP BY `fullname`, `phone_number`, `address`");
   return $result;
}

// Lấy danh sách khách hàng
function get_list_customer($start, $num_per_page){
    $result = db_fetch_array("SELECT *, COUNT(*) AS `total_num` FROM `tbl_order` GROUP BY `fullname`, `phone_number`, `address` ORDER BY `order_date` ASC LIMIT {$start}, {$num_per_page}");
    return $result;
}

// Tìm kiếm khách hàng theo dữ liệu đã cho
function search_customer_by_data($data){
    $result = db_fetch_array("SELECT *, COUNT(*) AS `total_num` FROM `tbl_order` WHERE `fullname` LIKE '%{$data}%' OR `address` LIKE '%{$data}%' OR `email` LIKE '%{$data}%' OR `phone_number` LIKE '%{$data}%' OR `code_orders` LIKE '%{$data}%' GROUP BY `fullname`, `phone_number`, `address` ORDER BY `order_date` ASC ");
    return $result;
}

// Cập nhật thông tin khách hàng theo Group By
function update_info_customer_group_by($data, $where){
    $result = db_update("tbl_order", $data, $where);
    return $result;
}

// Lấy đơn hành theo thời gian gần nhất
function get_order_day_ago($date){
    $result = db_fetch_array("SELECT * FROM `tbl_order` WHERE `order_date` > '{$date}' AND `status_id` = '5'");
    return $result;
}

// Lấy doanh thu theo thời gian xác định
function get_sales_day_ago($time){
    $result = db_query("SELECT SUM(`total_money`) AS `total` FROM `tbl_order` WHERE `order_date` > '{$time}' AND `status_id` = '5'");
    $query_result = $result->fetch_assoc();
    return $query_result['total'];
}

// Lấy danh sách khách hàng trong nhóm ngày theo yêu cầu
function get_list_customer_by_day($past_time, $start, $num_per_page){
    $result = db_fetch_array("SELECT *, COUNT(*) AS `number_of` FROM `tbl_order` WHERE (`order_date` > '{$past_time}' OR `order_date` = '{$past_time}') GROUP BY `fullname`, `address`, `phone_number` ORDER BY `order_date` ASC LIMIT {$start}, {$num_per_page}");
    return $result;
}

// Lấy tổng số khách hàng trong nhóm ngày theo yêu cầu
function get_total_customer_by_day($past_time){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE (`order_date` > '{$past_time}') GROUP BY `fullname`, `address`, `phone_number`");
    return $result;
}

// Lấy danh sách khách hàng tiềm năng
function get_customer_potential($past_time){
    // Lấy danh sách khách hàng trong 10 ngày gần đây 
    // Có số lượng đơn hàng từ 2 đơn trở lên
    $result = db_fetch_array("SELECT *, COUNT(*) AS `number_of` FROM `tbl_order`  WHERE (`order_date` > '{$past_time}')  GROUP BY `fullname`, `address`, `phone_number` HAVING COUNT(*) > '1'");
    return $result;
}