<?php

namespace frontend\modules\takedatam;


use Yii\base\BootstrapInterface;
/**
 * newmodules module definition class
 */
class Takedatam extends \yii\base\Module implements BootstrapInterface
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
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
        '/form1'                                                   => 'takedatam/default/index',
        '/form2'                                                   => 'takedatam/default/form2',
        '/form3'                                                   => 'takedatam/default/form3',
        '/form4'                                                   => 'takedatam/default/form4',
        '/paid_edu'                                                => 'takedatam/default/paidedu',
        '/grantsold'                                               => 'takedatam/default/grantsold',
        '/grants'                                                  => 'takedatam/default/grants',
        '/document'                                                => 'takedatam/default/document',
        '/common'                                                  => 'takedatam/default/common',
        '/eduStandarts'                                            => 'takedatam/default/edustandarts',
        '/inter'                                                   => 'takedatam/default/inter',
        '/budget'                                                  => 'takedatam/default/budget',
        '/objects'                                                 => 'takedatam/default/objects',
        '/catering'                                                => 'takedatam/default/catering',
        '/education'                                               => 'takedatam/default/education',
        '/upload'                                                  => 'takedatam/default/upload',
        '/deleteform2'                                             => 'takedatam/default/deleteform2',
        '/deleteform3'                                             => 'takedatam/default/deleteform3',
        '/deleteform4'                                             => 'takedatam/default/deleteform4',
        '/delete_paid_edu'                                         => 'takedatam/default/deletepaidedu',
        '/delete_grants'                                           => 'takedatam/default/deletegrants',
        '/delete_document'                                         => 'takedatam/default/deletedocument',
        '/delete_inter'                                            => 'takedatam/default/deleteinter',
        '/delete_budget'                                           => 'takedatam/default/deletebudget',
        '/delete_objects'                                          => 'takedatam/default/deleteobjects',
        ], false);
    }
}
