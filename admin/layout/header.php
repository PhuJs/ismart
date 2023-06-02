<!DOCTYPE html>
<html>

<head>
    <title>Quản lý ISMART</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/phpmaster/project/ismart.com/admin/">
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />

    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="public/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div class="wp-inner clearfix">
                    <a href="?" title="" id="logo" class="fl-left">ADMIN</a>
                    <ul id="main-menu" class="fl-left">
                        <li>
                            <a href="?page=list_post" title="">Trang</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?" title="">Danh sách trang</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=posts&controller=index&action=listPost" title="">Bài viết</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=posts&controller=index&action=addPost" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?mod=posts&controller=index&action=listPost" title="">Danh sách bài viết</a>
                                </li>
                                <li>
                                    <a href="?mod=posts&controller=index&action=postCat" title="">Danh mục bài viết</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=products&controller=index&action=index" title="">Sản phẩm</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=products&controller=index&action=add" title="">Thêm mới</a>
                                </li>
                                <li>
                                    <a href="?mod=products&controller=index&action=index" title="">Danh sách sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?mod=products&controller=index&action=listCat" title="">Danh mục sản phẩm</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?mod=sell&controller=index&action=index" title="">Bán hàng</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?mod=sell&controller=index&action=index" title="">Danh sách đơn hàng</a>
                                </li>
                                <li>
                                    <a href="?mod=sell&controller=index&action=customerList" title="">Danh sách khách hàng</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?page=menu" title="">Menu</a>
                        </li>
                    </ul>
                    <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                        <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div id="thumb-circle" class="fl-left">
                                <img src="public/images/img-admin.png">
                            </div>
                            <h3 id="account" class="fl-right">Admin</h3>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="?mod=users&controller=index&action=update" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                            <li><a href="?mod=users&controller=index&action=logout" title="Thoát">Thoát</a></li>
                        </ul>
                    </div>
                </div>
            </div>