<?php
// Lấy danh mục sản phẩm
function get_cat_product(){
    // TC: Danh mục status hoạt động 
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `status_cat` = '2'");
    return $result;
}

// Lấy danh sách sản phẩm
function get_list_product(){
    // TC: Sản phẩm được duyệt, 
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_products`.`status_product` = '2'");
    return $result;
}

// Lấy danh sách slider (slider ở trạng thái cho phép)
function get_list_slider(){
    // TC: slider công khai và sắp theo thứ tự
    $result = db_fetch_array("SELECT * FROM `tbl_slider` WHERE `status` = '2' ORDER BY `num` ASC");
    return $result;
}

// Lấy sản phẩm nổi bật 
function get_product_featured(){
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE (`tbl_products`.`product_price` > '20000000') AND `tbl_products`.`status_product` = '2'");
    return $result;
}

// Lấy danh sách sản phẩm nổi bật
function get_list_product_sell(){
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_products`.`product_price` > '20000000' AND `tbl_products`.`cat_id` IN (1, 3, 5, 6)");
    return $result;
}

// Lấy tất cả sản phẩm thuộc chuỗi danh mục
function get_list_product_by_str($str){
    $result = db_fetch_array("SELECT *, `tbl_product_cat`.`cat_name` FROM `tbl_products` JOIN `tbl_product_cat` ON `tbl_products`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_products`.`status_product` = '2' AND `tbl_products`.`cat_id` IN ($str)");
    return $result;
}