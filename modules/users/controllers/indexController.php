
<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'validation');
}

function indexAction()
{
    // load_view('login');
    echo "Action chủ thể";
}

function loginAction()
{
    global $error, $username, $password;
    if (isset($_POST['btn_login'])) {
        $error = array();
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập chưa đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }

        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu bắt đầu bằng ký tự viết hoa";
            } else {
                $password = md5($_POST['password']);
            }
        }

        if (empty($error)) {
            if (check_login($username, $password)) {
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                redirect_to();
            } else {
                $error['login'] = "Tài khoản chưa tồn tại";
            }
        }
    }
    load_view('login');
}

function regisAction()
{
    global $error, $username, $email, $password, $fullName;
    if (isset($_POST['btn_register'])) {
        $error = array();
        if (empty($_POST['fullName'])) {
            $error['fullName'] = "Họ và tên không để trống";
        } else {
            $fullName = $_POST['fullName'];
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Email không được để trống";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email nhập chưa đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }

        if (empty($_POST['username'])) {
            $error['username'] = "Tên đăng nhập không được để trống";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập gồm 6 đến 32 kí tự không in hoa";
            } else {
                $username = $_POST['username'];
            }
        }

        if (empty($_POST['password'])) {
            $error['password'] = "Mật khẩu không được để trống";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu bắt đầu bằng kí tự viết hoa";
            } else {
                $password = md5($_POST['password']);
            }
        }

        if (empty($error)) {
            echo update_count();
            global $config;
            if (user_exist($username, $email)) {
                $active_token = md5($username . time());
                $date = getdate();
                $timestamp = $date['hours'];
                $data = array(
                    'fullname' => $fullName,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'active_token' => $active_token,
                    'regis_time' => $timestamp,
                );
                $link_active = base_url("?mod=users&controller=index&action=active&active_token={$active_token}");
                $subject = "Xác nhận thông tin đăng kí tài khoản";
                $content = "Chào bạn {$fullName} bạn vui lòng nhấn vào đường link xác nhận thông tin đăng kí tài khoản <a href='{$link_active}'>Nhấn vào đây để xác nhận thông tin tài khoản</p>";
                if (add_user($data) > 0) {
                    // send_mail($email, $fullName, $subject, $content);
                    redirect_to("?mod=users&controller=index&action=active&active_token={$active_token}");
                }
            } else {
                $error['acount'] = "Tài khoản đã tồn tại";
            }
        }
    }
    load_view('regis');
}


function activeAction()
{
    $active_token = $_GET['active_token'];
    $result = active_user($active_token);
    if ($result > 0) {
        echo "Tài khoản được xác thực thành công <a href='?mod=users&controller=index&action=index'>Quay lại</a>";
    } else {
        echo "Xác thực tài khoản không thành công";
    }
}

function logoutAction()
{
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect_to("?mod=users&controller=index&action=login");
}

function resetAction()
{
    global $error, $email, $password;
    // $reset_token = $_GET['reset_token'];
    if (!empty($_GET['reset_token'])) {
        $reset_token = $_GET['reset_token'];
        if(check_reset_token($reset_token)){
            if(isset($_POST['btn_newPass'])){
                $error = array();
                if(empty($_POST['password'])){
                    $error['password'] = "Dữ liệu trống";
                }else{
                    if(!is_password($_POST['password'])){
                        $error['password'] = "Mật khẩu nhập vào không đúng định dạng";
                    }else{
                        $password = md5($_POST['password']);
                    }
                }

                if(empty($_POST['re_password'])){
                    $error['re_password'] = "Dữ liệu trống";
                }else{
                    if(!is_password($_POST['re_password'])){
                        $error['re_password'] = "Mật khẩu nhập vào chưa đúng định dạng";
                    }else{
                        $re_password = md5($_POST['re_password']);
                    }
                }

                if(empty($error)){
                    if($password == $re_password){
                        $data = array(
                            'password' => $password,
                        );
                       $result =  (int)update_password($data, "`reset_token` = '{$reset_token}'");
                       if($result > 0){
                         redirect_to("?mod=users&controller=index&action=resetOk&id=1");
                       }else{
                         redirect_to("?mod=users&controller=index&action=resetOk&id=2");
                       }
                    }else{
                        $error['newpass'] = "Mật khẩu nhập vào không trùng khớp";
                    }
                }
            }
            load_view('newPass');
        }else{
            echo "Mã xác thực không trùng khớp";
        }
    } else {
        if (isset($_POST['btn_reset'])) {
            $error = array();
            if (empty($_POST['email'])) {
                $error['email'] = "Vui lòng nhập vào email";
            } else {
                if (!is_email($_POST['email'])) {
                    $error['email'] = "Email nhập chưa đúng địng dạng";
                } else {
                    $email = $_POST['email'];
                }
            }

            if (empty($error)) {
                if (check_email($email)) {
                    $reset_token = md5($email . time());
                    $data = array(
                        'reset_token' => $reset_token,
                    );
                    $result =  update_reset_token($data, "`email` = '{$email}'");
                    redirect_to("?mod=users&controller=index&action=reset&reset_token={$reset_token}");
                    // $link_reset_token = base_url("?mod=users&controller=index&action=newPass");
                    // $content = "<p>Xin chào anh Phú tôi là Chủ Tịch Quốc Hội Vương Đình Huệ</p>
                    // <p>Hôm nay tôi gửi mail này để xin lỗi anh về mọi việc và trao anh lại quyền sử dụng đất</p>
                    // <p>Xin mời anh click vào đường link bên dưới để nhận lại quyền sử dụng đất của mình <a href='{$link_reset_token}'>Nhấn vào đây ạ</a></p>";
                    // send_mail($email, "Chủ Tịch Quốc Hội Vương Đình Huệ", "Lấy Lại Căn Quyền Sử Dụng Đất", $content);
                } else {
                    $error['empty'] = "Email không tồn tại trên hệ thống";
                }
            }
        }
        load_view('reset');
    }
}


function resetOkAction(){
    $id = (int)$_GET['id'];
    if($id == 1){
        $content = "Thay đổi mật khẩu thành công";
    }else{
        $content = "Thay đổi mật khẩu thất bại";
    }
    $data = array(
        'content' => $content,
    );
    load_view('update', $data);
}
