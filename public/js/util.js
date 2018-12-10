$(document).ready(function() {

    $("#form-owner").on('submit', function(e) {
        var ref = $(this).find("[required]");
        $(ref).each(function(){
            if ( $(this).val() == '' )
            {
                alert("Por favor complete los campos requeridos.");
                $(this).focus();
                e.preventDefault();
                return false;
            }
        });  return true;
    });

    $("#form-distribuidor").on('submit', function(e) {
        var ref = $(this).find("[required]");
        var isValid = true;
        $(ref).each(function(){
            if ( $(this).val() == '' )
            {
                alert("Por favor complete los campos requeridos.");
                $(this).focus();
                e.preventDefault();
                isValid=false;
                return false;
            }
        });

        if(isValid){
            e.preventDefault(e);
            $.ajax({
                type: 'POST',
                url: './application/helpers/form_insert.php',
                data: $(this).serialize(),
                success: function (response) {
                    var response_json = JSON.parse(response);
                    $(".isa_info").hide();
                    clearForm($('#form-distribuidor'));
                    if(response_json.code==1){
                        $("#form-mark-success").html(response_json["message"]);
                        $(".isa_success").show();
                        $(".isa_success").delay(5000).fadeOut("slow");
                    } else {
                        $("#form-mark-error").html(response_json["message"]);
                        $(".isa_error").show();
                        $(".isa_error").delay(5000).fadeOut("slow");
                    }
                },
                beforeSend: function(e) {
                    $(".isa_info").show();
                }
            });
        }
    });

    function clearForm($form) {
        $form.find(':input').not(':button, :submit, :reset, :hidden, .not-reset').val('');
        $form.find(':checkbox, :radio').prop('checked', false);
    }


    $('#form_distribuidor').on('submit', function(e) {

    });

    $('.direccion').keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z0-9 ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        } else {
            return false;
        }
    });

    $('.input-name').keypress(function (e) {
        if ((e.which > 0 && e.which < 65) && (e.which != 32) ) {
            e.preventDefault();
        }
        if((e.which >90 && e.which <97)){
            e.preventDefault();
        }
        if((e.which >122 && e.which <240)){
            e.preventDefault();
        }
    });

    $('.residencia').keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        } else {
            return false;
        }
    });

    $('.phone').keypress(function (e) {
        var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        } else {
            return false;
        }
    });

    $('.empresa').keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z0-9 .]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        } else {
            return false;
        }
    });


});
