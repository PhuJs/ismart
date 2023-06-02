<?php
function construct()
{
    load_model('index');
}

// Danh mục sản phẩm
function indexAction()
{
    $str_select = '';
    if (isset($_POST['btn_filter'])) {
        $select = (int)$_POST['select'];
        if ($select == 1) {
            $str_select = "ORDER BY `tbl_products`.`product_name` ASC";
        } elseif ($select == 2) {
            $str_select = "ORDER BY `tbl_products`.`product_name` DESC";
        } elseif ($select == 3) {
            $str_select = "ORDER BY `tbl_products`.`product_price` DESC";
        } elseif ($select == 4) {
            $str_select = "ORDER BY `tbl_products`.`product_price` ASC";
        }
    }

    // Lấy giá trị Id của danh mục theo yêu cầu, mặc định vào danh mục 1
    $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : 1;
    // Nhận request trang, mặc định trang đầu tiên
    $id = isset($_GET['id']) ? $_GET['id'] : 1;
    // Lấy danh sách danh mục
    $list_cat = get_list_cat();
    // Lấy chuỗi id của từng danh mục thuộc danh mục ở trên
    $str_id = get_str_value($list_cat, $cat_id);
    // Lấy danh sách sản phẩm nổi bật (price > 20.000.000đ)
    $list_product_vip = get_product_featured();

    // Lấy tổng số bản ghi 
    $num_row = get_num_row($str_id);
    $num_per_page = 6;
    $num_page = ceil($num_row / $num_per_page);
    $start = ($id - 1) * $num_per_page;
    // Lấy sản phẩm theo phân trang
    $list_product = get_product_by_value($str_id, $start, $num_per_page, $str_select);
    // Create URL cho phân trang
    $url_cat = create_slug(get_name_cat($list_cat, $cat_id));
    $url = "danh-muc-san-pham/" . $url_cat . "-{$cat_id}-trang-";
    $data = array(
        'cat_id' => $cat_id,
        'list_cat' => $list_cat,
        'list_product' => $list_product,
        'url' => $url,
        'num_page' => $num_page,
        'num_row' => $num_row,
        'list_product_vip' => $list_product_vip,
    );
    load_view('index', $data);
}

// Chi tiết sản phẩm
function detailAction()
{
    $id = (int)$_GET['id'];
    // Danh mục sản phẩm
    $list_cat = get_list_cat();
    // Sản phẩm theo danh mục
    $product_item = get_product_by_id($id);
    // Danh sách sản phẩm cùng nhóm
    $list_product_team = get_list_product_team($product_item['cat_id']);

    // Lấy danh sách sản phẩm nổi bật (price > 20.000.000đ)
    $list_product_vip = get_product_featured();

    // Lấy danh sách hình ảnh chi tiết của sản phẩm
    $list_img = get_list_image_detail($id);

    $data = array(
        'product_item' => $product_item,
        'list_cat' => $list_cat,
        'list_product_team' => $list_product_team,
        'list_product_vip' => $list_product_vip,
        'list_image' => $list_img,
    );

    load_view('detail', $data);
}

// Tìm kiếm sản phẩm
function searchPdAction()
{
    $str_select = '';
    if (isset($_POST['btn_filter'])) {
        $select = (int)$_POST['select'];
        if ($select == 1) {
            $str_select = "ORDER BY `tbl_products`.`product_name` ASC";
        } elseif ($select == 2) {
            $str_select = "ORDER BY `tbl_products`.`product_name` DESC";
        } elseif ($select == 3) {
            $str_select = "ORDER BY `tbl_products`.`product_price` DESC";
        } elseif ($select == 4) {
            $str_select = "ORDER BY `tbl_products`.`product_price` ASC";
        }
    }
    // Giá trị tìm kiếm
    $value = $_GET['value'];
    $list_product = get_product_by_search($value, $str_select);
    $list_product_vip = get_product_featured();

    // DM sản phẩm
    $list_cat = get_list_cat();
    $data = array(
        'list_product' => $list_product,
        'list_cat' => $list_cat,
        'list_product_vip' => $list_product_vip,
    );
    load_view('search', $data);
}
