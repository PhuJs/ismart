<?php

function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}

// Hàm xử lí phân loại danh mục sản phẩm theo cấp
function data_tree($list_data, $parent_id = 0, $level = 0){
    // Trả về một chuỗi danh mục
    $result = array();
    foreach($list_data as $key => $item){
        if($item['parent_id'] == $parent_id){
            $item['level'] = $level;
            $result[] = $item;
            $kq = data_tree($list_data, $item['cat_id'], $level + 1);
            $result = array_merge($result, $kq);
        }
    }
    return $result;
}