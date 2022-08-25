let marcar = true;

$('.btn-novedad').click(function () {

    if (marcar) {

        $(this).css('background-color', '#e5ff00');
        $(this).css('color', '#000');

        $('td').css('cursor', 'pointer');
        $('textarea').css('pointer-events', 'none');
        $('tr').mouseenter(function () {
            $(this).addClass('tr-novedad');
        });
        $('tr').mouseleave(function () {
            $(this).removeClass('tr-novedad');
        });


        $('tr').click(function () {

            if ($(this).hasClass('tr-novedad-true')) {

                $(this).removeClass('tr-novedad-true');
                $(this).removeClass('status-2');
                $(this).removeClass('status-3');

                let id = $(this).attr('data-indice');

                $.ajax({
                    url: 'packages/Actions/Novedad/False.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });

            } else {

                $(this).addClass('tr-novedad-true');
                let id = $(this).attr('data-indice');

                $.ajax({
                    url: 'packages/Actions/Novedad/True.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });


            }

        });

        marcar = false;
        console.log(marcar);

    } else {
        location.reload();

    }
    return marcar;
});



$('.btn-eliminar').click(function () {

    if ($(this).hasClass('btn-eliminar-true')) {

        location.reload();

    } else {

        $(this).addClass('btn-eliminar-true');

        $('td').css('cursor', 'pointer');
        $('textarea').css('pointer-events', 'none');
        $('tr').mouseenter(function () {
            $(this).addClass('tr-eliminar');
        });
        $('tr').mouseleave(function () {
            $(this).removeClass('tr-eliminar');
        });


        $('tr').click(function () {

            var id = $(this).attr('data-indice');

            $.ajax({
                url: 'packages/Actions/Eliminar/Eliminar.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function (response) {

                    console.log(response);
                }
            });
            //ocultar tr pulsado
            $(this).hide();

        });
    }

});