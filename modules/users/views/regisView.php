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
    <div id="wp_register">
        <h1 class="register_title">Đăng Ký</h1>
        <form action="" id="form_register" method="POST">
            <label for="">Họ và tên</label>
            <input type="text" name="fullName" value="<?php echo set_value('fullName'); ?>" placeholder="Fullname">
            <?php echo form_error('fullName');?>
            <label for="">Email</label>
            <input type="email" name="email" value="" placeholder="Email">
            <?php echo form_error('email');?> 
            <label for="">Tên đăng nhập</label>
            <input type="text" name="username" value="<?php echo set_value('username');?>" placeholder="Username">
            <?php echo form_error('username');?>
            <label for="">Mật khẩu</label>
            <input type="password" name="password" placeholder="Password">
            <?php echo form_error('password'); ?>
            <input type="submit" name="btn_register" value="Đăng ký" id="btn_register">
            <a href="?mod=users&controller=index&action=login" class="back_to">Trở về đăng nhập</a>
        </form>
        <?php echo form_error('acount'); ?>
    </div>
</body>
</html>