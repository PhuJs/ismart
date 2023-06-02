<?php
function construct()
{
    load_model('index');
    load('helper', 'posts');
}

function indexAction()
{
    load_view('listPost');
}

// ========== Danh Mục =========
function addPostCatAction()
{
    global $error, $success;
    if (isset($_POST['btn_add_cat'])) {
        // Đặt cờ hiệu báo lỗi, và thành công
        $error = array();
        $success = array();
        if (empty($_POST['cat_name'])) {
            $error['cat_name'] = "Cập nhật tên danh mục";
        } else {
            $cat_name = $_POST['cat_name'];
        }

        $cat_desc = $_POST['cat_desc'];

        $parent_cat = $_POST['parent_cat'];

        $status = $_POST['status'];

        if (empty($error)) {
            $data = array(
                'cat_name' => $cat_name,
                'cat_desc' => $cat_desc,
                'time' => time(),
                'author' => user_login(),
                'status' => $status,
                'parent_id' => $parent_cat
            );

            $result =  insert_cat_post($data);
            if ($result > 0) {
                $success['yes'] = "Cập nhật thành công nha";
            } else {
                $error['no'] = "Cập nhật lỗi rồi";
            }
        }
    }

    // Lấy danh sách danh mục 
    $list_cat = get_list_post_cat();
    $data = array(
        'list_cat' => $list_cat,
    );
    load_view('addPostCat', $data);
}

// Hiển thị danh mục bài viết
function postCatAction()
{
    // Lấy danh sách danh mục bài viết xuống
    $list_post_cat = get_list_post_cat();
    // Dùng hàm data_tree() tạo cây danh mục
    $list_post_cat_tree = data_tree($list_post_cat);

    $data = array(
        'list_post_cat' => $list_post_cat_tree,
    );
    load_view('postCat', $data);
}

// Thay đổi trạng thái các danh mục được chọn
function change_status_catAction()
{
    $status = $_GET['status'];
    $list_checked = $_GET['list_checked'];
    $str_list_checked = implode(", ", $list_checked);
    // Viết hàm thay đổi trạng thái cho danh mục
    $result = change_status_cat_post_select($status, $str_list_checked);
    echo $result;
}

// Cập nhật danh mục
function update_cat_postAction()
{
    // Lấy id danh mục cần cập nhật
    $id = $_GET['id'];
    global $error, $success;
    if (isset($_POST['btn_add_cat'])) {
        // Đặt cờ hiệu báo lỗi, và thành công
        $error = array();
        $success = array();
        if (empty($_POST['cat_name'])) {
            $error['cat_name'] = "Cập nhật tên danh mục";
        } else {
            $cat_name = $_POST['cat_name'];
        }

        $cat_desc = $_POST['cat_desc'];

        $parent_cat = $_POST['parent_cat'];

        $status = $_POST['status'];

        if (empty($error)) {
            $data = array(
                'cat_name' => $cat_name,
                'cat_desc' => $cat_desc,
                'time' => time(),
                'author' => user_login(),
                'status' => $status,
                'parent_id' => $parent_cat
            );

            // Cập nhật dữ liệu cho danh mục tương ứng với id mặc định
            $result =  update_cat_post_by_id($data, $id);
            if ($result > 0) {
                redirect_to("?mod=posts&controller=index&action=postCat");
            } else {
                $error['no'] = "Cập nhật lỗi rồi";
            }
        }
    }
    // Lấy danh mục bài viết theo id
    $post_cat = get_cat_post_by_id($id);

    // Lấy danh sách danh mục
    $list_cat = get_list_post_cat();
    $data = array(
        'post_cat' => $post_cat,
        'list_cat' => $list_cat,
    );
    load_view('addPostCat', $data);
}

// Xóa danh mục
function delete_cat_postAction()
{
    $id = $_GET['id'];
    // Đưa danh mục theo Id trên vào trạng thái vô thùng rác
    $result = add_cat_post_in_trash($id);
    if ($result > 0) {
        redirect_to("?mod=posts&controller=index&action=postCat");
    } else {
        echo "Xóa không thành công";
    }
}

// ============= Bài Viết =========
// Thêm mới bài viết
function addPostAction()
{
    global $error, $title, $slug, $desc, $content;
    if (isset($_POST['btn-submit'])) {
        $error = array();

        if (empty($_POST['title'])) {
            $error['title'] = "Cần có tiêu đề bài viết";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['slug'])) {
            $error['slug'] = "Tạo một tên link thân thiện cho bài viết";
        } else {
            $slug = $_POST['slug'];
        }

        $desc = $_POST['desc'];

        if (empty($_POST['content'])) {
            $error['content'] = "Cần có nội dung bài viết";
        } else {
            $content = $_POST['content'];
        }

        // Tạo một đường dẫn vào file
        $upload_dir = "public/hinhanh/";
        $upload_file = $upload_dir . $_FILES['file']['name'];
        $format_file = array('png', 'jpg', 'jpeg', 'gift');
        $file_ex = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($file_ex), $format_file)) {
            $file_size = $_FILES['file']['size'];
            if ($file_size > 20000000) {
                $error['file_error'] = "File quá vượt dung lượng cho phép";
            } else {
                if (file_exists($upload_file)) {
                    $k = 1;
                    while (file_exists($upload_file)) {
                        $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                        $new_file_name = $file_name . "-{$k}." . $file_ex;
                        $new_upload_file = $upload_dir . $new_file_name;
                        $upload_file = $new_upload_file;
                        $k++;
                    }
                    // Chuyển hình ảnh vào thưc mục của dự án
                    move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
                }
            }
        } else {
            $error['file_error'] = "File không đúng định dạng";
        }

        if ($_POST['parent-cat'] == 0) {
            $error['parent_cat'] = "Chọn danh mục cha tương ứng";
        } else {
            $parent_cat = $_POST['parent-cat'];
        }


        // Kiểm tra lỗi 
        if (empty($error)) {
            // Tạo mảng chứa key và value cần thêm
            $data = array(
                'post_title' => $title,
                'post_description' => $desc,
                'post_thumb' => $upload_file,
                'author' => user_login(),
                'post_content' => $content,
                'time' => time(),
                'slug_url' => $slug,
                'cat_id' => $parent_cat,
            );
            $result = insert_post($data);
            if ($result > 0) {
                redirect_to("?mod=posts&controller=index&action=addOk");
            } else {
                $error['no'] = "Thêm bài viết không thành công";
            }
        }
    }

    // Lấy danh sách danh mục bài viết
    $list_post_cat = get_list_post_cat();
    $data = array(
        'list_post_cat' => $list_post_cat,
    );
    load_view('add_post', $data);
}

// Hiển thị danh sách bài viết
function listPostAction()
{
    // Lấy số liệu thống kê các loại bài viết
    $post_confirm = get_total_post_confirm();
    $post_trash = get_total_post_trash();

    $num_row = get_num_row_posts();
    // Số bản ghi trên trang
    $num_per_page = 6;
    // Tổng số trang
    $num_page = ceil($num_row / $num_per_page);
    $id = isset($_GET['id']) ? $_GET['id'] : 1;
    $start = ($id - 1) * $num_per_page;
    $list_post = get_list_post($start, $num_per_page);
    // Lấy tất cả bản ghi của danh mục bài viết
    $list_post_cat = get_list_post_cat();
    $data = array(
        'num_page' => $num_page,
        'list_post' => $list_post,
        'list_post_cat' => $list_post_cat,
        'num_row'  => $num_row,
        'post_confirm' => $post_confirm,
        'post_trash' => $post_trash,
    );
    load_view('listPost', $data);
}

// Hiển thị thêm bài viết thành công
function addOkAction()
{
    load_view('insert_success');
}

// Cập nhật trạng thái cho các bài viết được chọn
function update_status_postAction()
{
    $status = $_GET['status'];
    $list_checked = $_GET['list_checked'];
    $str_id = implode(", ", $list_checked);
    // Cập nhật trạng thái cho các bài viết
    $result = update_status_post_select($status, $str_id);
    echo $result;
}

// Hiển thị thông tin bài viết
function infor_postAction()
{
    $key = isset($_GET['key'])?$_GET['key']:"Tpgroup";
    $list_act = array(1 => "listPost", 2 => "list_post_confirm", 3 => "search_post&key={$key}");
    $act = $_GET['act'];
    $map = isset($_GET['map']) ? $_GET['map'] : 1;
    $action = $list_act[$act];
    // Lấy thông tin bài viết cần xem
    $id = $_GET['id'];
    $posts = get_post_by_id($id);
    // show_array($posts);
    // Hiển thị lên giao diện cần xem
    $data = array(
        'posts' => $posts,
        'action' => $action,
        'map' => $map,
    );
    load_view('infor_post', $data);
}

// Cập nhật thông tin bài viết
function updatePostAction()
{
    $key = isset($_GET['key'])?$_GET['key']:"haha";
    $list_act = array(1 => "listPost", 2 => "list_post_confirm", 3 => "search_post&key={$key}");
    $act = $_GET['act'];
    $map = isset($_GET['map']) ? $_GET['map'] : 1;
    $action = $list_act[$act];

    $id = $_GET['id'];
    global $error;
    if (isset($_POST['btn-submit'])) {
        // Đặt cờ hiệu
        $error = array();

        if (empty($_POST['title'])) {
            $error['title'] = "Cần có tiêu đề bài viết";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['slug'])) {
            $error['slug'] = "Cho một đường link cụ thể vào bài viết";
        } else {
            $slug = $_POST['slug'];
        }


        $desc = $_POST['desc'];

        if (empty($_POST['content'])) {
            $error['content'] = "Cần có nội dung bài viết";
        } else {
            $content = $_POST['content'];
        }


        $upload_dir = "public/hinhanh/";
        $upload_file = $upload_dir . $_FILES['file']['name'];
        $format_file = array('png', 'jpg', 'jpeg', 'gift');
        $file_ex = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($file_ex), $format_file)) {
            $file_size = $_FILES['file']['size'];
            if ($file_size > 20000000) {
                $error['file_error'] = "File quá vượt dung lượng cho phép";
            } else {
                if (file_exists($upload_file)) {
                    $k = 1;
                    while (file_exists($upload_file)) {
                        $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                        $new_file_name = $file_name . "-{$k}." . $file_ex;
                        $new_upload_file = $upload_dir . $new_file_name;
                        $upload_file = $new_upload_file;
                        $k++;
                    }
                }
                move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
            }
        } else {
            $error['file_error'] = "File không đúng định dạng";
        }

        if ($_POST['parent_cat'] == 0) {
            $error['parent_cat'] = "Cập nhật danh mục cụ thể cho bài viết";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }

        $status = $_POST['status'];

        if (empty($error)) {

            $data = array(
                'post_title' => $title,
                'post_description' => $desc,
                'post_thumb' => $upload_file,
                'author' => user_login(),
                'post_content' => $content,
                'time' => time(),
                'cat_id' => $parent_cat,
                'status_post' => $status,
                'slug_url' => $slug,
            );

            $result = update_post($data, $id);
            if ($result > 0) {
                redirect_to("?mod=posts&controller=index&action=update_ok&act={$action}&id={$map}");
            } else {
                $error['no'] = "Cập nhật bài viết không thành công";
            }
        }
    }
    // Lấy danh sách danh mục và bài viết cần cập nhật
    $list_cat = get_list_post_cat();
    $post = get_post_by_id($id);
    $data = array(
        'post' => $post,
        'list_cat' => $list_cat,
        'map' => $map,
        'action' => $action,
    );
    load_view('updatePost', $data);
}

// Bỏ bài viết vào thùng rác
function add_trash_postAction()
{
    $key = isset($_GET['key'])?$_GET['key']:"warting";
    $list_act = array(1 => "listPost", 2 => "list_post_confirm", 3 => "search_post&key={$key}");
    $act = $_GET['act'];
    $map = isset($_GET['map']) ? $_GET['map'] : 1;
    $action = $list_act[$act];

    $id = $_GET['id'];
    // Thay đổi bài viết có id khớp với id trên vào trạng thái trong thùng rác
    $result = add_post_in_trash($id);
    if ($result > 0) {
        redirect_to("?mod=posts&controller=index&action={$action}&id={$map}");
    }
}

// Hiển thị bài viết thành công
function update_okAction()
{
    $id = $_GET['id'];
    $action = $_GET['act'];
    if($action == "search_post"){
        $key = $_GET['key'];
        $action.="&key=".$key;
    }
    $data = array(
        'id' => $id,
        'action' => $action,
    );
    load_view('updateSuces', $data);
}

// Danh sách bài viết chờ xác nhận
function list_post_confirmAction()
{
    // Lấy danh sách bài viết chờ xác nhận
    $list_post = get_list_post_confirm();

    // Xây dựng giao diện hiển thị
    $data = array(
        'list_post' => $list_post,
    );
    load_view('list_post_confirm', $data);
}

// Duyệt bài viết chờ xác nhận
function duyet_bai_vietAction()
{
    $id = $_GET['id'];
    // Thay đổi trạng thái bài viết thành đã duyệt
    $result = duyet_bai_viet($id);
    if ($result > 0) {
        redirect_to("?mod=posts&controller=index&action=list_post_confirm");
    }
}

// Hiển thị bài viết trong thùng rác
function post_in_trashAction()
{
    // Lấy danh sách bài viết trong thùng rác
    $list_post = get_list_post_in_trash();
    $data = array(
        'list_post' => $list_post,
    );
    load_view('list_post_trash', $data);
}

// Đưa bài viết trở lại trạng thái xét duyệt
function xet_duyet_postAction(){
    $id = $_GET['id'];
    $result = xet_duyet_bai_viet($id);
    if($result > 0){
        redirect_to("?mod=posts&controller=index&action=post_in_trash");
    }
}

// Xóa bài viết
function deletePostAction()
{
    $id = $_GET['id'];
    $result = delete_post_by_id($id);
    if ($result > 0) {
        redirect_to("?mod=posts&controller=index&action=post_in_trash");
    }
}

// Tìm kiếm bài viết
function search_postAction()
{
    $key = $_GET['key'];
    $list_post = get_list_post_by_key($key);
    // Lấy danh sách danh mục 
    $data = array(
        'list_post' => $list_post,
        'key' => $key,
    );
    load_view('searchPost', $data);
}
