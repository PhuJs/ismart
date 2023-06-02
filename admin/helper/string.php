<?php
function render_status_product($num){
    $arr_status = array(
        1 => "<span class='py-1 px-3 text-white bg-danger rounded'>Chờ duyệt<span>",
        2 => "<span class='py-1 px-3 text-white bg-success rounded'>Đã duyệt<span>",
        3 => "<span class='py-1 px-3 text-white bg-secondary rounded''>Hết hàng<span>",
        4 => "<span class='py-1 px-3 text-white bg-secondary rounded''>Thùng rác <span>",
    );
    return $arr_status[$num];
}

function render_cat_product($num){
    $str_status = array(
        1 => "<span class='py-1 px-3 text-white bg-danger rounded'>Chờ duyệt<span>",
        2 => "<span class='py-1 px-3 text-white bg-success rounded'>Hoạt động<span>",
        3 => "<span class='py-1 px-3 text-white bg-secondary rounded''>Ẩn danh mục<span>",
    );
    return $str_status[$num];
}

function render_stt_posts($num){
    $str_stt = array(
        1 => "<span class='py-1 px-3 text-white bg-danger rounded'>Chờ duyệt<span>",
        2 => "<span class='py-1 px-3 text-white bg-success rounded'>Đã đăng<span>",
        3 => "<span class='py-1 px-3 text-white bg-secondary rounded'>Bỏ vào thùng rác<span>",
    );
    return $str_stt[$num];
}

function render_stt_slider($num){
    $str_stt = array(
        1 => "<span class='py-1 px-3 text-white bg-danger rounded'>Chờ duyệt<span>",
        2 => "<span class='py-1 px-3 text-white bg-success rounded'>Công khai<span>",
    );
    return $str_stt[$num];
}

function payment_display($num){
    $arr = array(1 => "Thanh toán chuyển khoản", 2 => "Thanh toán tiền mặt");
    return $arr[$num];
}

function check_select($value_1, $value_2){
    if($value_1 == $value_2) return "selected='selected'";
}

function get_start_index($page, $num_per_page = 6){
    return ($page-1)*$num_per_page;
}

// function check_isset($value){
//     if(isset($value)) echo $value;
// }