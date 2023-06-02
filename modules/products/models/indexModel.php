<?php
// Lấy danh sách danh mục sản phẩm
function get_list_cat(){
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `status_cat` = '2'");
    return $result;
}

// Lấy danh sách sản phẩm theo danh mục
function get_list_product_team($cat_id){
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE (`tbl_products`.`cat_id` = '{$cat_id}') AND (`tbl_products`.`status_product` = '2')");
    return $result;
}

// Lấy danh sách sản phẩm theo nhóm giá trị
function get_product_by_value($str, $start, $num_per_page, $select){
   $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id`  WHERE (`tbl_products`.`cat_id` IN ({$str})) AND (`tbl_products`.`status_product` = '2') {$select} LIMIT {$start},{$num_per_page}");
   return $result;
}

// Lấy tổng số bản ghi theo giá trị yêu cầu
function get_num_row($str){
    $result = db_num_rows("SELECT * FROM `tbl_products` WHERE (`cat_id` IN ({$str})) AND `status_product` = '2'");
    return $result;
}

// Lấy sản phẩm theo Id
function get_product_by_id($id){
    $result = db_fetch_row("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `product_id` = '{$id}'");
    return $result;
}

// Lấy sản phẩm theo giá trị tìm kiếm
function get_product_by_search($value, $select){
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_products`.`product_name` LIKE '%{$value}%' OR `tbl_products`.`product_description` LIKE '%{$value}%' OR `tbl_products`.`product_detail` LIKE '%{$value}%' AND (`tbl_products`.`status_product` = '2')  {$select}");
    return $result;
}

// Lấy sản phẩm nổi bật 
function get_product_featured(){
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE (`tbl_products`.`product_price` > '20000000') AND `tbl_products`.`status_product` = '2'");
    return $result;
}

// Lấy danh sách chi tiết hình ảnh của sản phẩm
function get_list_image_detail($id){
    $result = db_fetch_array("SELECT * FROM `tbl_image` WHERE `product_id` = '{$id}'");
    return $result;
}