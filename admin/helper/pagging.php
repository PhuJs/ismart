<?php

function get_pagging($num_page, $url, $id)
{
    $str_pagging = "<ul id='list-paging' class='fl-right navbar mt-3'>";
    if ($id > 1) {
        $num = $id - 1;
        $str_pagging .= "
        <li class='nav-item'>
        <a href='{$url}{$num}' title='' class='py-1 px-2 text-white m-1 bg-info rounded h3'><</a>
        </li>
        ";
    }

    for ($i = 1; $i <= $num_page; $i++) {

        if ($id == $i) {
            $str_pagging .= "
            <li class='nav-item'>
                <a href='{$url}{$i}' title='' class=' py-1 px-2 text-white m-1 bg-warning rounded h3'>{$i}</a>
            </li>
        ";
        } else {
            $str_pagging .= "
                            <li class='nav-item'>
                                <a href='{$url}{$i}' title='' class='py-1 px-2 text-white m-1 bg-info rounded h3'>{$i}</a>
                            </li>
          ";
        }
    }

    if ($id < $num_page) {
        $num = $id + 1;
        $str_pagging .= "
        <li class='nav-item'>
        <a href='{$url}{$num}' title='' class='py-1 px-2 text-white m-1 bg-info rounded h3'>></a>
        </li>
        ";
    }
    $str_pagging .= "</ul>";
    echo $str_pagging;
}
