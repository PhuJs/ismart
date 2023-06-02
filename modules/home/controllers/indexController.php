<?php
function construct(){
    load_model('index');
}

function indexAction(){
    // Lấy danh sách slider
    $list_slider = get_list_slider();
    
    // Lấy danh mục sản phẩm
    $list_cat_pd = get_cat_product();

     // Lấy danh sách sản phẩm nổi bật (price > 20.000.000đ)
     $list_product_vip = get_product_featured();

    // Lấy danh sách sản phẩm 
    $list_product = get_list_product();
    
    // Lấy danh sách sản phẩm nổi bật
    $product_selling = get_list_product_sell();

    // Lọc sản phẩm theo từng danh mục
    $filter_product = array();
    foreach($list_cat_pd as $cat){
         if($cat['parent_id'] == 0){
            $str_id = get_str_value($list_cat_pd, $cat['cat_id']);
            $filter_product[$cat['cat_name']] = get_list_product_by_str($str_id);
         }
    }
    $data = array(
        'list_cat' => $list_cat_pd,
        'product_selling' => $product_selling,
        'list_product' => $list_product,
        'filter_product' => $filter_product,
        'list_slider' => $list_slider,
        'list_product_vip' => $list_product_vip,
    );
    load_view('index', $data);
}

// Khu vực thử nghiệm chức năng
function testAction(){

}
?>