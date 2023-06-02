<?php 
// Lấy danh sách bài viết
function get_list_post($start, $num_per_page){
    $result = db_fetch_array("SELECT * FROM `tbl_posts` WHERE `status_post` = '2' ORDER BY `time` DESC LIMIT {$start}, {$num_per_page}");
    return $result;
}

// Lấy bài viết theo Id
function get_post_by_id($id){
    $result = db_fetch_row("SELECT * FROM `tbl_posts` WHERE `post_id` = '{$id}'");
    return $result;
}

// Lấy tổng danh sách bài viết
function get_total_row_post(){
    $result = db_num_rows("SELECT * FROM `tbl_posts` WHERE `status_post` = '2'");
    return $result;
}