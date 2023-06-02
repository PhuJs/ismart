<?php

function check_cat($cat_id){
    $str = " -- ";
    $arr = array();
    $list_cat = get_cat_products();
    foreach($list_cat as $item){
        if($item['cat_id'] == $cat_id){
           $arr = $item;
           if($arr['parent_id'] > 0){
            $str.=" -- ";
           }
        }
    }
    return $str;
}

function check_cat_name($cat_name){
    $str = '';
    $item = db_fetch_row("SELECT * FROM `tbl_product_cat` WHERE `cat_name` = '{$cat_name}'");
    if($item['parent_id'] > 0 ){
       $str = check_cat($item['parent_id']);
    }
    return $str.$item['cat_name'];
}