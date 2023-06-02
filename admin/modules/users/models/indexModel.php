<?php

// Kiểm tra thông tin đăng nhập
function check_account($username, $password)
{
    $num_rows = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    if ($num_rows > 0)
        return true;
    return false;
}

// Cập nhật thông tin User
function update_info_user($data, $username)
{
    $result = db_update("`tbl_users`", $data, "`username` = '{$username}'");
    if ($result > 0) return true;
    return false;
}

// Kiểm tra User
function check_user($username, $password)
{
    $result = db_num_rows("SELECT * FROM `tbl_users` WHERE  `username` = '{$username}' AND `password` = '{$password}'");
    if ($result > 0)
        return true;
    return false;
}

// Lấy thông tin users
function get_user($username)
{
    $user = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $user;
}

// Kiểm tra tài khoản qua với username
function check_user_by_username($username)
{
    $result = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    if ($result > 0)
        return true;
    return false;
}

// Lấy danh sách users
function get_list_users(){
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}