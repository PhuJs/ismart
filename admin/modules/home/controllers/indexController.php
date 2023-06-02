<?php
function construct(){
    return true;
}

function indexAction(){
    redirect_to("?mod=sell&controller=index&action=index");
}
?>