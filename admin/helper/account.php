<?php
// Hàm kiểm tra login
function check_login()
{
    if (isset($_SESSION['is_login']))
        return true;
    return false;
}

function user_login()
{
    if (isset($_SESSION['user_login']))
        return $_SESSION['user_login'];
}
