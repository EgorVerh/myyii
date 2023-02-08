<?php
/** @var yii\web\View $this */
?>
<h1>football/index</h1>
<?php if(count ($commands)):?>
<table class="table table-bordered">
  
  <?php $k = 7;$t = 1;foreach ($commands as $command): $k++;?>
    <tr>
    <?php if($k==8):?>

      <tr><th colspan="4">Тур <?= $t?></th></tr>

    <?php $t++; $k = 0; endif?>

      <td scope="row"><?= Yii::$app->formatter->asDate($command->datetime ) ?></td>
      <td><?= $command->command1->command?></td>
      <td><?= $command->goals_command1?>-<?= $command->goals_command2?></td>
      <td><?= $command->command2->command?></td>
    </tr>  
<?php endforeach?>
</table>
<?php else: ?>
	 <p>Нет данных</p>
<?php endif ?>
