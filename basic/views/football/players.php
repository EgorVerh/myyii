<?php
/** @var yii\web\View $this */
use yii\helpers\Url;
?>
<h1>Таблица РПЛ</h1>
<?php if(count ($players)):?>
<table class="table table-bordered">
<thead>
    <tr>
      <th scope="col">Игрок</th>
      <th scope="col">Комманда</th>
      <th scope="col">Голы</th>
      <th scope="col">Пенальти</th>
      <th scope="col">Игры</th>
    </tr>
  </thead>
  <?php foreach($players as $player):?>
  <tr>
      <td scope="row"><?= $player->id ?> <?= $player->name?></td>
      <td><a href="<?= Url::to(['/football/rfpl'])?>"><?= $player->command->command ?></a></td>
      <td><?= $player->goals?></td>
      <td><?= $player->penalty?></td>
      <td><?= $player->games?></td>
    </tr>
    <?php endforeach?>
</table>
<?php else: ?>
	 <p>Нет данных</p>
<?php endif ?>
