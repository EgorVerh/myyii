$(document).ready(function(){
    $(document).on('click','#add_expand',function(){
        $("#idrow").after();
})
//вверх  
$(document).on('click','#btn_up', function(){ 
              var idrow=$(this).closest('.row').attr("id");
              $("#"+idrow).after($('#'+idrow).prev());
             });
    //конец ввверх

    //вниз
    $(document).on('click','#btn_down', function(){
              var idrow=$(this).closest('.row').attr("id");
              $("#"+idrow).before($('#'+idrow).next());
             });
    //конец вниз
});