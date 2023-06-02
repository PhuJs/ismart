<?php 
// Thêm slider vào Database
function add_slider($data){
    $result = db_insert("tbl_slider", $data);
    return $result;
}

// Lấy danh sách slider trong Database
function get_list_slider(){
    $result = db_fetch_array("SELECT * FROM `tbl_slider` WHERE NOT `status` = '3'");
    return $result;
}

// Cập nhật trạng thái cho slider theo selected
function update_status_slider($status, $list_check_slider){
    $data = array(
        'status' => $status,
    );
    $result = db_update("tbl_slider", $data, "`id` IN ({$list_check_slider})");
    return $result;
}

// Lấy danh sách slider trong thùng rác
function get_slider_trash(){
    $result = db_fetch_array("SELECT * FROM `tbl_slider` WHERE `status` = '3'");
    return $result;
}

// Lấy slider theo Id
function get_slider_by_id($id){
    $result = db_fetch_row("SELECT * FROM `tbl_slider` WHERE `id` = '{$id}'");
    return $result;
}

// Cập nhật slider
function update_slider_by_id($data, $id){
    $result = db_update("tbl_slider", $data, "`id` = '{$id}'");
    return $result;
}

// Thêm slider vào thùng rác
function add_slider_trash($id){
    $data = array(
        'status' => 3,
    );
    $result = db_update("tbl_slider", $data, "`id` = '{$id}'");
    return $result;
}

// Xóa slider theo id
function delete_slider($id){
    $result = db_delete("tbl_slider", "`id` = '{$id}'");
    return $result;
}