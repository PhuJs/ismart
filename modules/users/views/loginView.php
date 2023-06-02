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
        <h1 class="register_title">Đăng Nhập</h1>
        <form action="" id="form_login" method="POST">
            <label for="">Tên đăng nhập</label>
            <input type="text" name="username" value="<?php set_value('username');?>">
            <?php echo form_error('username'); ?>
            <label for="">Mật khẩu</label>
            <input type="password" name="password">
            <?php echo form_error('password'); ?>
            <input type="submit" name="btn_login" value="Đăng nhập" id="btn_login">
            <?php echo form_error('login');?>
            <p class="support"><a href="?mod=users&controller=index&action=reset">Quên mật khẩu</a>|<a href="?mod=users&controller=index&action=regis">Đăng ký tài khoản</a></p>
        </form>
    </div>
</body>
</html>