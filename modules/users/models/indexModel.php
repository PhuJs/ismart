<?php

function get_list_users()
{
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

function user_exist($username, $email)
{
    $flag = true;
    $item = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' OR `email` = '{$email}'");
    if ($item > 0) {
        $flag = false;
    }
    return $flag;
}

function add_user($data)
{
    $result = db_insert('tbl_users', $data);
    return $result;
}

function active_user($active_token)
{
    $num = 0;
    $item = db_num_rows("SELECT * FROM `tbl_users` WHERE `active_token` = '{$active_token}' AND `is_active` = '0'");
    if ($item > 0) {
        $data = array(
            'is_active' => 1
        );
        $num =  db_update('tbl_users', $data, "`active_token` = '{$active_token}'");
    }
    return $num;
}

function update_count()
{
    $result = db_delete('`tbl_users`', "`is_active` = '0'");
    return $result;
}

function check_login($username, $password)
{
    $user = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    if ($user > 0)
        return true;
    return false;
}

function check_email($email)
{
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `email` = '{$email}'");
    if ($check > 0) {
        return true;
    }
    return false;
}

function update_reset_token($data, $where)
{
    $result = db_update("`tbl_users`", $data, $where);
    return $result;
}

function check_reset_token($reset_token)
{
    $result = db_num_rows("SELECT * FROM `tbl_users` WHERE `reset_token` = '{$reset_token}'");
    if ($result > 0) {
        return true;
    }
    return false;
}

function update_password($data, $where)
{
    $result = db_update("`tbl_users`", $data, $where);
    // if ($result > 0)
    //     return true;
    // return false;
    return $result;
}
