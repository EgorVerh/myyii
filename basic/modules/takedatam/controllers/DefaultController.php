<?php

namespace frontend\modules\takedatam\controllers;

use Yii;
use yii\web\Controller;
use frontend\modules\takedatam\models\Dataforms;
use frontend\modules\takedatam\models\Form2addres;
use frontend\modules\takedatam\models\Form2email;
use frontend\modules\takedatam\models\Savefiles;
use frontend\modules\takedatam\models\UploadForm;
use yii\web\UploadedFile;
use frontend\models\StorageUploadForm;
use common\models\storage\Upload;
use Aws\S3\S3Client;
use Aws\S3\ObjectUploader;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;

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
    public function actionUpload()
    {
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => 'msk',
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key' => 'minioadmin',
                'secret' => 'minioadmin',
            ],
            'endpoint' => 'http://192.168.9.2:9000',
        ]);
        $model = new UploadForm();
        $presignedUrl = "fdgfdg";
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()) {
                $s3->putObject([
                    'Bucket' => 'testbucket',
                    // 'Key'    => $model->file->baseName.'.'.$model->file->extension,//'desiredFileName',//'testkey',
                    'Key' => "xpnI101OqUCeujMzGPDIReDUSs0Tp3KrEnr9w4tUdD4p5Ysl6F." . $model->file->extension,
                    'Body' => file_get_contents($model->file->tempName),
                    //['ContentType' => $model->file->extension]),//'Hello from Sanechek',
                ]);

                $s3->listBuckets();

                // var_dump($amountBuckets);


                $command = $s3->getCommand('GetObject', [
                    'Bucket' => 'testbucket',
                    'Key' => $model->file->baseName . '.' . $model->file->extension
                ]);

                $myPresignedRequest = $s3->createPresignedRequest($command, '+10 minutes');
                $presignedUrl = (string) $myPresignedRequest->getUri(); //получили актуальную ссылку


                $insert = $s3->putObject([
                    'Bucket' => 'testbucket',
                    'Key' => 'desiredFileName',//'testkey',
                    'Body' => 'Hello from Sanechek'
                ]);

                echo $presignedUrl;
                //$model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
            }
        }

        return $this->render('upload', ['model' => $model, 'urlminio' => $presignedUrl]);
    }
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $saveintable = new Dataforms();
        $saveintable->namefildsforms = 'О полном наименовании образовательной организации';
        $dataht = $request->get('Textarea1');
        $saveintable->datafilds = $dataht;
        $saveintable->save();

        $saveintable = new Dataforms();
        $saveintable->namefildsforms = 'Сокращенное (при наличии) наименование образовательной организации';
        $dataht = $request->get('Textarea2');
        $saveintable->datafilds = $dataht;
        $saveintable->save();

        $saveintable = new Dataforms();
        $saveintable->namefildsforms = 'Дата создания образовательной организации';
        $dataht = $request->get('Textarea3');
        $saveintable->datafilds = $dataht;
        $saveintable->save();


        return $this->render('index');
    }
    public function actionForm2()
    {
        $request = Yii::$app->request;
        if ($request->get('Massrows')) {
            foreach ($request->get('Massrows') as $row) {
                //Сохранение всех textarea  в строке

                $saveintable = new Dataforms();
                $saveintable->namefildsforms = 'Наименование учредителя образовательной организации';
                $saveintable->datafilds = $row[0][0];
                $saveintable->save();
                $idfordop = Yii::$app->db->getLastInsertID();

                $saveintable = new Dataforms();
                $saveintable->namefildsforms = 'Юридический адрес учредителя';
                $saveintable->datafilds = $row[0][1];
                $saveintable->save();

                $saveintable = new Dataforms();
                $saveintable->namefildsforms = 'Контактный телефон учредителя';
                $saveintable->datafilds = $row[0][2];
                $saveintable->save();

                //Конец сохранения всех textarea  в строке


                //Сохранение адресов и сайтов
                if (isset($row[1])) {
                    foreach ($row[1] as $row1) {
                        $saveintable = new Form2addres();
                        $saveintable->iddataforms = $idfordop;
                        $saveintable->addres = $row1;
                        $saveintable->save();
                    }
                }

                if (isset($row[2])) {
                    foreach ($row[2] as $row2) {
                        $saveintable = new Form2email();
                        $saveintable->iddataforms = $idfordop;
                        $saveintable->email = $row2;
                        $saveintable->save();
                    }
                }
            }
            //Конец сохранения адресов и сайтов
        }
        $dataform = Dataforms::find()->all();
        $addres = Form2addres::find()->all();
        $email = Form2email::find()->all();
        return $this->render('form2', ['dataform' => $dataform, 'tableaddres' => $addres, 'tableemail' => $email]);
    }

    public function actionForm3()
    {
        $savefilestable = Savefiles::find()->all();
        $key = Yii::$app->params['key'];
        $secret = Yii::$app->params['secret'];
        $endpoint = Yii::$app->params['endpoint'];
        $bucket = Yii::$app->params['Bucket'];
        if (isset($_FILES['upload_file'])) {
            $extension = 0;
            $savefilestable = Savefiles::find()->all();
            foreach ($_FILES['upload_file']['name'] as $file => $name) {
                $p = 0;
                if ($name != '') {
                    foreach ($savefilestable as $data) {
                        if ($_POST['upload_file'][$file] == $data['Position']) {
                            $s3 = new S3Client([
                                'version' => 'latest',
                                'region' => 'msk',
                                'use_path_style_endpoint' => true,
                                'credentials' => [
                                    'key' => $key,
                                    'secret' => $secret,
                                ],
                                'endpoint' => $endpoint,
                            ]);
                            //Удаление старого файла
                            $position = $data['Position'];
                            $lastdotposition = strrpos($data['NameFile'], '.');
                            if ($lastdotposition !== false) {
                                $extension = substr($data['NameFile'], $lastdotposition + 1);
                            }
                            $s3->deleteObject([
                                'Bucket' => $bucket,
                                'Key' => $position,
                            ]);
                            //Конец Удаление старого файла
                            $lastdotposition = strrpos($name, '.');
                            if ($lastdotposition !== false) {
                                $extension = substr($name, $lastdotposition + 1);
                            }
                            $s3->putObject([
                                'Bucket' => $bucket,
                                'Key' => $position,
                                'Body' => file_get_contents($_FILES['upload_file']['tmp_name'][$file]),
                                'ContentDisposition' => '"inline"',
                                'ContentType' => 'application/pdf'
                            ]);
                            $s3->listBuckets();
                            $command = $s3->getCommand('GetObject', [
                                'Bucket' => $bucket,
                                'Key' => $position
                            ]);
                            $myPresignedRequest = $s3->createPresignedRequest($command, '+1000 minutes');
                            $presignedUrl = (string) $myPresignedRequest->getUri(); //получили актуальную ссылку
                            $lastdotposition = strpos($presignedUrl, "?");
                            if ($lastdotposition !== false) {
                                $link = substr($presignedUrl, 0, $lastdotposition);
                            }
                            $saveintable = Savefiles::findOne($data["idsavefiles"]);
                            $saveintable->Titel = $_POST['Textarea'][$file];
                            $saveintable->NameFile = $name;
                            $saveintable->Link = $link;
                            $saveintable->save();
                            $p = 1;
                            break;
                        }
                    }
                    if ($p == 0) {
                        $s3 = new S3Client([
                            'version' => 'latest',
                            'region' => 'msk',
                            'use_path_style_endpoint' => true,
                            'credentials' => [
                                'key' => $key,
                                'secret' => $secret,
                            ],
                            'endpoint' => $endpoint,
                        ]);
                        $randomString = Yii::$app->getSecurity()->generateRandomString();
                        $position = trim($randomString, "_-");
                        $lastdotposition = strrpos($name, '.');
                        if ($lastdotposition !== false) {
                            $extension = substr($name, $lastdotposition + 1);
                        }
                        $s3->putObject([
                            'Bucket' => $bucket,
                            'Key' => $position,
                            'Body' => file_get_contents($_FILES['upload_file']['tmp_name'][$file]),
                            'ContentDisposition' => '"inline"',
                            'ContentType' => 'application/pdf'
                        ]);
                        $s3->listBuckets();
                        $command = $s3->getCommand('GetObject', [
                            'Bucket' => $bucket,
                            'Key' => $position
                        ]);
                        $myPresignedRequest = $s3->createPresignedRequest($command, '+1000 minutes');
                        $presignedUrl = (string) $myPresignedRequest->getUri(); //получили актуальную ссылку
                        $lastdotposition = strpos($presignedUrl, "?");
                        if ($lastdotposition !== false) {
                            $link = substr($presignedUrl, 0, $lastdotposition);
                        }
                        $saveintable = new Savefiles();
                        $saveintable->Titel = $_POST['Textarea'][$file];
                        $saveintable->NameFile = $name;
                        $saveintable->Link = $link;
                        $saveintable->Position = $position;
                        $saveintable->save();
                    }
                } else {
                    foreach ($savefilestable as $data) {
                        if ($_POST['upload_file'][$file] == $data['Position']) {
                            $saveintable = Savefiles::findOne($data["idsavefiles"]);
                            $saveintable->Titel = $_POST['Textarea'][$file];
                            $saveintable->save();
                            $p = 1;
                            break;
                        }
                    }
                    if ($p == 0) {
                        $randomString = Yii::$app->getSecurity()->generateRandomString();
                        $position = trim($randomString, "_-");
                        $saveintable = new Savefiles();
                        $saveintable->Titel = $_POST['Textarea'][$file];
                        $saveintable->Position = $position;
                        $saveintable->save();
                    }
                }
            }
            $savefilestable = Savefiles::find()->all();
            return $this->redirect('form3');
        }
        return $this->render('form3', ['tabledata' => $savefilestable]);
    }
    public function actionForm4()
    {
        return $this->render('form4');
    }
    public function actionDelete($post)
    {
        $saveintable = new Savefiles();
        $deldata = $saveintable::findOne(['Position' => $post]);
        $deldata->delete();
        return $this->redirect('form3');
    }
}


// $saveuploadfile=$uploadfile;
// $uploadfile = $uploaddir . basename("Устав.pdf");
// if(file_exists("/home/vagrant/test/portal_local_repo/app/frontend/web/downloads/Устав.pdf"))
// {
// unlink("/home/vagrant/test/portal_local_repo/app/frontend/web/downloads/Устав.pdf");
// }
// if (copy($saveuploadfile, $uploadfile)){
//     // echo "Файл корректен и был успешно загружен.\n";
//     // echo $uploaddir;
// }
