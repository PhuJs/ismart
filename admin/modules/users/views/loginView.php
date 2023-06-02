<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>

<body>
    <style>
        body {
            background-color: darkcyan;
        }
    </style>
    <div id="wp_form_admin">
        <form action="" method="POST" id="form_login_admin">
            <label for="">Tên đăng nhập</label>
            <input type="text" name="username" value="<?php echo set_value('username'); ?>">
            <?php echo form_error('username');?>
            <label for="">Mật khẩu</label>
            <input type="password" name="password">
            <?php echo form_error('password');?>
            <br>
            <input type="submit" name="btn_login_admin" value="Đăng nhập" id="btn_login_admin">
            <?php echo form_error('account_empty');?>
        </form>
    </div>
</body>

</html>