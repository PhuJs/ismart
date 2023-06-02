$(document).ready(function () {
    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

    //  CHECK ALL
    $('input[name="checkAll"]').click(function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

    // EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });

    $('#btn_update_status').on('click', function (e) {
        let status = $('#select_status_order').val();
        let order_id = $('#select_status_order').attr('data-order');
        $.ajax({
            url: "?mod=sell&controller=index&action=updateStatus",
            method: "POST",
            data: {
                status: status,
                order_id: order_id,
            },
            dataType: "text",
            success: function (data) {
                alert("Cập nhật thành công");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
        e.prevenDefault();
    });

    $('#btn_apdung').on('click', function (e) {
        let status_id = $('#select_status').val();
        let checkbox = $('.checkItem');
        let check_order = [];
        checkbox.each(function () {
            if ($(this).is(':checked')) {
                check_order.push(($(this).attr('data-order-id')));
            }
        });

        if (check_order.length != 0) {
            $.ajax({
                url: "?mod=sell&controller=index&action=changeStatus",
                method: "POST",
                data: {
                    status_id: status_id,
                    check_order: check_order,
                },
                dataType: "text",
                success: function (data) {
                    // alert("Cập nhật thành công");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });

            location.reload();
        }
        // e.preventDefault();
    });

    $('#btn_delete_order').on('click', function () {
        let request = $('#select_delete_order').val();
        let checkbox_list = $('.orderItem');
        let list_order = [];
        checkbox_list.each(function () {
            if ($(this).is(':checked')) {
                list_order.push(($(this).attr('data-order-id')));
            }
        });

        if (list_order.length != 0 && request != 0) {
            $.ajax({
                url: "?mod=sell&controller=index&action=deleteAll",
                method: "GET",
                data: {
                    request: request,
                    list_order: list_order,
                },
                dataType: "text",
                success: function (data) {

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                },
            });
            location.reload();
        }

    });

    $('#btn_confirm').on('click', function () {
        let request = $('#select_confirm').val();
        let list_confirm = $('.confirmItem');
        let arr_confirm = [];
        list_confirm.each(function () {
            if ($(this).is(':checked')) {
                arr_confirm.push($(this).attr('data-order-id'));
            };
        });

        if (arr_confirm.length != 0 && request != 0) {
            $.ajax({
                url: "?mod=sell&controller=index&action=confirmCheck",
                method: "GET",
                data: {
                    request: request,
                    arr_confirm: arr_confirm,
                },
                dataType: "text",
                success: function (data) {
                    // console.log(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
            location.reload();
        }

    });

    // Thay đổi trạng thái sản phẩm

    $('#btn_status_product').on('click', function () {
        // Lấy trạng thái yêu cầu
        let request = $('#select_status_product').val();
        let list_check = $('.checkProductItem');
        let product_id = [];
        list_check.each(function () {
            if ($(this).is(':checked')) {
                product_id.push($(this).attr('data-id'));
            }
        });

        if (product_id.length != 0 && request != 0) {
            $.ajax({
                url: "?mod=products&controller=index&action=change_status_product",
                method: "GET",
                data: {
                    request: request,
                    product_id: product_id,
                },
                dataType: "text",
                success: function (data) {
                    // console.log(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.Status);
                    alert(thrownError);
                }
            });
            location.reload();
        }



    });

    $('#btn_update_status_cat').on('click', function () {
        let request = $('#select_status_cat').val();
        let checkbox = $('.checkItemCat');
        let list_check = [];
        checkbox.each(function () {
            if ($(this).is(':checked')) {
                list_check.push($(this).attr('data-id'));
            }
        });

        if (list_check.length != 0 && request != 0) {
            $.ajax({
                url: "?mod=products&controller=index&action=update_cat_list",
                method: "GET",
                data: {
                    request: request,
                    list_check: list_check,
                },
                dataType: "text",
                success: function (data) {
                    if (data > 0) {
                        location.reload();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.Status);
                    alert(thrownError);
                }
            });

        }

    });

    $('#btn_update_cat_post').on('click', function () {
        let status = $('#select_cat_post').val();
        let list_check_box = $('.check_post_cat_item');
        let list_checked = [];
        list_check_box.each(function () {
            if ($(this).is(':checked')) {
                list_checked.push($(this).attr('data-id'));
            }
        });

        if (list_checked.length != 0 && status != 0) {
            $.ajax({
                url: "?mod=posts&controller=index&action=change_status_cat",
                method: "GET",
                data: {
                    status: status,
                    list_checked: list_checked,
                },
                dataType: "text",
                success: function (data) {
                    if (data > 0) {
                        location.reload();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.Status);
                    alert(thrownError);
                }
            });
        }
    });

    $('#btn_update_status_post').on('click', function () {
        let status = $('#select_status_post').val();
        let list_check = $('.check_item_post');
        let list_checked = [];
        list_check.each(function () {
            if ($(this).is(':checked')) {
                list_checked.push($(this).attr('data-id'));
            }
        });
        if (list_checked.length != 0 && status != 0) {
            $.ajax({
                url: "?mod=posts&controller=index&action=update_status_post",
                method: "GET",
                data: {
                    status: status,
                    list_checked: list_checked,
                },
                dataType: "text",
                success: function (data) {
                    if (data > 0) {
                        location.reload();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.Status);
                    alert(thrownError);
                },
            });
        }
    });

    $('#btn_status_slider').on('click', function () {
        let status = $('#select_status_slider').val();
        let list_check = $('.check_item_slider');
        let list_checked = [];
        list_check.each(function () {
            if ($(this).is(':checked')) {
                list_checked.push($(this).attr('data-id'));
            }
        });

        if (list_checked.length > 0 && status > 0) {
            $.ajax({
                url: "?mod=sliders&controller=index&action=update_status_slider",
                method: "GET",
                data: {
                    status: status,
                    list_checked: list_checked,
                },
                dataType: "text",
                success: function (data) {
                    if (data > 0) {
                        location.reload();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.Status);
                    alert(thrownError);
                }
            });
        }
    });
});

function chosseFile(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#img-upload-thumb").attr('src', e.target.result);
        }
        reader.readAsDataURL(fileInput.files[0]);
    }
};




