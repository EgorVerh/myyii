<?php foreach($model as $mod):?> 
<div class="container", 
style="border:5px ridge black; 
margin:10px; 
padding:10px"> 
<p>Имя: <?= $mod->name?></p>
<p>Возраст: <?= $mod->age?></p>
<p>О себе: <?= $mod->about?></p>
</div>
<?php endforeach?>