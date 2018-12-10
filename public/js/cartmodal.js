$(document).ready(
    function() {

    $('.btn-add-product').click(
        function(){
            var code = $(this).attr('data-button');
            var product = {};
            $('.product-'+code).find('input').each(function(index) {
                product[$(this).attr('name')]=($(this).val());
            });
            product['quantity'] = $('#quantity-'+code).val();
            $.ajax({
                url: './application/helpers/cart-process.php',
                type: "post",
                data: {
                    'product' : product
                },
                success: function(data){
                    $('#modal-contenedor').html(data);
                }
            });
        }
    );



});

function mostrar(){
    if($(".cart-detail").css("visibility") == "visible" )
    {
        $(".cart-detail").css("visibility", "hidden");
        $(".cart-detail").css("position", "absolute");
    }else{
        $(".cart-detail").css("visibility", "");
        $(".cart-detail").css("position", "");
    }
}

function borrar(value){
    $.ajax({
        url: './productos-online.php',
        type: "post",
        data: {
            'id3' : value
        },
        success: function(data){
            location.reload();
        }
    });
}

function borrar_carro(value){
    $.ajax({
        url: 'carrito-compras.php',
        type: "post",
        data: {
            'id3' : value
        },
        success: function(data){
            location.reload();
        },
        beforeSend: function() {
            $(".pagar").prop('disabled', true); // disable button
        }
    });
}

function borrar_carro_pago(value){
    $.ajax({
        url: 'plataforma_de_pago.php',
        type: "post",
        data: {
            'id3' : value
        },
        success: function(data){
            location.reload();
        }
    });
}

function updatePrice(code){
    var quantity = $('#newQuantity_'+code).val();
    console.log(code);
    console.log(quantity);
    $.ajax({
        url: 'carrito-compras.php',    //'application/controller/process.php',
        type: "post",
        data: {
            'codeUpdate' : code,
            'newQuantity' : quantity
        },
        success: function(){
            location.reload();
        },
        beforeSend: function() {
            $("#pagar").prop('disabled', true); // disable button
        }
    });
}