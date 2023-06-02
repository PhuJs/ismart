<?php
//Triệu gọi đến file xử lý thông qua request

$request_path = MODULESPATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . get_controller() . 'Controller.php';

if (file_exists($request_path)) {
    require $request_path;
} else {
    echo "Không tìm thấy:$request_path ";
}

$action_name = get_action() . 'Action';

call_function(array('construct', $action_name));

if (!check_login() && get_action() != 'login') {
    redirect_to("?mod=users&controller=index&action=login");
}


// Nhận điều hướng khi có lệnh tìm kiếm sản phẩm
if (isset($_GET['search'])) {
    $key = $_GET['key'];
    redirect_to("?mod=products&controller=index&action=search&key={$key}");
}

// Nhận lệnh điều hướng vào danh mục bài viết
if (isset($_GET['btn_cat_post'])) {
    $cat_post = (int)$_GET['cat_post'];
    if ($cat_post != 0) {
        redirect_to("?mod=posts&controller=index&action=filterPost&cat={$cat_post}");
    } else {
        redirect_to("?mod=posts&controller=index&action=listPost");
    }
}

// Nhận lệnh tìm kiếm bài viết
if(isset($_GET['btn_search_post'])){
    $key = $_GET['key_search_post']; 
    redirect_to("?mod=posts&controller=index&action=search_post&key={$key}");
}


// Nhận requeset tìm kiếm khách hàng
if(isset($_GET['search_customer'])){
    $value_search = $_GET['key_search_customer'];
    redirect_to("?mod=sell&controller=index&action=searchCustomer&id={$value_search}");
}

// Nhận request tìm kiếm đơn hàng 
if(isset($_GET['btn_search_order'])){
    $key = $_GET['search_order'];
    redirect_to("?mod=sell&controller=index&action=searchOrder&key={$key}");
}

// Nhận request tìm kiếm nhóm khách hàng
if(isset($_GET['btn_select_customer'])){
    // $num = 1: Lọc ra những khách hàng mới
    // $num = 2: Lọc ra những khách hàng thân thiết
    $num = $_GET['select_group_customer'];
    if($num == 1){
        redirect_to("?mod=sell&controller=index&action=listCustomerNew");
    }elseif($num == 2){
        redirect_to("?mod=sell&controller=index&action=listCustomerVip");
    }else{
        redirect_to("?mod=sell&controller=index&action=customerList");
    }
}