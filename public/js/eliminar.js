$('.btn__funcionario').click(function() {
    var nombre = $(this).text();
    var ventana = $('.emergent');
    var nombreInsertar = $('#nombre-funcionario');

    nombreInsertar.text(nombre);
    ventana.addClass('emergent-active');
});

$('#btn-cancel').click(function() {
    var ventana = $('.emergent');
    ventana.removeClass('emergent-active');
    $('#fecha-deleted').val('');
    
});

$('#btn-delete').click(function() {
    var nombre = $('#nombre-funcionario').text();
    var fecha = $('#fecha-deleted').val();
    var errores = $('.errores');

    if (fecha == '') {
        errores.html('<p>* Debes ingresar una fecha</p>');
    } else {
        //formato de fecha 2022-12-12 a 2022/12/12
        var fechaFormato = fecha.split('-');
        var fechaFormato = fechaFormato[0] + '/' + fechaFormato[1] + '/' + fechaFormato[2];
        fecha = fechaFormato;

        $.ajax({
            url: 'functions/eliminar.php',
            type: 'POST',
            data: {
                eliminar: true,
                nombre: nombre,
                fecha: fecha
            },
            success: function(response) {
                if (response == 'ok') {
                    $('.emergent').html('<h2 style="color:green; text-align:center; padding:1em; background:#fff; border-radius: 5px;">Funcionario eliminado correctamente</h2>');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    errores.html('<p>* Error al eliminar el funcionario</p>');
                }
            }
        });
    }
});