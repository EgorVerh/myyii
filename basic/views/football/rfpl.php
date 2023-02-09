<?php
/** @var yii\web\View $this */
use yii\helpers\Url;
?>
<h1>Таблица РПЛ</h1>
<?php if(count ($commands)):?>
<table class="table table-bordered">
<thead>
    <tr>
      <th scope="col">№</th>
      <th scope="col">Команды</th>
      <th scope="col">И</th>
      <th scope="col">В</th>
      <th scope="col">Н</th>
      <th scope="col">П</th>
      <th scope="col">ГОЛЫ</th>
      <th scope="col">РАЗ</th>
    </tr>
  </thead>
  <?php foreach($commands as $command):
    $w=0;$draw=0;$def=0;$goals=0;$pass=0;?>
  <tr>
      <th scope="row"><?=$command->id ?></th>
      <td><a href="<?= Url::to(['/football/index'])?>"><?= $command->command ?></a></td>
      
      <?php $idcom = $command->id; foreach ($resultat as $result):
              if ($idcom == $result->id_command1):
                  $goals = $result->goals_command1 + $goals;
                  $pass=$result->goals_command2+$pass;
                  if($result->goals_command1>$result->goals_command2):
                    $w++;
                    elseif($result->goals_command1<$result->goals_command2):
                    $def++;
                    else:$draw++;
                  endif;
              endif;
              if ($idcom == $result->id_command2):
                $goals = $result->goals_command2 + $goals;
                $pass=$result->goals_command1+$pass;
                if($result->goals_command2>$result->goals_command1):
                  $w++;
                  elseif($result->goals_command2<$result->goals_command1):
                  $def++;
                  else:$draw++;
                endif;
            endif;
        endforeach?>
      <td><?= $w+$draw+$def ?></td>
      <td><?= $w?></td>
      <td><?= $draw?></td>
      <td><?= $def?></td>
      <td><?= $goals?> - <?= $pass?></td>
      <td><?= $goals-$pass ?></td>
    </tr>
    <?php endforeach?>
</table>
<?php else: ?>
	 <p>Нет данных</p>
<?php endif ?>
