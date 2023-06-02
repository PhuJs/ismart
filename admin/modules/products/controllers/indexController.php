<?php
function construct()
{
    load_model('index');
    load('lib', 'module-product');
}

// Product
function addAction()
{
    global $error, $product_name, $product_code, $price, $desc_short, $desc;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không để trống tên sản phẩm";
        } else {
            $product_name = $_POST['product_name'];
        }

        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Nhập Mã Sản Phẩm";
        } else {
            $product_code = $_POST['product_code'];
        }

        if (empty($_POST['price'])) {
            $error['price'] = "Nhập giá sản phẩm";
        } else {
            $price = $_POST['price'];
        }

        if (empty($_POST['discount'])) {
            $error['discount'] = "Nhậo vào giá cũ";
        } else {
            $discount = $_POST['discount'];
        }

        if (empty($_POST['desc_short'])) {
            $error['desc_short'] = "Nhập mô tả sản phẩm";
        } else {
            $desc_short = $_POST['desc_short'];
        }

        $desc = $_POST['desc'];

        $upload_dir = 'public/images/';
        $upload_file = $upload_dir . $_FILES['file']['name'];
        $sample = array('jpg', 'png', 'jpeg', 'gift');
        $file_ex = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($file_ex), $sample)) {
            $file_size = $_FILES['file']['size'];
            if ($file_size > 20000000) {
                $error['file_size'] = "Quá kích thước quy đinh";
            }

            if (file_exists($upload_file)) {
                $k = 1;
                while (file_exists($upload_file)) {
                    $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                    $new_file_name = $file_name . "-{$k}." . $file_ex;
                    $new_upload_file = $upload_dir . $new_file_name;
                    $k++;
                    $upload_file = $new_upload_file;
                }
            }
        } else {
            $error['file_type'] = "File nhập vào không đúng định dạng";
        }

        if (empty($_POST['parent_id'])) {
            $error['parent_id'] = "Vui lòng chọn danh mục sản phẩm";
        } else {
            $parent_id = $_POST['parent_id'];
        }

        if (empty($error)) {
            $data = array(
                'product_name' => $product_name,
                'product_price' => $price,
                'discount' => $discount,
                'product_thumb' => $upload_file,
                'product_description' => $desc_short,
                'product_detail' => $desc,
                'product_code' => $product_code,
                'product_time' => time(),
                'cat_id' => $parent_id,
                'maker' => user_login(),
            );

            $result = add_product($data);
            if (!empty($_FILES['file_detail'])) {
                // Kiểm tra trường upload các hình ảnh chi tiết, nếu không rỗng tiến hành upload
                foreach ($_FILES['file_detail']['name'] as $key => $item) {
                    $file_duoi = pathinfo($item, PATHINFO_EXTENSION);
                    // Kiểm tra đuôi file có tồn tại hay không
                    if (in_array(strtolower($file_duoi), $sample)) {
                        $file_kt = $_FILES['file_detail']['size'][$key];
                        if ($file_kt < 20000000) {
                            $file_upload_link = $upload_dir . $item;
                            if (!file_exists($file_upload_link)) {
                                move_uploaded_file($_FILES['file_detail']['tmp_name'][$key], $file_upload_link);
                            }

                            // Thêm thông tin hình ảnh vào Database
                            $data = array(
                                'product_id' => $result,
                                'img_link' => $file_upload_link,
                                'upload_time' => time(),
                            );
                            add_picture_detail($data);
                        }
                    }
                }
            }
            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file) && $result > 0) {
                redirect_to("?mod=products&controller=index&action=addOk");
            }
        } else {
            $error['add_proudct'] = "Thêm sản phẩm không thành công vui lòng thử lại";
        }
    }
    $list_cat = get_cat_products();
    $data = array(
        'list_cat' => $list_cat,
    );
    load_view('add', $data);
}

// Hiển thị danh sách sản phẩm
function indexAction()
{
    // Thống kê 
    $product_confirm = get_num_product_confirm();
    $product_empty = get_num_product_empty();
    $product_trash = get_num_product_trash();

    // Tổng số bản ghi của bảng sản phẩm
    $num_row = get_total_row();
    // Số bản ghi trên trang
    $num_per_page = 6;
    // Vị trí bắt đầu mặc định trang đầu tiên
    $id = isset($_GET['id']) ? $_GET['id'] : 1;
    $start = ($id - 1) * $num_per_page;
    $num_page = ceil($num_row / $num_per_page);
    $list_products = get_product_by_page($start, $num_per_page);
    $data = array(
        'list_product' => $list_products,
        'num_page' => $num_page,
        'num_row' => $num_row,
        'product_confirm' => $product_confirm,
        'product_empty' => $product_empty,
        'product_trash' => $product_trash,
    );
    load_view('listPd', $data);
}

// Cập nhật sản phẩm theo Id
function updatePdAction()
{
    // Đã xử lí xong phần cập nhật sản phẩm, trong trường hợp từ danh sách sản phẩm đi vào
    $key = isset($_GET['key']) ? $_GET['key'] : "Lap";
    // Chứa các chuỗi action
    $arr_act =  array(1 => "index", 2 => "search&key={$key}", 3 => "confirm_product", 4 => "out_of_stock", 5 => "products_trash");
    $act = $_GET['act'];
    $action = $arr_act[$act];

    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    $id = $_GET['id'];
    $product = get_product_by_id($id);
    global $error;
    if (isset($_POST['btn_update'])) {
        // Đặt cờ hiệu
        $error = array();

        // Fullname
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không để trống tên sản phẩm";
        } else {
            $product_name = $_POST['product_name'];
        }

        // Product Code
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Nhập Mã Sản Phẩm";
        } else {
            $product_code = $_POST['product_code'];
        }

        // Product Price
        if (empty($_POST['price'])) {
            $error['price'] = "Nhập giá sản phẩm";
        } else {
            $price = $_POST['price'];
        }

        // Discount
        $discount = $_POST['discount'];

        // Mô tả sản phẩm
        if (empty($_POST['desc_short'])) {
            $error['desc_short'] = "Nhập mô tả sản phẩm";
        } else {
            $desc_short = $_POST['desc_short'];
        }

        // Product Detail
        $desc = $_POST['desc'];

        $upload_dir = 'public/images/';
        $upload_file = $upload_dir . $_FILES['file']['name'];
        // Kiểm tra 
        // Chưa tồn tại thì upload
        // Nếu file đã tồn tại rồi, đổi tên file thực hành upload
        $format_file = array('jpg', 'png', 'jpeg', 'gift');
        $file_ex = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($file_ex), $format_file)) {
            $file_size = $_FILES['file']['size'];
            if ($file_size > 20000000) {
                $error['file_error'] = "Quá kích thước quy định";
            } else {
                if (file_exists($upload_file)) {
                    $k = 1;
                    while (file_exists($upload_file)) {
                        $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                        $new_file_name = $file_name . "-{$k}." . $file_ex;
                        $new_upload_file = $upload_dir . $new_file_name;
                        $k++;
                        $upload_file = $new_upload_file;
                    }
                }
                move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
            }
        } else {
            $error['file_error'] = "File không đúng định dạng";
        }

        // Cập nhật danh mục sản phẩm
        if (empty($_POST['parent_id'])) {
            $error['parent_id'] = "Vui lòng chọn danh mục sản phẩm";
        } else {
            $parent_id = $_POST['parent_id'];
        }

        // Cập nhật trạng thái sản phẩm 
        if (empty($_POST['status'])) {
            $error['status'] = "Chọn danh mục sản phẩm";
        } else {
            $status = $_POST['status'];
        }

        // Những dữ liệu yêu cầu nhập vào đầy đủ
        // Dữ liệu đưa vào không lỗi
        // Tiến hành cập nhật
        if (empty($error)) {
            // Kiểm tra hình ảnh chi tiết có cập nhật không
            // Có thì tiến hành cập nhật 
            // Những hình ảnh này của sản phẩm nào, dựa vào id sản phẩm
            $data = array(
                'product_name' => $product_name,
                'product_price' => $price,
                'discount' => $discount,
                'product_thumb' => $upload_file,
                'product_description' => $desc_short,
                'product_detail' => $desc,
                'product_code' => $product_code,
                'update_time' => time(),
                'cat_id' => $parent_id,
                'status_product' => $status,
                'maker' => user_login(),
            );
            $result = update_product($data, $id);
            // Kiểm tra cập nhật chi tiết hình ảnh
            $kt = true;
            if (!empty($_FILES['files'])) {
                foreach ($_FILES['files']['name'] as $key => $item) {
                    $file_duoi = pathinfo($item, PATHINFO_EXTENSION);
                    if (in_array(strtolower($file_duoi), $format_file)) {
                        $file_kt = $_FILES['files']['size'][$key];
                        if ($file_kt < 20000000) {
                            // Kiểm tra file đã tồn tại chưa, đã tồn tại thực hiện đổi tên file and upload
                            $forder_file = $upload_dir . $item;
                            if (file_exists($forder_file)) {
                                $k = 1;
                                while (file_exists($forder_file)) {
                                    $file_ten = pathinfo($item, PATHINFO_FILENAME);
                                    $new_file_ten = $file_ten . "-{$k}." . $file_duoi;
                                    $new_forder_file = $upload_dir . $new_file_ten;
                                    $forder_file = $new_forder_file;
                                    $k++;
                                }
                            }
                            $kq = move_uploaded_file($_FILES['files']['tmp_name'][$key], $forder_file);
                            if($kq){
                                $pic_status = array(
                                    'product_id' => $id,
                                    'img_link' => $forder_file,
                                    'upload_time' => time(),
                                );
                                add_picture_detail($pic_status);
                            } else{
                                $kt = false;
                            }
                        }
                    }
                }
            }

            if ($result > 0 && $kt == true) {
                redirect_to("?mod=products&controller=index&action=updateOk&act={$action}&page={$page}");
            } else {
                $error['add_proudct'] = "Cập nhật sản phẩm không thành công vui lòng thử lại";
            }
        }
    }

    $list_cat = get_cat_products();
    $data = array(
        'product' => $product,
        'list_cat' => $list_cat,
        'action' => $action,
        'page' => $page,
    );
    load_view('updatePd', $data);
}

function updateOkAction()
{
    $page = $_GET['page'];
    $action = $_GET['act'];
    if(isset($_GET['key'])){
        $action.="&key=".$_GET['key'];
    }
   
    $url = "?mod=products&controller=index&action={$action}&id={$page}";

    $data = array(
        'page' => $page,
        'url' => $url,
    );
    load_view('updateOk', $data);
}

function addOkAction()
{
    load_view('addOk');
}

// Thêm sản phẩm vào thùng rác
function addTrashAction()
{
    $key = isset($_GET['key'])?$_GET['key']:"Lap";
    $list_act = array(1 => "index", 2 => "confirm_product", 3 => "out_of_stock", 4 => "search&key={$key}");
    $act = $_GET['act'];
    // Lấy id sản phẩm
    $id = $_GET['id'];
    $page = $_GET['page'];
    $action = $list_act[$act];
    // Cập nhật trạng thái thùng rác cho sản phẩm - 4
    $result = add_product_trash($id);
    if ($result > 0) {
        redirect_to("?mod=products&controller=index&action={$action}&id={$page}");
    } else {
        echo "Thêm không thành công hãy kiểm tra lại <a href='?mod=products&controller=index&action=index'>Trở lại trang chủ</a>";
    }
}

// Xem sản phẩm theo tìm kiếm
function searchAction()
{
    $key = $_GET['key'];
    // Tổng số sản phẩm
    $num_row = get_num_row_search($key);
    $num_per_page = 6;
    $num_page = ceil($num_row / $num_per_page);

    $id = isset($_GET['id']) ? $_GET['id'] : 1;
    $start = ($id - 1) * $num_per_page;

    $list_product = search_product($key, $start, $num_per_page);
    $data = array(
        'num_row' => $num_row,
        'list_product' => $list_product,
        'num_page' => $num_page,
        'key' => $key,
    );
    load_view('search', $data);
}

// Thay đổi trạng thái sản phẩm
function change_status_productAction()
{
    $request = $_GET['request'];
    $list_id = $_GET['product_id'];
    // Tạo chuỗi id sản phẩm
    $str_id = implode(", ", $list_id);
    if ($request == 1 || $request == 2 || $request == 3 || $request == 4) {
        // Thực hiện thay đổi trạng thái sản phẩm theo Id đã chọn
        update_status_product($request, $str_id);
    } elseif ($request == 5) {
        // Xóa sản phẩm theo Id đã chọn
        delete_product_by_select($str_id);
    }
}

// Hiển thị thông tin sản phẩm
function info_productAction()
{
    /**  Vì có nhiều khu vực hiển thị thông tin sản phẩm nên:
     * Chúng tôi xây dựng hàm này để cung cấp dịch vụ xem thông tin sản phẩm
     * Cho toàn bộ các Action khác
     * Các Action chỉ cần cung cấp thông tin Action 
     * Chúng tôi sẽ cấp một số định vị 
     * Khi đi vào khu vực chúng tôi thì chúng tôi sẽ xác định Action cụ thể và đưa về đúng vị trí trước đó
     */
    $key = isset($_GET['key'])?$_GET['key']:"Lap";
    $list_act = array(1 => "index", 2 => "confirm_product", 3 => "out_of_stock", 4 => "products_trash", 5 => "search&key={$key}");
    $act = $_GET['act'];
   
    // Lấy id sản phẩm
    $id = $_GET['id'];
    // Vị trí trang định vị
    $map = $_GET['map'];
    // Action đang trú ngụ
    $action = $list_act[$act];
    // Danh mục sản phẩm
    $list_cat = get_cat_products();

    // Lấy thông tin sản phẩm theo id
    $product = get_product_by_id($id);

    $data = array(
        'list_cat' => $list_cat,
        'product' => $product,
        'map' => $map,
        'action' => $action,
    );
    load_view('infoProduct', $data);
}

// Hiển thị sản phẩm chờ xét duyệt
function confirm_productAction(){
   
    // Lấy danh sách sản phẩm chờ xét duyệt
    $list_product = get_product_confirm();
   
    // Hiển thị sản phẩm lên giao diện
    $data = array(
        'list_product' => $list_product,
    );
    load_view('confirm_product', $data);
}

// Hiển thị sản phẩm hết hàng
function out_of_stockAction(){
    // Lấy danh sách sản phẩm hết hàng 
    $list_product = get_product_out_of_stock();
    $data = array(
        'list_product' => $list_product,
    );
    load_view('out_of_stock', $data);
}

// Hiển thị sản phẩm trong thùng rác
function products_trashAction(){
    // Lấy danh sách sản phẩm
    $list_product = get_product_trash();
    $data = array(
        'list_product' => $list_product,
    );
    load_view('product_trash', $data);
}

// Xóa sản phẩm theo Id(tạm thời có ràng buộc khóa ngoại nên chỉ xử lí cho vào thùng rác)
// function delete_productAction(){
//     // Lấy id sản phẩm
//     $id = $_GET['id'];
//     // Xóa sản phẩm theo Id
//     $result = delete_product_by_id($id);
//     if($result > 0){
//         redirect_to("?mod=products&controller=index&action=products_trash");
//     }else{
//         echo "Lỗi! xóa sản phẩm";
//     }
// }

// =============Cat Product===============
// Thêm danh mục
function addCatAction()
{
    global $error, $success;
    if (isset($_POST['btn_add_cat'])) {
        $error = array();

        if (empty($_POST['cat_name'])) {
            $error['cat_name'] = "Lỗi để trống tên danh mục";
        } else {
            $cat_name = $_POST['cat_name'];
        }

        // Danh mục cha
        $parent_id = $_POST['parent_id'];

        $status = $_POST['status'];

        if (empty($error)) {
            // Cập nhật danh mục vào CSDL
            $data = array(
                'cat_name' => $cat_name,
                'user_create' => user_login(),
                'parent_id' => $parent_id,
                'time' => time(),
                'status_cat' => $status,
            );
            $result = add_cat_product($data);
            if ($result > 0) {
                $success['yes'] = "Thêm dữ liệu thành công";
            } else {
                $error['no'] = "Thêm dữ liệu thất bại";
            }
        }
    }
    $list_cat = get_cat_products();
    $data = array(
        'list_cat' => $list_cat,
    );
    load_view('addCat', $data);
}

// Hiển thị danh sách danh mục
function listCatAction()
{
    // Lấy dữ liệu danh mục
    $list_cat = get_cat_products();
    // Lấy số lượng danh mục trong thùng rác
    $cat_trash = get_num_cat_trash();
    // Xây dựng hàm xử lí phẩn loại danh mục
    $list_cat_tree = data_tree($list_cat);
   
    $data = array(
        'list_cat' => $list_cat_tree,
        'cat_trash' => $cat_trash,
    );
    load_view('productCat', $data);
}

// Cập nhật danh mục
function updateCatAction()
{
    $id = $_GET['id'];
    global $error, $success, $cat_name;
    if (isset($_POST['btn_add_cat'])) {
        $error = array();

        if (empty($_POST['cat_name'])) {
            $error['cat_name'] = "Lỗi để trống tên danh mục";
        } else {
            $cat_name = $_POST['cat_name'];
        }

        $parent_id = $_POST['parent_id'];

        $status = $_POST['status'];

        if (empty($error)) {
            // Cập nhật danh mục vào CSDL
            $data = array(
                'cat_name' => $cat_name,
                'user_create' => user_login(),
                'parent_id' => $parent_id,
                'time' => time(),
                'status_cat' => $status,
            );
            $result = update_cat_product($data, $id);
            if ($result > 0) {
                redirect_to("?mod=products&controller=index&action=listCat");
            } else {
                $error['no'] = "Cập nhật dữ liệu thất bại";
            }
        }
    }
    // Danh mục cập nhật
    $item_cat = get_cat_by_id($id);
    // Danh sách danh mục
    $list_cat = get_cat_products();
    $data = array(
        'list_cat' => $list_cat,
        'item_cat' => $item_cat,
    );
    load_view('addCat', $data);
}

// Thêm danh mục vào thùng rác
function out_of_trash_catAction()
{
    // Lấy id của danh mục
    $id = $_GET['id'];
    // Đưa danh mục có id bên trên vào thùng rác
    $result = out_of_trash_cat($id);
    if ($result > 0) {
        redirect_to("?mod=products&controller=index&action=listCat");
    } else {
        echo "Thêm vào thùng rác không thành công";
    }
}

// Cập nhật trạng thái danh mục theo danh sách
function update_cat_listAction(){
    $request = (int)$_GET['request'];
    $list_check = $_GET['list_check'];
    $str_list_check = implode(", ", $list_check);
    // Đã có dữ liệu yêu cầu và danh sách danh mục cần cập nhật
    // Thực hiện cập nhật trạng thái yêu cầu cho tất cả danh mục được chọn theo chuỗi id
    $data = array(
        'status_cat' => $request, 
    );
    $result = update_status_list_cat_product($data, $str_list_check);
    echo $result;
}

// Thùng rác
function trash_cat_productAction(){
    // Lấy danh mục đang trong thùng rác
    $list_cat = get_cat_product_in_trash();
    $data = array(
        'list_cat' => $list_cat,
    );
    load_view('trash_cat', $data);
}

// Đưa danh mục hoạt động trở lại
function reuseCatAction(){
    // Id danh mục cần tái hoạt động
    $id = $_GET['id'];
    $result = reuse_cat($id);
    if($result > 0){
        redirect_to("?mod=products&controller=index&action=trash_cat_product");
    }
}