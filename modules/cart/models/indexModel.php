<?php
// Lấy dữ liệu dựa trên id
function get_product_by_id($id){
    $result = db_fetch_row("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_products`.`product_id` = '{$id}'");
    return $result;
}

// Cập nhật đơn hàng vào CSDDL
function add_order($data){
    $result = db_insert("tbl_order", $data);
    return $result;
}

// Cập nhật chi tiết đơn hàng vào CSDL
function add_order_detail($data){
    $result = db_insert("tbl_order_detail", $data);
    return $result;
}

// Lấy đơn hàng theo Id
function get_order_by_id($id){
   $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_id` = '{$id}'");
   return $result;
}

// Lấy danh sách tỉnh thành phố
function get_list_province(){
    $result = db_fetch_array("SELECT * FROM `tbl_province`");
    return $result;
}

// Lấy danh sách quận huyện theo id
function get_list_district($province_id){
    $result = db_fetch_array("SELECT * FROM `tbl_district` WHERE `province_id` = '{$province_id}'");
    return $result;
}

// Lấy danh sách xã phường
function get_list_wards($district_id){
    $result = db_fetch_array("SELECT * FROM `tbl_wards` WHERE `district_id` = '{$district_id}'");
    return $result;
}

// Lấy tên tỉnh thành phố theo id
function get_province_name($province_id){
    $result = db_fetch_row("SELECT * FROM `tbl_province` WHERE `province_id` = '{$province_id}'");
    return $result['name'];
}

// Lấy tên quận huyện
function get_district_name($district_id){
    $result = db_fetch_row("SELECT * FROM `tbl_district` WHERE `district_id` = '{$district_id}'");
    return $result['name'];
}

// Lấy tên xã phường
function get_wards_name($wards_id){
    $result = db_fetch_row("SELECT * FROM `tbl_wards` WHERE `wards_id` = '{$wards_id}'");
    return $result['name'];
}