<?php

namespace frontend\modules\takedatam\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Dataforms;
use frontend\models\Form2addres;
use frontend\models\Form2email; 
use yii\web\UploadedFile;
use frontend\models\StorageUploadForm;
use common\models\storage\Upload;
/**
 * Default controller for the `newmodules` module
 */
class DefaultController extends Controller
{
    public function init()
    {
        parent::init();        
    }

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
            $saveintable->namefildsforms ='О полном наименовании образовательной организации';
            $dataht=$_GET['Textarea1'];
            $saveintable->datafilds =$dataht;
            $saveintable->save();
        
            $saveintable = new Dataforms();
            $saveintable->namefildsforms ='Сокращенное (при наличии) наименование образовательной организации';
            $dataht=$_GET['Textarea2'];
            $saveintable->datafilds =$dataht;
            $saveintable->save();
        
            $saveintable = new Dataforms();
            $saveintable->namefildsforms ='Дата создания образовательной организации';
            $dataht=$_GET['Textarea3'];
            $saveintable->datafilds =$dataht;
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
                $saveintable->namefildsforms ='Наименование учредителя образовательной организации';
                $saveintable->datafilds =$row[0][0];
                $saveintable->save();
                $idfordop=Yii::$app->db->getLastInsertID();
                var_dump($idfordop);
                $saveintable = new Dataforms();
                $saveintable->namefildsforms ='Юридический адрес учредителя';
                $saveintable->datafilds =$row[0][1];
                $saveintable->save();

                $saveintable = new Dataforms();
                $saveintable->namefildsforms ='Контактный телефон учредителя';
                $saveintable->datafilds =$row[0][2];
                $saveintable->save();

//Конец сохранения всех textarea  в строке


//Сохранение адресов и сайтов
            if(isset($row[1]))
           {
                foreach($row[1] as $row1)
                {
                    $saveintable = new Form2addres();
                    $saveintable->iddataforms=$idfordop;
                    $saveintable->addres=$row1;
                    $saveintable->save();
                }
            }

            if(isset($row[2])){
                foreach($row[2] as $row2)
                {
                    $saveintable = new Form2email();
                    $saveintable->iddataforms=$idfordop;
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
        if ($_FILES){
                $uploaddir = '/home/vagrant/test/';
            foreach ($_FILES['upload_file']['name'] as $file => $name) {
                $uploadfile = $uploaddir . basename($name);
                $tmpname = $_FILES['upload_file']['tmp_name'][$file];
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
