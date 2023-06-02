<?php
function construct()
{
    load_model('index');
}

// Hiển thị danh sách bài viết
function indexAction()
{
    $num_row = get_total_row_post();
    $num_per_page = 6;
    $num_page = ceil($num_row/$num_per_page);

    $id = isset($_GET['id'])?$_GET['id']:1;
    $start = ($id - 1)*$num_per_page;
    // Lấy danh sách bài viết
    $list_post = get_list_post($start, $num_per_page);
    $data = array(
        'list_post' => $list_post,
        'num_page' => $num_page,
    );
    load_view('index', $data);
}

// Hiển thị 
function detailAction()
{
    // Lấy id bài viết
    $id = $_GET['id'];
    $post = get_post_by_id($id);
    $data = array(
        'post' => $post,
    );
    load_view('detail', $data);
}

function introduceAction(){
    load_view('introduce');
}
