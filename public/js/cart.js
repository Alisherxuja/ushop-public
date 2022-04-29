function add_cart(element, id){
    let qty = element.parentElement.parentElement.children[0].children[1].value;
    $.ajax({
        url:'/cart/add',
        type:'POST',
        data:{
            product_id:id,
            qty:qty,
            _token:$('meta[name="csrf-token"]').attr('content'),
        },
        success:function (response){
            element.onclick = function (){
                return false;
            }
            element.children[0].classList.add('in-cart')
            $('#home').append(response);
        }
    });

}

function remove_cart(element, id){
    $.ajax({
        url:'/cart/remove',
        type:'POST',
        data:{
            product_id:id,
            _token:$('meta[name="csrf-token"]').attr('content'),
        },
        success:function (response){
            if(response){
                element.parentElement.parentElement.remove();
            }
        }
    });
}

$('.clear-header_basket').click(function (){
        console.log();
    $.ajax({
        url:'/cart/remove/all',
        type:'POST',
        data:{
            _token:$('meta[name="csrf-token"]').attr('content'),
        },
        success:function (response){
            if(response.status == 'okay'){
                $('#home').remove();
                $('#profile').remove();
            }
        }
    });
});

function add_favourite(element, id){
    $.ajax({
        url:'/favourite/add',
        type:'POST',
        data:{
            product_id:id,
            _token:$('meta[name="csrf-token"]').attr('content'),
        },
        success:function (response){
            if(response.status == 'okay'){
                element.setAttribute('onclick', `remove_favourite(this, ${id})`);
                element.children[0].classList.add('marked');
            }
        }
    });
}

function remove_favourite(element, id){
    $.ajax({
        url:'/favourite/remove',
        type:'POST',
        data:{
            product_id:id,
            _token:$('meta[name="csrf-token"]').attr('content'),
        },
        success:function (response){
            if(response.status == 'okay') {
                element.setAttribute('onclick', `add_favourite(this, ${id})`);
                element.children[0].classList.remove('marked');
            }
        }
    });
}


