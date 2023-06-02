<?php
// Tạo thanh phân trang
function create_nav_bar($num_page, $url, $id)
{
    $result = "<ul class='list-item clearfix'>";
    if ($id > 1) {
        $pre = $id - 1;
        $result .= "
        <li>
        <a href='{$url}{$pre}' title=''><<</a>
        </li>
        ";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        $result .= "<li>";
        if ($id == $i) {
            $result .= "<a href='{$url}{$i}' title='' class='active'>{$i}</a>";
        }else{
            $result .= "<a href='{$url}{$i}'title=''>{$i}</a>";
        }
        $result .= "</li>";
    }
    if ($id < $num_page) {
        $next = $id + 1;
        $result .= "<li>
        <a href='{$url}{$next}' title=''>>></a>
        </li>";
    }
    $result .= "</ul>";
    echo $result;
}

// Tạo Breadcrumb
