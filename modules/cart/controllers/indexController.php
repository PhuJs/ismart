<?php
function construct()
{
    load_model('index');
    load('helper', 'string');
}

function indexAction()
{
    $list_cart_product = array();
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']['buy'] as $item) {
            $list_cart_product[] = $item;
        }
    }
    $data = array(
        'list_cart_product' => $list_cart_product,
    );
    load_view('index', $data);
}

// Thêm sản phẩm vào giỏ hàng
function addAction()
{
    $id = (int)$_POST['value'];

    // Lấy sản phẩm theo Id
    $product = get_product_by_id($id);

    $qty = 1;
    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng hay chưa
    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        $qty += $_SESSION['cart']['buy'][$id]['qty'];
    }

    $_SESSION['cart']['buy'][$id] = array(
        'id' => $product['product_id'],
        'title' => $product['product_name'],
        'thumb' => $product['product_thumb'],
        'cat_name' => $product['cat_name'],
        'price' => $product['product_price'],
        'code' => $product['product_code'],
        'qty' => $qty,
        'sub_total' => $product['product_price'] * $qty,
    );

    update_cart();
    echo get_num_product_cart();
}

// Cập nhật giỏ hàng
function updateAction()
{
    $id = $_POST['id'];
    $qty = $_POST['qty'];

    $item = get_product_by_id($id);
    // Lấy sản phẩm theo id
    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {

        $_SESSION['cart']['buy'][$id]['qty'] = $qty;
        $sub_total = $item['product_price'] * $qty;

        $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;

        update_cart();

        // Lấy giá trị và chuyển định dạng format
        $total = get_total_cart();
        $str_sub = currency_format($sub_total);
        $str_total = currency_format($total);
        $data = array(
            'sub_total' => $str_sub,
            'total' => $str_total,
        );
        echo json_encode($data);
    }
}

// Xóa tất cả giỏ hàng
function deleteAllAction()
{
    unset($_SESSION['cart']);
    redirect_to("gio-hang/chi-tiet-gio-hang");
}

// Xóa sản phẩm trong giỏ hàng
function deleteAction()
{
    $id = $_GET['id'];

    // Xóa sản phẩm trong giỏ hàng trong Id
    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        unset($_SESSION['cart']['buy'][$id]);
        update_cart();
        redirect_to("gio-hang/chi-tiet-gio-hang");
    }
}

// Kiểm tra thông tin đặt hàng
function checkoutAction()
{
    // Lấy sản phẩm trong giỏ hàng
    $list_product = get_product_cart();

    // Tổng tiển đơn hàng
    $total = get_total_cart();

    // Tổng số sản phẩm trong giỏ hàng
    $num_order = get_num_product_cart();

    global $error, $fullname, $phone, $address, $email, $note, $province;
    if (isset($_POST['order-submit'])) {
        // Kiểm tra thông tin nhập vào
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Vui lòng cung cấp tên của bạn";
        } else {
            $fullname = $_POST['fullname'];
        }

        $email = $_POST['email'];

        
        if (empty($_POST['phone'])) {
            $error['phone'] = "Vui lòng cung cấp số điện thoại liên hệ";
        } else {
            if (!is_phone($_POST['phone'])) {
                $error['phone'] = "Số điện thoại không hợp lệ";
            } else {
                $phone = $_POST['phone'];
            }
        }

        if($_POST['province'] == 0){
            $error['province'] = "Chọn Tỉnh hoặc Thành Phố cụ thể";
        }else{
            $province = $_POST['province']; 
        }

        if($_POST['district'] == 0){
            $error['district'] = "Chọn Quận Huyện cụ thể";
        }else{
            $district = $_POST['district'];
        }

        if($_POST['wards'] == 0){
            $error['wards'] = "Chọn Xã Phường cụ thể";
        }else{
            $wards = $_POST['wards'];
        }

        $address = $_POST['address'];

        $note = $_POST['note'];

        $pay_method = $_POST['payment-method'];
     

        if (empty($error) && !empty($list_product)) {
            // Chuẩn bị dữ liệu truyền lên Database
            $province_name = get_province_name($province);
            $district_name = get_district_name($district);
            $wards_name = get_wards_name($wards);
            $address_name = !empty($address)?$address.", ": "";            
            $str_address = $address_name.$wards_name.", ".$district_name.", ".$province_name;
            $data = array(
                'fullname' => $fullname,
                'code_orders' => "ISMART#".time(),
                'email' => $email,
                'phone_number' => $phone,
                'address' => $str_address,
                'note' => $note,
                'order_date' => time(),
                'num_order' => $num_order,
                'total_money' => $total,
                'pay_method' => $pay_method,
                'list_product' => json_encode($list_product),
            );
            // Thêm đơn hàng vào CSDL
            $result = add_order($data);

            if ($result > 0) {
                $flag = true;
                foreach ($list_product as $item) {
                    $data_detail = array(
                        'order_id' => $result,
                        'product_id' => $item['id'],
                        'price' => $item['price'],
                        'num' => $item['qty'],
                        'total_money' => $item['price'] * $item['qty'],
                    );

                    $check = add_order_detail($data_detail);
                    if ($check <= 0)
                        $flag = false;
                }

                if ($flag == true) {

                    if (!empty($email)) {
                        $subject = "Xác nhận đặt hàng thành công";
                        $content = render_mail($fullname, $str_address, $phone, $total, $list_product);
                        send_mail($email, $fullname, $subject, $content);
                    }

                    redirect_to("gio-hang/thong-bao/dat-hang-thanh-cong-don-hang-{$result}");
                } else {
                    $error['add_order'] = "Lỗi quá trình xác nhận đơn hàng";
                }
            } else {
                $error['add_order'] = "Lỗi quá trình xác nhận đơn hàng";
            }
        } 
    }

    // Lấy danh sách tỉnh, thành phố
    $list_province = get_list_province();
    $data = array(
        'list_product' => $list_product,
        'total' => $total,
        'list_province' => $list_province
    );
   
    load_view('checkout', $data);
}

// Thực hiện mua ngay
function buyNowAction()
{
    // Lấy id 
    $id = (int)$_GET['id'];

    // Lấy sản phẩm theo Id;
    $item = get_product_by_id($id);
    $qty = 1;
    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        $qty += $_SESSION['cart']['buy'][$id]['qty'];
    }

    $_SESSION['cart']['buy'][$id] = array(
        'id' => $item['product_id'],
        'title' => $item['product_name'],
        'thumb' => $item['product_thumb'],
        'cat_name' => $item['cat_name'],
        'price' => $item['product_price'],
        'code' => $item['product_code'],
        'qty' => $qty,
        'sub_total' => $item['product_price'] * $qty,
    );

    update_cart();

    redirect_to("gio-hang/chi-tiet-gio-hang");
}


function successAction()
{
    // Lấy danh sách sản phẩm trong giỏ hàng rồi xóa giỏ hàng
    $list_product = get_product_cart();
    unset($_SESSION['cart']);

    // Lấy id đơn hàng 
    $id = $_GET['id'];
    // Lấy dữ liệu đơn hàng theo Id
    $order = get_order_by_id($id);

    $data = array(
        'order' => $order,
        'list_product' => $list_product,
    );
    load_view('success', $data);
}

// Lấy danh sách quận huyện của tỉnh thành phố
function districtAction(){
    $province_id = $_POST['province_id'];

    // Lấy danh sách quận huyện theo id tỉnh, thành phố
    $list_district = get_list_district($province_id); 
    $data[0] = array(
        'id' => 0,
        'name' => "--- Chọn ---",
    );
    foreach($list_district as $item){
        $data[] = array(
            'id' => $item['district_id'],
            'name' => $item['name'],
        );
    }
    echo json_encode($data);
   
}

// Lấy danh sách phường xã
function wardsAction(){
    $district_id = $_POST['district_id'];
    // Lấy danh sách xã phường
    $list_wards = get_list_wards($district_id);
    $data[0] = array(
        'id' => 0,
        'name' => '-- Chọn --'
    );
    foreach($list_wards as $item){
        $data[] = array(
            'id' => $item['wards_id'],
            'name' => $item['name'],
        );
    };
    echo json_encode($data);
}