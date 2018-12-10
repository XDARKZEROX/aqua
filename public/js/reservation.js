$(document).ready(function() {

    $('.buy').click(function(){
            $('#myModal').modal('show');
            $.ajax({
                        url: './application/controller/Pago.php',
                        type: "post",
                        data: {
                            'token' : $(this).prev().val(),
                            'tipoPago': $('input[name=tipoPago]:checked').val()
                        }
            }).done( function( data ) {
                if(0 === data.length){
                    window.location.href = 'confirmacion-pedido-transferencia';
                } else {
                    $('#form-hidden').html(data);
                }
            }).then( function (data) {
                if(0 != data.length){
                    $('#redsys-form').submit();
                }
            })
    });

    $('.use-cupon').click(function(){
        $.ajax({
            url: './application/controller/Pago.php',
            type: "post",
            data: {
                'cupon' : $('#input-cupon').val()
            }
        }).done( function( data ) {
           if(data=='0'){
               $("#error_cupon").modal();
           } else if(data=='1'){
               $('#valid_cupon').modal();
               setTimeout(function(){
                   location.reload();
               }, 3000);
           }
        })
    });

    $('.quitar-cupon').click(function() {
        $.ajax({
            url: 'plataforma_de_pago.php',
            type: "post",
            data: {
                'flush_cupon' : true
            },
            success: function(data){
                location.reload();
            }
        });
    });



});
