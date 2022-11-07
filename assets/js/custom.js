jQuery('#frmRegister').on('submit', function (e) {
    jQuery('.error_field').html('');
    jQuery('#register_submit').attr('disabled', true);
    jQuery('#form_msg').html('Please wait...');
    jQuery.ajax({
        url: FRONT_SITE_PATH + 'login_register_submit',
        type: 'post',
        data: jQuery('#frmRegister').serialize(),
        success: function (result) {
            jQuery('#form_msg').html('');
            jQuery('#register_submit').attr('disabled', false);
            var data = jQuery.parseJSON(result);
            if (data.status == 'error') {
                jQuery('#' + data.field).html(data.msg);
            }
            if (data.status == 'success') {
                jQuery('#' + data.field).html(data.msg);
                data: jQuery('#frmRegister')[0].reset();
            }
        }
    });
    e.preventDefailt();
});

jQuery('#frmLogin').on('submit', function (e) {
    jQuery('.error_field').html('');
    jQuery('#login_submit').attr('disabled', true);
    jQuery('#form_login_msg').html('Please wait...');
    jQuery.ajax({
        url: FRONT_SITE_PATH + 'login_register_submit',
        type: 'post',
        data: jQuery('#frmLogin').serialize(),
        success: function (result) {
            jQuery('#form_login_msg').html('');
            jQuery('#login_submit').attr('disabled', false);
            var data = jQuery.parseJSON(result);
            if (data.status == 'error') {
                jQuery('#form_login_msg').html(data.msg);
            }
            var is_checkout = jQuery('#is_checkout').val();
            if (is_checkout == 'yes') {
                window.location.href = 'checkout';
            } else if (data.status == 'success') {
                //jQuery('#form_login_msg').html(data.msg);
                window.location.href = 'home';
            }
        }
    });
    e.preventDefailt();
});

jQuery('#frmForgotPassword').on('submit', function (e) {
    jQuery('#forgot_submit').attr('disabled', true);
    jQuery('#form_forgot_msg').html('Please wait...');
    jQuery.ajax({
        url: FRONT_SITE_PATH + 'login_register_submit',
        type: 'post',
        data: jQuery('#frmForgotPassword').serialize(),
        success: function (result) {
            jQuery('#form_forgot_msg').html('');
            jQuery('#forgot_submit').attr('disabled', false);
            var data = jQuery.parseJSON(result);
            if (data.status == 'error') {
                jQuery('#form_forgot_msg').html(data.msg);
            }
            if (data.status == 'success') {
                jQuery('#form_forgot_msg').html(data.msg);
                //window.location.href='home';
            }
        }
    });
    e.preventDefailt();
});

function set_checkbox(id) {
    var cat_dish_status = $("#_cat_dish_" + id).prop('checked');
    var cat_dish = jQuery('#cat_dish').val();
    //console.log(cat_dish);
    if (cat_dish) {
        var cat_dish_arr = cat_dish.split(",");
        if (!cat_dish_arr.includes(id)) {
            cat_dish_arr.push(id);
        } else {
            if (!cat_dish_status) {
                const index = cat_dish_arr.indexOf(id);
                if (index > -1) {
                    cat_dish_arr.splice(index, 1);
                }
            }
        }
        jQuery('#cat_dish').val(cat_dish_arr.join());
        
    } else {
        jQuery('#cat_dish').val(id);
    }
    jQuery('#frmCatDish')[0].submit();
}

function add_to_cart(id, type) {
    var qty = jQuery('#qty' + id).val();
    var attr = jQuery('input[name="radio_' + id + '"]:checked').val();
    var is_attr_checked = '';
    if (typeof attr === 'undefined') {
        is_attr_checked = 'no';
    }
    if (qty > 0 && is_attr_checked != 'no') {
        jQuery.ajax({
            url: FRONT_SITE_PATH + 'manage_cart',
            type: 'post',
            data: 'qty=' + qty + '&attr=' + attr + '&type=' + type,
            success: function (result) {
                var data = jQuery.parseJSON(result);
                swal("Congratulation!", "Dish added successfully", "success");
                jQuery('#shop_added_msg_' + attr).html('Added -' + qty + ')');
                jQuery('#totalCartDish').html(data.totalCartDish);
                jQuery('#totalPrice').html('Rs.' + data.totalPrice);
                var tp1 = data.totalPrice;

                if (data.totalCartDish == 1) {
                    var tp = qty * data.price;
                    var html = '<div class="shopping-cart-content"><ul id="cart_ul"><li class="single-shopping-cart" id="attr_' + attr + '"><div class="shopping-cart-img"><a href="javascript:void(0)"><img alt="" src="' + SITE_DISH_IMAGE + data.image + '"></a></div><div class="shopping-cart-title"><h4><a href="javascript:void(0)">' + data.dish + '</a></h4><h6>Qty:' + qty + '</h6><span>Rs.' + tp + '</span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick=delete_cart("' + attr + '")><i class="ion ion-close"></i></a></div></li></ul><h4>Total : <span class="shop-total" id="shopTotal">Rs.' + tp + '</span></h4><div class="shopping-cart-btn"><a href="cart">view cart</a><a href="checkout">checkout</a></div></div>';
                    jQuery('.header-cart').append(html);
                } else {
                    var tp = qty * data.price;
                    jQuery('#attr_' + attr).remove();
                    var html = '<li class="single-shopping-cart" id="attr_' + attr + '"><div class="shopping-cart-img"><a href="javascript:void(0)"><img alt="" src="' + SITE_DISH_IMAGE + data.image + '"></a></div><div class="shopping-cart-title"><h4><a href="javascript:void(0)">' + data.dish + '</a></h4><h6>Qty:' + qty + '</h6><span>Rs.' + tp + '</span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick=delete_cart("' + attr + '")><i class="ion ion-close"></i></a></div></li>';
                    jQuery('#cart_ul').append(html);
                    jQuery('#shopTotal').html('Rs.' + tp1);
                }
            }
        });
    } else {
        swal("Error!", "Please select qty and dish item", "error");
    }
}

function delete_cart(id, is_type) {
    jQuery.ajax({
        url: FRONT_SITE_PATH + 'manage_cart',
        type: 'post',
        data: 'attr=' + id + '&type=delete',
        success: function (result) {
            if (is_type == 'load') {
                window.location.href = window.location.href;
            } else {
                var data = jQuery.parseJSON(result);
                //swal("Congratulation!", "Dish added successfully", "success");
                jQuery('#totalCartDish').html(data.totalCartDish);
                jQuery('#shop_added_msg_' + id).html('');
                if (data.totalCartDish == 0) {
                    jQuery('.shopping-cart-content').remove();
                    jQuery('#totalPrice').html('');
                } else {
                    var tp1 = data.totalPrice;
                    jQuery('#shopTotal').html('Rs.' + tp1);
                    jQuery('#attr_' + id).remove();
                    jQuery('#totalPrice').html('Rs.' + data.totalPrice);
                }
                window.location.reload();
            }
        }
    });
}

jQuery('#frmProfile').on('submit', function (e) {
    jQuery('#profile_submit').attr('disabled', true);
    jQuery('#form_msg').html('Please wait...');
    jQuery.ajax({
        url: FRONT_SITE_PATH + 'update_profile',
        type: 'post',
        data: jQuery('#frmProfile').serialize(),
        success: function (result) {
            jQuery('#form_msg').html('');
            jQuery('#profile_submit').attr('disabled', false);
            var data = jQuery.parseJSON(result);
            if (data.status == 'success') {
                jQuery('#user_top_name').html(jQuery('#uname').val());
                swal("Success", data.msg, "success");
            }
        }
    });
    e.preventDefailt();
});

jQuery('#frmPassword').on('submit', function (e) {
    jQuery('#password_submit').attr('disabled', true);
    jQuery('#password_form_msg').html('Please wait...');
    jQuery.ajax({
        url: FRONT_SITE_PATH + 'update_profile',
        type: 'post',
        data: jQuery('#frmPassword').serialize(),
        success: function (result) {
            jQuery('#password_form_msg').html('');
            jQuery('#password_submit').attr('disabled', false);
            var data = jQuery.parseJSON(result);
            if (data.status == 'success') {
                swal("Success", data.msg, "success");
            }
            if (data.status == 'error') {
                swal("Error", data.msg, "error");
            }
        }
    });
    e.preventDefailt();
});

function updaterating(id, oid) {
    var rate = jQuery('#rate' + id).val();
    var rate_str = jQuery('#rate' + id + 'option:selected').text();
    if (rate == '') {
    } else {
        jQuery.ajax({
            url: FRONT_SITE_PATH + 'updaterating',
            type: 'post',
            data: 'id=' + id + '&rate=' + rate + '&oid=' + oid,
            success: function (result) {
                jQuery('#rating' + id).html("<div>" + rate_str + "</div>");
            }
        })
    }
}