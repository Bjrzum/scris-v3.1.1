$('#password').keyup(function () {

    var pin = $('#password').val();

    $.ajax({
        url: 'packages/Login.php',
        type: 'POST',
        data: {
            pin: pin
        },
        success: function (response) {
            if (response == '101' || response == 101) {
                //$('#password').val('');
                $('#password').css('border', '1px solid green');
                $('#password').css('box-shadow', '0 0 5px green');
                $('#password').css('color', 'green');

                console.log(response);

                setTimeout(function () {
                    window.location.href = 'inicio.php';
                }, 200);

            } else {
                $('#password').css('border', '1px solid red');
                $('#password').css('box-shadow', '0 0 5px red');
                $('#password').css('color', 'red');

                console.log(response);

            }
        }
    });
});