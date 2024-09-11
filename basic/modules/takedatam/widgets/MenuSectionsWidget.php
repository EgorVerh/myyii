<?php
namespace frontend\modules\takedatam\widgets;

use yii\base\Widget;

class MenuSectionsWidget extends Widget
{
    public function run()
    {
        return $this->render("menu_sections");
    }
}