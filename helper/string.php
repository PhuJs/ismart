<?php

function render_mail($fullname, $address, $phone, $total, $list_product)
{
    $total_money = currency_format($total);
    $html_mail = "<!DOCTYPE html>
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f2f2f2;
            }
            
            h1 {
                color: darkcyan;
                text-align: center;
            }
            
            p {
                color:#333333;
                margin-bottom: 20px;
            }

            span{
                color:darkorange;
            }
            
            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: #fff;
                text-decoration: none;
                border-radius: 4px;
            }

            table{
                border:1px solid #ccc;
                text-align:center;
            }

            th, td{
                padding:8px 16px;
                border:1px solid #666;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Chào mừng đến với ISMART</h1>
            <p>Xin chào, {$fullname} chúc mừng bạn đã đặt hàng thành công, đơn hàng của bạn đang được ghi nhận và trong quá trình thanh toán</p>
            <p>Thông tin đơn hàng bạn vừa đặt</p>
            <p>Tên khách hàng: <span>{$fullname}</span></p>
            <p>Địa chỉ: <span>{$address}</span></p>
            <p>Số điện thoại: <span>{$phone}</span></p>
            <p>Tổng tiền đơn hàng: <span>{$total_money}</span></p>
            <p>Chi tiết đơn hàng</p>
            <table cellspacing='0'>
                <thead>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng mua</th>
                </thead>
                <tbody>
                ";
    foreach($list_product as $item) {
        $money = currency_format($item['price']);
        $html_mail .= "<tr>";
        $html_mail .= "<td>{$item['code']}</td>";
        $html_mail .= "<td>{$item['title']}</td>";
        $html_mail .= "<td>{$money}</td>";
        $html_mail .= "<td>{$item['qty']}</td>";
        $html_mail .= "</tr>";
    };

    $html_mail .= "</tbody>
            </table>
            <p>Cảm ơn bạn đã trở thành khách hàng của chúng tôi. Chúng tôi rất hân hạnh được phục vụ bạn.</p>
            <p>Nếu bạn có bất kỳ câu hỏi nào hoặc cần hỗ trợ, xin vui lòng liên hệ với chúng tôi qua <span>hotline: 0702988414</span> để được giải đáp thắc mắc và hỗ trợ kịp thời</p>
            <p>
                <a href='https://example.com' class='button'>Link truy cập website của chúng tôi</a>
            </p>
        </div>
    </body>
    </html>";
    return $html_mail;
}

function render_status($num){
    $arr_status = array(1 => "Thanh toán tại của hàng", 2 =>"Thanh toán tại nhà");
    return $arr_status[$num];
}