<?php

function check_post_cat($cat_id){
    $str = " -- ";
    $arr = array();
    $list_cat = get_list_post_cat();
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

function check_post_cat_name($cat_id){
    $str = '';
    $item = db_fetch_row("SELECT * FROM `tbl_cat_posts` WHERE `cat_id` = '{$cat_id}'");
    if($item['parent_id'] > 0 ){
       $str = check_post_cat($item['parent_id']);
    }
    return $str.$item['cat_name'];
}