$('.btn-mas').click(function(){
    $('.buscar-mas').toggle(200);
});


$('.btn-buscar').click(function(){
    let fecha_inicio = $('#inicio').val();
    let fecha_fin = $('#fin').val();
    let buscar_tabla = true;
    if(fecha_fin == ''){
        fecha_fin = fecha_inicio;
    }

    if (fecha_inicio != ''){
        if(fecha_inicio <= fecha_fin){         
            location.href = 'tabla.php?inicio='+fecha_inicio+'&fin='+fecha_fin+'&buscar_tabla='+buscar_tabla;
            
        }      
    }

    
});

$('.btn-cancel').click(function(){
    location.href = 'tabla.php';
    this.hide();
});

$('.search10').click(function(){
    //fecha de hoy
    let hoy = new Date();
    let dd = hoy.getDate();
    let mm = hoy.getMonth()+1; //hoy es 0!
    let yyyy = hoy.getFullYear();
    if(dd<10) {
        dd='0'+dd
    }
    if(mm<10) {
        mm='0'+mm
    }
    hoy = yyyy+'/'+mm+'/'+dd;
    //fecha 10 dias antes
    let antes = new Date();
    antes.setDate(antes.getDate() - 10);
    let dd2 = antes.getDate();
    let mm2 = antes.getMonth()+1; //hoy es 0!
    let yyyy2 = antes.getFullYear();
    if(dd2<10) {
        dd2='0'+dd2
    }
    if(mm2<10) {
        mm2='0'+mm2
    }
    antes = yyyy2+'/'+mm2+'/'+dd2;
    location.href = 'tabla.php?inicio='+antes+'&fin='+hoy+'&buscar_tabla=true&search10=true';
});

//verificar que el scroll no este en 0
$(window).scroll(function(){
    if($(window).scrollTop() == 0){
        $('#top').css('display','none');
    }else{
        $('#top').css('display','inline-block');
    }
}).scroll();



//verifcar si existe un GET en la url
if(location.href.indexOf('search10') > -1){
       $('html, body').animate({
        scrollTop: 50000
    }, 500);
}


