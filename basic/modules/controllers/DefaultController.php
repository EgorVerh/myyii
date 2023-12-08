<?php

namespace app\modules\controllers;

use app\models\Dataforms;
use app\models\Form2addres;
use app\models\Form2email;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `newmodules` module
 */
class DefaultController extends Controller
{
    public function beforeAction($action)
    {            
        if ($action->id == 'form3') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if(isset($_GET["Textarea1"])&& $_GET["Textarea1"]!=''&& isset($_GET["Textarea2"])&& $_GET["Textarea2"]!=''&& isset($_GET["Textarea3"])&& $_GET["Textarea3"]!='')
        {
            $saveintable = new Dataforms();
            $saveintable->Namefildsforms ='О полном наименовании образовательной организации';
            $dataht=$_GET['Textarea1'];
            $saveintable->Datafilds =$dataht;
            $saveintable->save();
        
            $saveintable = new Dataforms();
            $saveintable->Namefildsforms ='Сокращенное (при наличии) наименование образовательной организации';
            $dataht=$_GET['Textarea2'];
            $saveintable->Datafilds =$dataht;
            $saveintable->save();
        
            $saveintable = new Dataforms();
            $saveintable->Namefildsforms ='Дата создания образовательной организации';
            $dataht=$_GET['Textarea3'];
            $saveintable->Datafilds =$dataht;
            $saveintable->save();
        }
                return $this->render('index');
            }
            public function actionForm2()
            { 
        
                if(isset($_GET['Massrows'])){
                    foreach($_GET['Massrows'] as $row){
        //Сохранение всех textarea  в строке
        
                        $saveintable = new Dataforms();
                        $saveintable->Namefildsforms ='Наименование учредителя образовательной организации';
                        $saveintable->Datafilds =$row[0][0];
                        $saveintable->save();
                        $idfordop=\Yii::$app->db->getLastInsertID();
                        var_dump($idfordop);
                        $saveintable = new Dataforms();
                        $saveintable->Namefildsforms ='Юридический адрес учредителя';
                        $saveintable->Datafilds =$row[0][1];
                        $saveintable->save();
        
                        $saveintable = new Dataforms();
                        $saveintable->Namefildsforms ='Контактный телефон учредителя';
                        $saveintable->Datafilds =$row[0][2];
                        $saveintable->save();
        
        //Конец сохранения всех textarea  в строке
        
        
        //Сохранение адресов и сайтов
                    if(isset($row[1]))
                   {
                        foreach($row[1] as $row1)
                        {
                            $saveintable = new Form2addres();
                            $saveintable->iddataforms=$idfordop;
                            $saveintable->Addres=$row1;
                            $saveintable->save();
                        }
                    }
        
                    if(isset($row[2])){
                        foreach($row[2] as $row2)
                        {
                            $saveintable = new Form2email();
                            $saveintable->iddata=$idfordop;
                            $saveintable->email=$row2;
                            $saveintable->save();
                        }
                    }
                    
                }
        //Конец сохранения адресов и сайтов
                }
                return $this->render('form2');
            }
        
            public function actionForm3()
            {
                if($_FILES)
                {
                $uploaddir = '/home/vagrant/myyii/';
                foreach($_FILES['upload_file']['name'] as $file=>$name)
                {
                $uploadfile = $uploaddir . basename($name);
                $tmpname=$_FILES['upload_file']['tmp_name'][$file];      
                if (move_uploaded_file($tmpname, $uploadfile)) {
                      echo "Файл корректен и был успешно загружен.\n";
                    }
                
                }
                }
                return $this->render('form3');
            }
            public function actionForm4()
            {
                return $this->render('form4');
            }
}
