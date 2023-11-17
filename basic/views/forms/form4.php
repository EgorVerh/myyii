<?php
/** @var yii\web\View $this */
?>
<h2>Разделы сайта</h2>
<div class="row" style="margin-top:10px;padding:10px; background-color:#fdf8e3 ;border: 1px solid #F0F0F0;">
<div class="col-1">
<div>
<button type="button" style="width:30px; height:30px; text-align:centre; font-size:10px" id="btn_up" class="btn btn-danger">^</button>
<button type="button" style="width:30px; height:30px; text-align:centre; font-size:10px" id="btn_down" class="btn btn-danger">v</button>
</div>
</div>
<div class="col-10" style="padding:0;">Раздел 1</div>
<button style="width:30px; height:30px; text-align:centre; font-size:10px" type="button" id="add_expand" class="btn btn-success col-1">+</button>
</div>


<script "assets/e52bf38b/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
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
</script>