<?php

// Thêm sản phẩm vào CSDL
function add_product($data){
    $result = db_insert("tbl_products", $data);
    return $result;
}

// Lấy danh sách sản phẩm
function get_list_product(){
    $list_product = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` LEFT JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id`");
    return $list_product;
}

function get_product_by_id($id){
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = '{$id}'");
    return $result;
}

function update_product($data, $id){
    $result = db_update("tbl_products", $data, "`product_id` = '{$id}'");
    return $result;
}

// Xóa sản phẩm theo Id
function delete_product_by_id($id){
    $result = db_delete("tbl_products", "`product_id` = '{$id}'");
    return $result;
}

// Lấy danh sách bản ghi theo trang
function get_product_by_page($start, $num_per_page){
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` LEFT JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE (NOT `tbl_products`.`status_product` = '4')  GROUP BY `product_time` LIMIT {$start}, {$num_per_page}");
    return $result;
}

// Tổng số bản ghi của sản phẩm
function get_total_row(){
    $result = db_num_rows("SELECT * FROM `tbl_products` WHERE NOT `status_product` = '4'");
    return $result;
}

// Lấy sản phẩm theo danh mục
function get_product_by_cat($cat_id, $start, $num_per_page){
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_products`.`cat_id` = '{$cat_id}' LIMIT {$start}, {$num_per_page}");
    return $result;
}

// Thêm danh mục vào CSDL
function add_cat_product($data){
    $result = db_insert("tbl_product_cat", $data);
    return $result;
}

// Lấy tất cả danh mục sản phẩm
function get_cat_products(){
    $list_cat = db_fetch_array("SELECT * FROM  `tbl_product_cat` WHERE NOT `status_cat` = '4'");
    return $list_cat;
}

// Lấy một danh mục sản phẩm
function get_cat_by_id($id){
    $result = db_fetch_row("SELECT * FROM `tbl_product_cat` WHERE `cat_id` = '{$id}'");
    return $result;
}

// Cập nhật danh mục
function update_cat_product($data, $id){
   $result = db_update("tbl_product_cat", $data, "`cat_id` = '{$id}'");
   return $result;
}


// Tìm kiếm sản phẩm theo key
function search_product($key, $start, $num_per_page){
     $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_products`.`product_name` LIKE '%{$key}%' OR `tbl_products`.`product_description` LIKE '%{$key}%' ORDER BY `tbl_products`.`product_time` ASC LIMIT {$start}, {$num_per_page} ");
     return $result;
}


function get_num_row_search($key){
    $result = db_num_rows("SELECT * FROM `tbl_products` WHERE `product_name` LIKE '%{$key}%' OR `product_description` LIKE '%{$key}%' ");
    return $result;
}

// Lấy tổng số bản ghi theo danh mục
function get_total_row_cat($category){
    $result = db_num_rows("SELECT * FROM `tbl_products` WHERE `cat_id` = '{$category}'");
    return $result;
}

// Thêm hình ảnh chi tiết sản phẩm vào CSDL
function add_picture_detail($data){
    $result = db_insert("tbl_image", $data);
    return $result;
}

// Cập nhật trạng thái sản phẩm theo Products Select
function update_status_product($request, $str_id){
    $data = array(
        'status_product' => $request,
    );
    $result = db_update("tbl_products", $data, "`product_id` IN ({$str_id})");
    return $result;
}

// Xóa sản phẩm theo lựa chọn
function delete_product_by_select($str_id){
    $result = db_delete("tbl_products", "`product_id` IN ({$str_id})");
    return $result;
}

// Đưa sản phẩm vào thùng rác
function add_product_trash($id){
    $data = array(
        'status_product' => 4,
    );
    $result = db_update("tbl_products", $data, "`product_id` = '{$id}'");
    return $result;
}

// Lấy danh sách sản phẩm chờ xác nhận
function get_product_confirm(){
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` LEFT JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE (`tbl_products`.`status_product` = '1') ORDER BY `tbl_products`.`product_time` ASC ");
    return $result;
}

// Tổng sản phẩm chờ xét duyệt
function get_num_product_confirm(){
    $result = db_num_rows("SELECT * FROM `tbl_products` WHERE `status_product` = '1'");
    return $result;
}

// Tổng số sản phẩm hết hàng
function get_num_product_empty(){
    $result = db_num_rows("SELECT * FROM `tbl_products` WHERE `status_product` = '3'");
    return $result;
}

// Tổng số sản phẩm trong thùng rác
function get_num_product_trash(){
    $result = db_num_rows("SELECT * FROM `tbl_products` WHERE `status_product` = '4'");
    return $result;
}

// Lấy danh sách sản phẩm hết hàng
function get_product_out_of_stock(){
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` LEFT JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE (`tbl_products`.`status_product` = '3') ORDER BY `tbl_products`.`product_time` ASC ");
    return $result;
}

// Lấy sản phẩm trong thùng rác
function get_product_trash(){
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` LEFT JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE (`tbl_products`.`status_product` = '4') ORDER BY `tbl_products`.`product_time` ASC ");
    return $result;
}

// Cập nhật trạng thái cho chuỗi danh mục sản phẩm
function update_status_list_cat_product($data, $str_id){
    $result = db_update("tbl_product_cat", $data, "`cat_id` IN ({$str_id})");
    return $result;
}

// Lấy tổng danh mục đang nằm trong thùng rác
function get_num_cat_trash(){
    $result = db_num_rows("SELECT * FROM `tbl_product_cat` WHERE `status_cat` = '4'");
    return $result;
}

// Đưa danh mục vào thùng rác
function out_of_trash_cat($id){
    $data = array(
        'status_cat' => 4,
    );
    $result = db_update("tbl_product_cat", $data, "`cat_id` = '{$id}'");
    return $result;
}

// Lấy danh mục đang trong thùng rác
function get_cat_product_in_trash(){
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `status_cat` = '4'");
    return $result;
}

// Đưa danh mục tái hoạt động
function reuse_cat($id){
    $data= array(
        'status_cat' => 1,
    );
    $result = db_update("tbl_product_cat", $data, "`cat_id` = '{$id}'");
    return $result;
}
?>