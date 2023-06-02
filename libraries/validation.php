<?php

function is_username($username){
    $partent = "/^[A-Za-z0-9_\.]{6,32}$/";
    if(preg_match($partent, $username)){
        return true;
    }
    return false;
}

function is_password($password){
    $partent = "/^([A-Z]{1})([\w_\.!@#$%^&*()]){5,31}$/";
    if(preg_match($partent, $password)){
        return true;
    }
    return false;
}

function is_email($email){
    $partent = "/^([A-Za-z0-9]{3,32})@([A-Za-z]{3,12})(.[a-z]{3,12})$/";
    if(preg_match($partent, $email)){
        return true;
    }
    return false;
}

function form_error($label){
    global $error;
    if(!empty($error[$label]))
        return "<p class='alert_error'> {$error[$label]} </p>";
}

function alert($label){
    global $alert;
    if(!empty($alert[$label]))
    return "<p class='alert_success'> {$alert[$label]} </p>";
}

function set_value($label){
    global $$label;
    if(!empty($$label))
      return $$label;
}

function is_phone($phone){
    $partent = "/^(09|08|07|02|01[2,6,8,9])+([0-9]{8})$/";
    if(preg_match($partent, $phone)){
        return true;
    }
    return false;
}

?>