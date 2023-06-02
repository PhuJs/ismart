<?php

use SebastianBergmann\Diff\Diff;

function construct()
{
    load_model('index');
}

// =========== ĐƠN HÀNG ==========
// Danh sách đơn hàng
function indexAction()
{
    // Lấy số liệu đơn của các đơn hàng
    // -- Order Success--
    $order_success = get_order_success();
    // -- Đang xử lí -- 
    $order_processing = get_order_processing();
    // -- Bị hủy, trả hàng
    $order_failure = get_order_failure();
    // Doanh số 
    $sales = get_sales_orders();
    // Các trạng thái của đơn hàng
    $list_status = get_status_order();
    // Số đơn hàng trong thùng rác
    $orders_trash = get_orders_trash();
    // Số đơn hàng chờ xác nhận
    $orders_confirmation = get_order_confirmation();


    // Lấy tổng số đơn hàng trong bảng
    $total_order = get_total_order();
    // Số đơn hàng trên trang
    $num_per_page = 10;
    // Tổng số trang
    $num_page = ceil($total_order / $num_per_page);
    $id = isset($_GET['id']) ? $_GET['id'] : 1;
    $start = ($id - 1) * $num_per_page;
    // Lấy đơn hàng hiển hiện trên 1 trang
    $list_order = list_order_in_page($start, $num_per_page);
    $data = array(
        'order_success' => $order_success,
        'order_processing' => $order_processing,
        'order_failure' => $order_failure,
        'sales' => $sales,
        'list_order' => $list_order,
        'total_order' => $total_order,
        'num_page' => $num_page,
        'list_status' => $list_status,
        'orders_trash' => $orders_trash,
        'orders_confirmation' => $orders_confirmation,
    );
    load_view('index', $data);
}

// Chi tiết đơn hàng
function orderDetailAction()
{
    $key = isset($_GET['key'])?$_GET['key']:"Thành Phố";
    $arr = array(1 => "index", 2 => "trash", 3 => "orderConfirm", 4 => "searchOrder&key={$key}");
    // Id của action đơn hàng đang tồn tại
    $action_pr = (int)$_GET['pr'];

    $action = $arr[$action_pr];
    $id = $_GET['id'];
    // Lấy đơn hàng theo Id
    $order_item = get_order_by_id($id);
    // Lấy danh sách chi tiết của đơn hàng
    $order_detail = get_detail_order($id);
    // Lấy danh sách trạng thái đơn hàng
    $status_order = get_status_order();
    $map = $_GET['map'];
    $data = array(
        'order_item' => $order_item,
        'order_detail' => $order_detail,
        'status_order' => $status_order,
        'map' => $map,
        'action' => $action,
    );
    load_view('orderDetail', $data);
}

// Cập nhật trạng thái đơn hàng theo Id
function updateStatusAction()
{
    // Trạng thái cần thay đổi
    $status = $_POST['status'];
    // Id của đơn hàng
    $order_id = $_POST['order_id'];
    $data = array(
        'status_id' => $status,
    );
    $result = update_status_order_by_id($data, $order_id);
}

// Áp dụng trạng thái cho nhiều đơn hàng
function changeStatusAction()
{
    // Trạng thái cần thay đổi
    $status_id = $_POST['status_id'];

    // Danh sách đơn hàng cần thay đổi trạng thái
    $check_order = $_POST['check_order'];

    // Thuộc tính và giá trị cập nhật
    if ($status_id > 0) {
        $str_value = implode(", ", $check_order);
        $data = array(
            'status_id' => $status_id,
        );

        update_status_orders_by_check($data, $str_value);
    }
}

// Cho đơn hàng vào thùng rác
function thrownTrashAction()
{
    $key = isset($_GET['key'])?$_GET['key']:"Thành Phố";
    $arr = array(1 => "index", 2 => "searchOrder&key={$key}");
    $ac = $_GET['ac'];

    // Id đơn hàng
    $id = $_GET['id'];
    // Trang của đơn hàng đang tồn tại
    $page = $_GET['map'];
    $action = $arr[$ac];
    $result = order_in_the_trash($id);
    if ($result > 0) {
        redirect_to("?mod=sell&controller=index&action={$action}&id={$page}");
    };
}

// Thùng rác
function trashAction()
{   // Tổng số lượng đơn hàng trong thùng rác
    $num_order_trash = get_num_order_trash();
    $num_per_page = 10;
    $num_page = ceil($num_order_trash / $num_per_page);
    // Lấy danh sách sản phẩm trong thùng rác

    $id = isset($_GET['id']) ? $_GET['id'] : 1;
    $start = ($id - 1) * $num_page;
    $list_order_trash = get_list_orders_trash($start, $num_per_page);
    $data = array(
        'list_order_trash' => $list_order_trash,
        'num_page' => $num_page,
        'num_order_trash' => $num_order_trash,
    );
    load_view('trash', $data);
}

// Cập nhật thông tin khách hàng
function updateCustomerAction()
{
    $key = isset($_GET['key'])?$_GET['key']:"Thành Phố";
    $arr = array(1 => "index", 2 => "orderConfirm", 3 => "searchOrder&key={$key}");
    // Id của action đơn hàng đang tồn tại
    $action_pr = (int)$_GET['pr'];

    $id = $_GET['id'];
    $page = $_GET['map'];
    $action = $arr[$action_pr];
    // Validation form
    global $error;
    if (isset($_POST['btn_update_customer'])) {
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không để trống họ và tên khách hàng";
        } else {
            $fullname = $_POST['fullname'];
        }

        $email = $_POST['email'];

        if (empty($_POST['tel'])) {
            $error['tel'] = "Không để trống số điện thoại khách hàng";
        } else {
            if (!is_tel($_POST['tel'])) {
                $error['tel'] = "Số điện thoại chưa đúng định dạng";
            } else {
                $tel = $_POST['tel'];
            }
        }

        if (empty($_POST['address'])) {
            $error['address'] = "Cung cấp địa chỉ khách hàng";
        } else {
            $address = $_POST['address'];
        }

        if (empty($error)) {
            $data = array(
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $tel,
                'address' => $address,
            );
            $result = update_infor_customer($data, $id);
            if ($result > 0) {
                redirect_to("?mod=sell&controller=index&action={$action}&id={$page}");
            }
        }
    }
    // Lấy bản ghi đơn hàng theo id 
    $customer = get_order_by_id($id);
    $data = array(
        'customer' => $customer,
        'action' => $action,
        'page' => $page,
    );
    load_view('updateCustomer', $data);
}

// Xóa các đơn hàng được chọn
function deleteAllAction()
{
    $request = $_GET['request'];
    $list_order = $_GET['list_order'];
    // Tạo chuỗi các id của đơn hàng
    $str_id = implode(", ", $list_order);
    if ($request > 0) {
        // Xóa các bản chi tiết của mỗi đơn hàng
        $flag = true;
        foreach ($list_order as $item) {
            $kq = delete_order_detail("`order_id` = '{$item}'");
            if ($kq < 0) {
                $flag = false;
            }
        };

        if ($flag == true) {
            $result = delete_order("`order_id` IN ($str_id)");
        }
    };
}

// Xóa đơn hàng theo id
function deleteAction(){
    $id = $_GET['id'];
    $result = delete_order_detail("`order_id` = {$id}");
    if($result > 0){
        $kq = delete_order("`order_id` = {$id}");
        if($kq > 0){
            redirect_to("?mod=sell&controller=index&action=trash");
        }
    }
}


// Thông tin khách hàng
function inforCustomerAction(){
    $key = isset($_GET['key'])?$_GET['key']:"Nguyễn";
    // Mảng chứa tên các action đơn hàng đang tồn tại
    $arr = array(1 => "index", 2 => "trash", 3 => "orderConfirm", 4 => "searchOrder&key={$key}");
    // Id của action đơn hàng đang tồn tại
    $action_pr = (int)$_GET['pr'];

    $id = $_GET['id'];
    $map = $_GET['map'];
    //Lấy tên action
    $action = $arr[$action_pr];
    $customer = get_order_by_id($id);
    $data = array(
        'customer' => $customer,
        'map' => $map, 
        'action' => $action,
    );
    load_view("infoCustomer", $data);
}

// Đơn hàng chờ xác nhận 
function orderConfirmAction(){
    // Lấy tổng danh sách đơn hàng chờ xác nhận
    $total_order_confirm = get_num_order_confirm();
    $num_per_page = 10;
    $num_page = ceil($total_order_confirm/$num_per_page);

    $id = isset($_GET['id'])?$_GET['id']:1;
    $start = ($id - 1)*$num_per_page;
    // Lấy danh sách đơn hàng chờ xác nhận
    $list_order_confirm = get_list_order_confirm($start, $num_per_page);
    $data = array(
        'list_order_confirm' => $list_order_confirm,
        'num_page' => $num_page,
        'total_order_confirm' => $total_order_confirm,
    );
    load_view("confirm", $data);
}

// Xác nhận đơn hàng 
function confirmOrderAction(){
    // Id đơn hàng
    $id = $_GET['id'];
    // Vị trí trang đơn hàng
    $map = $_GET['map'];

    // Cập nhật trạng thái đơn hàng được xác nhận
    $data = array(
        'status_id' => 3,
    );
    $result = update_status_order_by_id($data, $id);
    if($result > 0){
         redirect_to("?mod=sell&controller=index&action=orderConfirm&id={$map}");
    }
}

// Xác nhận đơn hàng được check
function confirmCheckAction(){
    $request = $_GET['request'];
    $list_order = $_GET['arr_confirm'];
    $str_id_order = implode(", ", $list_order);
    if($request > 0){
        // Cập nhật những đơn hàng được chọn thành trạng thái đã xác nhận
        $data = array(
            'status_id' => 2,
        );
       $result = update_order_confirm($data, $str_id_order);
    }
}

// Hiển thị thông tin khách hàng được tìm kiếm
function searchOrderAction(){
    // Lấy số liệu đơn của các đơn hàng
    // -- Order Success--
    $order_success = get_order_success();
    // -- Đang xử lí -- 
    $order_processing = get_order_processing();
    // -- Bị hủy, trả hàng
    $order_failure = get_order_failure();
    // Doanh số 
    $sales = get_sales_orders();
    // Các trạng thái của đơn hàng
    $list_status = get_status_order();
    // Số đơn hàng trong thùng rác
    $orders_trash = get_orders_trash();
    // Số đơn hàng chờ xác nhận
    $orders_confirmation = get_order_confirmation();


    $key = $_GET['key'];
    // Tổng đơn hàng được tìm thấy
    $total_order = get_total_order_by_key($key);
    $num_per_page = 10;
    $num_page = ceil($total_order/$num_per_page);
    $id = isset($_GET['id'])?$_GET['id']:1;
    $start = ($id - 1)*$num_per_page;
    // Tìm đơn hàng theo từ khóa xác định
    $list_order = get_order_by_key($key, $start, $num_per_page);
    $data = array(
        'list_order' => $list_order,
        'order_success' => $order_success,
        'order_processing' => $order_processing,
        'order_failure' => $order_failure,
        'sales' => $sales,
        'orders_confirmation' => $orders_confirmation,
        'orders_trash' => $orders_trash,
        'list_status' => $list_status,
        'total_order' => $total_order,
        'num_page' => $num_page,
        'key' => $key,
    );
    load_view('searchOrder', $data);
}


// ============ KHÁCH HÀNG ==========
// Danh sách khách hàng
function customerListAction()
{
    // Lấy số lượng khách hàng trong hệ thống
    $total_customer = get_total_customer();
    $num_per_page = 10;
    $num_page = ceil($total_customer/$num_per_page);

    $id = isset($_GET['id'])?$_GET['id']:1;
    $start = ($id - 1)*$num_per_page;
    // Lấy danh sách khách hàng trên trang
    $list_customer = get_list_customer($start, $num_per_page);
    $data = array(
        'list_customer' => $list_customer,
        'num_page' => $num_page,
        'total_customer' => $total_customer,
    );
    load_view('customerList', $data);
}

// Tìm kiếm khách hàng
function searchCustomerAction(){
    $key = $_GET['id'];
    // Tìm kiếm thông tin khách hàng dựa trên dữ liệu đã cho
    $list_customer = search_customer_by_data($key);
    $data = array(
        'list_customer' => $list_customer,
        'key' => $key,
    );
    load_view('customerSearch', $data);
}

// Cập nhật thông tin khách hàng theo nhóm
function updateCustomerGpAction(){
    $arr = array(1 => "customerList", 2 => "searchCustomer", 3 => "listCustomerNew", 4 => "listCustomerVip");
    $index = $_GET['pr']; 
    $id = $_GET['id'];
    $map = $_GET['map'];
    $action = $arr[$index];
    // Lấy đơn hàng chứa Id
    $order = get_order_by_id($id);
    // Lấy thông tin khách hàng trong đơn hàng làm mẫu
    $order_fullname = $order['fullname'];
    $order_tel = $order['phone_number'];
    $order_address = $order['address'];
    
    // Validation form
    global $error;
    if(isset($_POST['btn_update_customer'])){
        $error = array();
        if(empty($_POST['fullname'])){
            $error['fullname'] = "Không để trống tên";
        }else{
            $fullname = $_POST['fullname'];
        }

        $email = $_POST['email'];

        if(empty($_POST['tel'])){
            $error['tel'] = "Không để trống số điện thoại";
        }else{
            if(!is_tel($_POST['tel'])){
                $error['tel'] = "Số điện thoại không hợp lệ";
            }else{
                $tel = $_POST['tel'];
            }
        }

        if(empty($_POST['address'])){
            $error['address'] = "Trống địa chỉ";
        }else{
            $address = $_POST['address'];
        }

        if(empty($error)){
            $data = array(
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $tel,
                'address' => $address,
            );
            $str_where = "`fullname` = '{$order_fullname}' AND `phone_number` = '{$order_tel}' AND `address` = '{$order_address}'";
            $result = update_info_customer_group_by($data, $str_where);
            if($result > 0){
                redirect_to("?mod=sell&controller=index&action={$action}&id={$map}");
            };
        };
    };

    // View cập nhật thông tin khách hàng
    $data = array(
        'customer' => $order,
        'map' => $map,
        'action' => $action,
    );
    load_view('updateCustomerGp', $data);
}

// Liệt kê nhóm khách hàng mới
function listCustomerNewAction(){
    // Lấy chuỗi timestamp hiện tại
    // Lấy chuỗi timestamp của 5 ngày trước
    $present_time = time();
    $past_time = strtotime(' -5 days', $present_time);

    // Tổng số lượng khách hàng gần đây
    $total_customer = get_total_customer_by_day($past_time);
    $num_per_page = 10;
    $num_page = ceil($total_customer/$num_per_page);
    $id = isset($_GET['id'])?$_GET['id']:1;
    $start = ($id - 1)*$num_per_page;
    //Lấy danh khách hàng 5 ngày gần đây
    $list_customer = get_list_customer_by_day($past_time, $start, $num_per_page);
    $data = array(
        'list_customer' => $list_customer,
        'num_page' => $num_page,
        'total_customer' => $total_customer,
    );
    load_view('customerNew', $data);
}


// Liệt kê khách hàng tiềm năng (Đã mua hàng từ 10 ngày trở lại và số đơn hàng trên 2 đơn)
function listCustomerVipAction(){
    $present_time = time();
    $past_time = strtotime(' -10 days', $present_time);
    $list_customer = get_customer_potential($past_time);
    $data = array(
        'list_customer' => $list_customer,
    );
    load_view("customerVip", $data);
}




