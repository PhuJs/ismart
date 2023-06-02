<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style.css">
    <title>Form Register</title>
</head>
<body>
    <style>
        body{
            background-color:#2980b9;
        }
    </style>
    <div id="wp_login">
        <h1 class="register_title">Lấy lại mật khẩu</h1>
        <form action="" id="form_login" method="POST">
            <label for="">Nhập email của bạn</label>
            <input type="email" name="email">
            <?php echo form_error('email'); ?>
            <input type="submit" name="btn_reset" value="Gửi email" id="btn_login">
            <?php echo form_error('empty');?>
            <p class="support"><a href="?mod=users&controller=index&action=login">Đăng nhập</a>|<a href="?mod=users&controller=index&action=regis">Đăng ký</a></p>
        </form>
    </div>
</body>
</html>