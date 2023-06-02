<?php
function construct()
{
    load_model('index');
}

// Hiển thị danh sách slider
function indexAction()
{
    // Lấy dữ liệu slider
    $list_slider = get_list_slider();
    // Lấy tổng slider trong thùng rác (slider in trash)
    $slider_trash = get_slider_trash();
    $data = array(
        'list_slider' => $list_slider,
        'slider_trash' => $slider_trash,
    );
    load_view('index', $data);
}

// Thêm slider
function add_sliderAction()
{
    global $error;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Tiêu đề trống";
        } else {
            $title = $_POST['title'];
        }

        $slug = $_POST['slug'];
        $desc = $_POST['desc'];
        $num = $_POST['num'];

        $upload_dir = "public/hinhanh/";
        $upload_file = $upload_dir . $_FILES['file']['name'];
        $format_file = array("jpg", 'png', 'jpeg', 'gif');
        $file_ex = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($file_ex), $format_file)) {
            $file_size = $_FILES['file']['size'];
            if ($file_size > 20000000) {
                $error['file_error'] = "File quá kích thướt cho phép";
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

        if ($_POST['status'] == 0) {
            $error['status'] = "Trạng thái không phù hợp";
        } else {
            $status = $_POST['status'];
        }

        if (empty($error)) {
            // Chuẩn bị dữ liệu thêm vào Database
            $data = array(
                'title' => $title,
                'description' => $desc,
                'link' => $slug,
                'num' => $num,
                'status' => $status,
                'image' => $upload_file,
                'user_created' => user_login(),
                'time' => time(),
            );

            // Viết hàm thêm slider vào bảng dữ liệu
            $result = add_slider($data);
            if ($result > 0) {
                redirect_to("?mod=sliders&controller=index&action=success");
            }
        }
    }

    load_view('add_slider');
}

// Thông báo thành công
function successAction()
{
    load_view('success');
}

// Cập nhật trạng thái slider được lựa chọn
function update_status_sliderAction()
{
    $status = $_GET['status'];
    $list_checked = $_GET['list_checked'];
    $list_check_slider = implode(", ", $list_checked);
    $result = update_status_slider($status, $list_check_slider);
    echo $result;
}

// Danh sách slider trong thùng rác
function list_slider_trashAction()
{
    // Lấy danh sách slider trong thùng rác
    $list_slider = get_slider_trash();
    $data = array(
        'list_slider' => $list_slider,
    );
    load_view('trash', $data);
}

// Cập nhật slider
function update_sliderAction()
{
    // Lấy id slider cần cập nhật
    $id = $_GET['id'];
    global $error;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Tiêu đề trống";
        } else {
            $title = $_POST['title'];
        }

        $slug = $_POST['slug'];
        $desc = $_POST['desc'];
        $num = $_POST['num'];

        $upload_dir = "public/hinhanh/";
        $upload_file = $upload_dir . $_FILES['file']['name'];
        $format_file = array("jpg", 'png', 'jpeg', 'gif');
        $file_ex = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($file_ex), $format_file)) {
            $file_size = $_FILES['file']['size'];
            if ($file_size > 20000000) {
                $error['file_error'] = "File quá kích thướt cho phép";
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

        if ($_POST['status'] == 0) {
            $error['status'] = "Trạng thái không phù hợp";
        } else {
            $status = $_POST['status'];
        }

        if (empty($error)) {
            // Chuẩn bị dữ liệu cập nhật vào Database
            $data = array(
                'title' => $title,
                'description' => $desc,
                'link' => $slug,
                'num' => $num,
                'status' => $status,
                'image' => $upload_file,
                'user_created' => user_login(),
            );

            // Viết hàm cập nhật slider theo Id
            $result = update_slider_by_id($data, $id);
            if ($result > 0) {
                redirect_to("?mod=sliders&controller=index&action=success");
            }
        }
    }

    $slider = get_slider_by_id($id);
    $data = array(
        'slider' => $slider,
    );
    load_view('add_slider', $data);
}

// Đưa slider vào thùng rác
function add_trash_sliderAction()
{
    $id = $_GET['id'];
    // Cập nhật slider với id bên trên vào trạng thái thùng rác
    $result = add_slider_trash($id);
    if($result > 0){
        redirect_to("?mod=sliders&controller=index&action=index");
    }
}

// Xóa slider (delete slider)
function delete_sliderAction(){
   $id = $_GET['id'];
   // Xóa slider theo id
   $result = delete_slider($id);
   if($result > 0){
    redirect_to("?mod=sliders&controller=index&action=list_slider_trash");
   }
}