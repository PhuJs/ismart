<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction(){
    echo "Đã vào modules";
}

// Xử lí đăng nhập
function loginAction(){
    global $error, $username;
    if(isset($_POST['btn_login_admin'])){
        $error = array();
        if(empty($_POST['username'])){
            $error['username'] = "Lỗi để trống tên đăng nhập"; 
        }else{
            if(!is_username($_POST['username'])){
                $error['username'] = "Tên đăng nhập chưa hợp lệ";
            }else{
                $username = $_POST['username'];
            }
        }

        if(empty($_POST['password'])){
            $error['password'] = "Lỗi để trống mật khẩu";
        }else{
            if(!is_password($_POST['password'])){
                $error['password'] = "Mật khẩu bắt đầu bằng kí tự viết hoa";
            }else{
                $password = md5($_POST['password']);
            }
        }

        if(empty($error)){
            // Kiểm tra thông tin đăng nhập
            if(check_account($username, $password)){
                // Thiết lập Login
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                // Chuyển hướng Login
                 redirect_to("?mod=home&controll=index&action=index");
            }else{
                $error['account_empty'] = "Tài khoản không tồn tại";
            }
            
        }
    }
    load_view('login');
}

// Xử lí cập nhật tài khoản
function updateAction(){
    global $error, $fullName, $tel, $address, $email;
    if(isset($_POST['btn_update_admin'])){
        // Đặt cờ hiệu
        $error = array();

        // Validation 
        if(empty($_POST['fullName'])){
            $error['fullName'] = "Lỗi để trống tên hiển thị";
        }else{
            $fullName = $_POST['fullName'];
        }

        if(empty($_POST['email'])){
            $error['email'] = "Lỗi để trống email";
        }else{
            if(!is_email($_POST['email'])){
                $error['email'] = "Email nhập vào chưa đúng định dạng";
            }else{
                $email = $_POST['email'];
            }
        }

        if(empty($_POST['tel'])){
            $error['tel'] = "Lỗi để trống số điện thoại";
        }else{
            if(!is_tel($_POST['tel'])){
                $error['tel'] = "Số điện thoại nhập vào chưa hợp lệ";
            }else{
                $tel = $_POST['tel'];
            }
        }

        if(empty($_POST['address'])){
            $error['address'] = "Lỗi để trống địa chỉ";
        }else{
            $address = $_POST['address'];
        }
        
        if(empty($error)){
            // Kiểm tra user có tồn tại tên CSDL
            if(check_user_by_username(user_login())){
                // Cập nhật dữ liệu mới vào đối tượng
                $data = array(
                    'fullname' => $fullName,
                    'phone_number' => $tel,
                    'address' => $address,
                    'email' => $email,
                );

                if(update_info_user($data, user_login())){
                    redirect_to("?mod=users&controller=index&action=success&id=1");
                }
            }else{
                $error['check_email'] = "Không tồn tại người dùng trên hệ thống";
            }  
        }
    }

    $info_user = get_user(user_login());
    $data['info_user'] = $info_user;
    load_view('update', $data);
}

// Xử lí đổi mật khẩu
function resetAction(){
    global $error;
    if(isset($_POST['btn_update_pass_admin'])){
        $error = array();
        if(empty($_POST['pass-old'])){
            $error['pass-old'] = "Lỗi để trống dữ liệu";
        }else{
            if(!is_password($_POST['pass-old'])){
                $error['pass-old'] = "Dữ liệu nhập vào chưa hợp lệ";
            }else{
                $pass_old = md5($_POST['pass-old']);
            }
        }

        if(empty($_POST['pass-new'])){
            $error['pass-new'] = "Lỗi để trống dữ liệu";
        }else{
            if(!is_password($_POST['pass-new'])){
                $error['pass-new'] = "Dữ liệu nhập vào chưa hợp lệ";
            }else{
                $pass_new = md5($_POST['pass-new']);
            }
        }

        if(empty($_POST['confirm-pass'])){
            $error['confirm-pass'] = "Lỗi để trống dữ liệu";
        }else{
            if(!is_password($_POST['confirm-pass'])){
                $error['confirm-pass'] = "Dữ liệu nhập vào chưa hợp lệ";
            }else{
                $confirm_pass =md5($_POST['confirm-pass']);
            }
        }

        if(empty($error)){
            if(check_user(user_login(), $pass_old)){
                if($pass_new == $confirm_pass){
                    $data = array(
                        'password' => $pass_new, 
                    );
                    if(update_info_user($data, user_login())){
                        redirect_to("?mod=users&controller=index&action=success");
                    }else{
                        $error['pass_error'] = "Cập nhật thất bại";
                    }
                }else{
                    $error['pass_error'] =  "Mật khẩu không trùng khớp";
                }
            }else{
                $error['pass_error'] = "Tài khoản không tồn tại";
            }
        }
    }
    load_view('reset');
}

// Xử lí đăng xuất tài khoản
function logoutAction(){
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect_to("?mod=users&controller=index&action=login");
}

// Hiển thị đổi mật khẩu thành công
function successAction(){
    load_view('success');
}

// Xử lí hiển thị danh sách users
function list_usersAction(){
   // Lấy danh sách users
   $list_users = get_list_users();
   // Xử lí hiển thị 
   $data = array(
    'list_users' => $list_users,
   );
   load_view('index', $data);
}