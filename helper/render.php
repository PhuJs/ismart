<?php

// Kiểm tra danh mục trong mảng có thuộc danh mục với id cho trước
function has_child($data, $id)
{
    foreach ($data as $v) {
        if ($v['parent_id'] == $id) {
            return true;
        }
    }
    return false;
}

// Hàm tạo xuất dữ liệu danh mục theo dạng html
function render_menu($data, $parent_id = 0, $level = 0, $url = '')
{
    if ($level == 0)
        $result = "<ul class='list-item'>";
    else
        $result = "<ul class='sub-menu'>";
    foreach ($data as $v) {
        if ($v['parent_id'] == $parent_id) {
            $result .= "<li>";
            $result .= "<a href='danh-muc-san-pham/". create_slug($v['cat_name'])."-{$v['cat_id']}.html' title=''>{$v['cat_name']}</a>";
            if (has_child($data, $v['cat_id'])) {
                $result .= render_menu($data, $v['cat_id'], $level + 1);
            }
            $result .= "</li>";
        }
    }
    $result .= "</ul>";
    return $result;
}

// Lấy chuỗi giá trị danh mục
function get_str_value($data, $id, $count = 0)
{
    $result = "";
    if ($count == 0) {
        $result = $id;
    }
    
    foreach ($data as $v) {
        if ($v['parent_id'] == $id) {
            $result .= ", " . $v['cat_id'];
            if (has_child($data, $v['cat_id'])) {
                $result .= get_str_value($data, $v['cat_id'], $count + 1);
            }
        }
    }
    return $result;
}

// Lấy tên danh mục theo id
function get_name_cat($data, $id){
    foreach($data as $item){
        if($item['cat_id'] ==  $id)
         return $item['cat_name'];
    }
    return '';
}
