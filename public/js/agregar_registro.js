
$(document).ready(function(){
    $('#dependencia').change(function(){
        var dependencia = $('#dependencia').val();

     
            $.ajax({
                url: 'packages/Actions/agregar_registro.php',
                method: 'POST',
                data: {dependencia:dependencia},
                success: function(data){
                    console.log(data);
                    $('#nombre').html(data);
                }
            });
        
    });

    $('#nombre').change(function(){
        var nombre = $('#nombre').val();

        if (nombre != '') {
            $.ajax({
                url: 'packages/Actions/agregar_registro.php',
                method: 'POST',
                data: {nombre:nombre},
                success: function(data){
                    console.log(data);//{"dependencia":"DIRECTIVO", "direccion":"RECTOR", "asignatura":"", "placa":"FYT 17C/ MOTO", "observaciones":""}
                    var obj = JSON.parse(data);
                    $('#dependencia').val(obj.dependencia);
                    $('.direccion').text(obj.direccion);
                    $('.asignatura').text(obj.asignatura);
                    $('#placa').val(obj.placa);
                    $('#observaciones').val(obj.observaciones);             
                }
            });
        }
    });

    $('.btn-agregar').click(function(){
        var fecha = $('#fecha').val();
        var nombre = $('#nombre').val();
        var dependencia = $('#dependencia').val();
        var direccion = $('.direccion').text();
        var asignatura = $('.asignatura').text();
        var hora_ingreso = $('#hora_ingreso').val();
        var hora_salida = $('#hora_salida').val();
        var placa = $('#placa').val();
        var observaciones = $('#observaciones').val();
        var status = '';
        var orden = '';

        if (fecha != ''){

            if (nombre != ''){
                
                if (hora_ingreso == '' && hora_salida == ''){
                   status = 4;
                     orden = 1;
                } else {
                    status = 0;
                    orden = 0;
                }

                
                console.log(fecha);//2022-08-21
                ///formaterar la fecha a 2022/12/31
                var fecha_formateada = fecha.split('-');
                fecha_formateada = fecha_formateada[0] + '/' + fecha_formateada[1] + '/' + fecha_formateada[2];

                let sql = "INSERT INTO tabla (fecha, nombre, dependencia, direccion, asignatura, hora_ingreso, hora_salida, placa, observaciones, status, orden) VALUES ('"+fecha_formateada+"', '"+nombre+"', '"+dependencia+"', '"+direccion+"', '"+asignatura+"', '"+hora_ingreso+"', '"+hora_salida+"', '"+placa+"', '"+observaciones+"', '"+status+"' , '"+orden+"')";
                console.log(sql);
                $.ajax({
                    url: 'packages/Actions/agregar_registro.php',
                    method: 'POST',
                    data: {sql:sql},
                    success: function(data){
                        console.log(data);
                        if (data == 1) {
                            alert('Registro agregado correctamente');
                            location.reload();
                        }
                    }
                });
            } else{
                $('#nombre').css('border-color', '#ff0000');
                $('#nombre').css('box-shadow', '0 0 10px #ff0000');
            }

        } else {
            $('#fecha').css('border-color', '#ff0000');
            $('#fecha').css('box-shadow', '0 0 10px #ff0000');
        }
    });
});
