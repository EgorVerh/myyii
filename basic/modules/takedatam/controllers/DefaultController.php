<?php

namespace frontend\modules\takedatam\controllers;

use Yii;
use yii\web\Controller;
use frontend\modules\takedatam\models\Dataforms;
use frontend\modules\takedatam\models\Form2addres;
use frontend\modules\takedatam\models\Form2email; 
use frontend\modules\takedatam\models\Savefiles;
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
        $request = Yii::$app->request;  
            $saveintable = new Dataforms();
            $saveintable->namefildsforms ='О полном наименовании образовательной организации';
            $dataht=$request->get('Textarea1');
            $saveintable->datafilds =$dataht;
            $saveintable->save();
        
            $saveintable =new Dataforms();
            $saveintable->namefildsforms ='Сокращенное (при наличии) наименование образовательной организации';
            $dataht=$request->get('Textarea2');
            $saveintable->datafilds =$dataht;
            $saveintable->save();
        
            $saveintable = new Dataforms();
            $saveintable->namefildsforms ='Дата создания образовательной организации';
            $dataht=$request->get('Textarea3');
            $saveintable->datafilds =$dataht;
            $saveintable->save();
            
            
        return $this->render('index');
    }
    public function actionForm2()
    {
        $request = Yii::$app->request;
        if($request->get('Massrows')){
            foreach($request->get('Massrows') as $row){
//Сохранение всех textarea  в строке

                $saveintable = new Dataforms();
                $saveintable->namefildsforms ='Наименование учредителя образовательной организации';
                $saveintable->datafilds =$row[0][0];
                $saveintable->save();
                $idfordop=Yii::$app->db->getLastInsertID();

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

        if ($_FILES && $_FILES['upload_file']['name'][0]!=''){
                $uploaddir = '/home/vagrant/test/portal_local_repo/app/frontend/web/downloads/';
                $savefile=$_FILES;
                $i=0;
            foreach ($_FILES['upload_file']['name'] as $file => $name) 
            {
                $uploadfile = $uploaddir . basename($name);
                $tmpname = $_FILES['upload_file']['tmp_name'][$file];
                if (copy($tmpname, $uploadfile)) {  
                    $saveintable=new Savefiles();
                    $saveintable->Titel=$_POST['Textarea'][$i];
                    $saveintable->NameFile=$name;
                    $saveintable->Link= 'downloads/'.basename($name);
                    $saveintable->save();
                    $i++;
                    // echo "Файл корректен и был успешно загружен.\n";
                    // echo $uploaddir;
                }
                $uploadfile = $uploaddir . basename("Устав.pdf");
                $tmpname = $_FILES['upload_file']['tmp_name'][$file];
                if(file_exists("/home/vagrant/test/portal_local_repo/app/frontend/web/downloads/Устав.pdf"))
                {
                unlink("/home/vagrant/test/portal_local_repo/app/frontend/web/downloads/Устав.pdf");
                }
                if (copy($tmpname, $uploadfile)) {
                    // echo "Файл корректен и был успешно загружен.\n";
                    // echo $uploaddir;
                }
            }
            return $this->render('form3');
        }
        // var_dump(Yii::$app->request->get());
        // die();
        return $this->render('form3');
    }
    public function actionForm4()
    {
        return $this->render('form4');
    }
}
