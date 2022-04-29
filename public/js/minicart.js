// *****************************************
// Triggers / Events
// *****************************************
// Add item


$( document ).on( "click", "button.add-to-cart", function(event) {

    event.preventDefault();
    var id = $(this).data('name');
    let element = $(this);
    $.ajax({
        url:'/cart/add',
        type:'POST',
        data:{
            product_id:id,
            _token:$('meta[name="csrf-token"]').attr('content'),
        },
        success:function (response){
            displayCart(response['product']);
            $(".total-cart").html(response['total']);
            $( ".total-count" ).html( $('.basket-tr').length );
            element.attr('disabled', true);
            element.children(0).addClass('add-disabled');
        }
    });

});


// Clear items

$( document ).on( "click", "button.clear-cart", function() {
    $.ajax({
        url:'/cart/remove/all',
        type:'POST',
        data:{
            _token:$('meta[name="csrf-token"]').attr('content'),
        },
        success:function (response){
            $('.show-cart').empty();
            $( ".total-count" ).html( $('.basket-tr').length );
            $(".total-cart").html('0');
        }
    });
});


function displayCart(product) {
    let output = "<tr class='basket-tr' style='border-bottom: 1px solid #5f5f5f'>"
            + "<td class='basket-tr_title' style=\"font-size: 12px; color: black; width: 60px\">" + product.title_ru + "</td>"
            + "<td><div class='input-group d-flex align-items-center'><button class='minus-item input-group-addon minus-btn main__product-btn' style='padding: 4px 5px' data-id=" + product.id + "><i class=\"fas fa-minus\" style=\"color: white\"></i></button>"
            + "<input type='text' class='item-count form-control main__product-num' disabled value='"+ 1 +"'>"
            + "<button class='plus-item input-group-addon plus-btn main__product-btn border-0' style='padding: 4px 5px; border: none' data-id=" + product.id + "><i class=\"fas fa-plus\" style=\"color: white\"></i></button></div></td>"
            + "<td><button class='delete-item border-0' data-id=" + product.id + "><span style=\"border: none; font-size: 20px;\" class=\"fad fa-trash\"></span></button></td>"
            + " = "
            +  "</tr>";
    $('.show-cart').append(output);
}

// Delete item button

$( document ).on( "click", "button.delete-item", function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    let element = $(this);

    $.ajax({
        url:'/cart/remove',
        type:'POST',
        data:{
            product_id:id,
            _token:$('meta[name="csrf-token"]').attr('content'),
        },
        success:function (response){
            if(response['status'] == 'okay'){
                element.closest('.basket-tr').remove();
                $( ".total-count" ).html( $('.basket-tr').length );
            }
        }
    });


});


// -1
$('.show-cart').on("click", ".minus-item", function(e) {
    let id = $(this).data('id');

    $.ajax({
        url:'/cart/minus/'+id,
        type:'GET',
        data:{
            product_id:id,
            _token:$('meta[name="csrf-token"]').attr('content'),
        },
        success:function (response){
            if(response['status'] == 'okay'){
                $(".total-cart").html(response['total']);
            }
        }
    });

    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('div').find('input');
    var value = parseInt($input.val());

    if (value > 1) {
        value = value - 1;
    } else {
        value != 0;
    }
    $input.val(value);
})

// +1
$('.show-cart').on("click", ".plus-item", function(e) {
    let id = $(this).data('id');
    $.ajax({
        url:'/cart/plus/'+id,
        type:'GET',
        data:{
            product_id:id,
            _token:$('meta[name="csrf-token"]').attr('content'),
        },
        success:function (response){
            if(response['status'] == 'okay'){
                $(".total-cart").html(response['total']);
            }
        }
    });

    e.preventDefault();
    var input = $(this).closest('div').find('.item-count');
    var value = parseInt(input.val());
    var input = $(this).closest('div').find('input');
    var value = parseInt(input.val());

    if (value < 100) {
        value = value + 1;
    } else {
        value =100;
    }

    input.val(value);
})


// Item count input

$( '.item-count' ).bind("propertychange change keyup input click paste", function(event) {
    $('.item-count').on('input', function (event) {
        console.log('DASDA');
        let id = $(this).data('id');
        let qty = $(this).val();
        $.ajax({
            url: '/cart/minus',
            type: 'POST',
            data: {
                product_id: id,
                qty: qty,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response['status'] == 'okay') {
                    console.log('plus');
                }
            },
        });
    });
});




