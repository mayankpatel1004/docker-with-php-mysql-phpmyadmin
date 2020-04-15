function addToCart(cart_id,item_id,product_price_id,url,quantity,has_option) {
    //alert(cart_id+'====='+item_id+'======='+product_price_id+"===="+quantity+"==="+has_option);
    let total_attributes = $(".attributes_select_box").length;
    let error = 0;
    $(".cart-status-message").html('');
    if(parseInt(total_attributes) > 0) {
        for(i=1;i<=parseInt(total_attributes);i++) {
            let attribute = $("#product_attribute_"+i).val();
            if(attribute == 'Color' || attribute == 'Size' || attribute == 'Waist'){
                attribute = '';
            }
            if(attribute == '') {
                error = 1;
            }
        }
    }
    //alert(error);return false;
    if(error == 0) {
        $.ajax({
            method: "POST",
            url: url+"Homecontroller/addToCart",
            data: { cart_id:cart_id, item_id: item_id,product_price_id :product_price_id,quantity:quantity,has_option:has_option }
        })
        .done(function( response ) {
            response = JSON.parse(response);
            //console.log(response);
            if(response.error == 1) {
                $('#cart_error').html(response.message);
                $('#cart_error').css('color','red');
            }
            if(response.error == 0) {
                $('#cart_success').html(response.message);
                $('#cart_success').css('color','green');
            }
        });
    } else {
        $('#cart_error').html("Please select all attributes");
        $('#cart_error').css('color','red');
    }
}

function updateCartItems(quantity,cart_product_id) {
    let url = $("#site_url").val();
    $.ajax({
        method: "POST",
        url: url+"Home/updateCartItems",
        data: { cart_product_id:cart_product_id,quantity:quantity}
    })
    .done(function( response ) {
        location.reload();
    });
}

function fnDeleteCartItem(cart_id,cart_product_id) {
    if(confirm("Are you sure you wanna delete item?")){
        let url = $("#site_url").val();
        $.ajax({
            method: "POST",
            url: url+"Home/deleteCartItem",
            data: { cart_id:cart_id,cart_product_id:cart_product_id}
        })
        .done(function( response ) {
            location.reload();
        });
    }
}

function fnPlaceOrder(cart_id) {
    let url = $("#site_url").val();
    $.ajax({
        method: "POST",
        url: url+"Home/placeOrder",
        data: { cart_id:cart_id}
    })
    .done(function( response ) {
        console.log(response);
        response = JSON.parse(response);
        if(response.error == 1){
            window.location.href = url+'cart';
        }else {
            window.location.href = url+'home/ordersuccess/?order_id='+response.order_id;
        }
    });
}


$(document).ready(function(){
    $('#checkout-form').on('submit', function(e){
        $(".submitbutton").hide();
        $(".dot-opacity-loader").show();
        $("#place_order_button").hide();
        e.preventDefault();
        var form = e.target;
        $(".formerror").html('');
        $.ajax({
            url: form.action,
            dataType: 'json',
            method : "post",
            contentType: false,
            cache: false,
            processData:false, 
            data: new FormData(this),
            //data: $('#ajax-upload').serialize(),
            success: function(result){
                console.log(result);
                fnPlaceOrder($("#cart_id").val());
            }
        });
    });
});