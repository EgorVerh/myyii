<?php

namespace frontend\modules\takedatam;

/**
 * newmodules module definition class
 */
class Takedatam extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\takedatam\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::setAlias('@modulestakedatamroot', '/home/vagrant/test/portal_local_repo/app/frontend/modules/takedatam/public');
        \Yii::setAlias('@modulestakedatamscript','@web/assets/92b8fded/js');
        \Yii::setAlias('@modulestakedatamcss','@web/assets/92b8fded/css');
        // custom initialization code goes here
    }
}
