<?php
// Cập nhật thông tin giỏ hàng
function update_cart()
{
    $num_order = 0;
    $total = 0;
    if (isset($_SESSION['cart'])) {

        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['qty'];
            $total += $item['sub_total'];
        }

        $_SESSION['cart']['info'] = array(
            'num_order' => $num_order,
            'total' => $total,
        );
    }
}

// Số lượng sản phẩm trong giỏ hàng
function get_num_product_cart(){
    if(isset($_SESSION['cart'])){
        return $_SESSION['cart']['info']['num_order'];
    }
}

// Lấy sản phẩm trong giỏ hàng
function get_product_cart(){
    $result = array();
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart']['buy'] as $item){
            $result[] =  $item;
        }
    }
    return $result;
}

// Lấy tổng tiền trong giỏ hàng
function get_total_cart(){
    if(isset($_SESSION['cart'])){
        return $_SESSION['cart']['info']['total'];
    }
}