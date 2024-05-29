<?php

namespace frontend\modules\takedatam\controllers;

use Yii;
use yii\helpers\FileHelper;
use yii\db\Query;
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
        // if ($action->id == 'form3') {
        //     $this->enableCsrfValidation = false;
        // }
        // if ($action->id == 'form2') {
        //     $this->enableCsrfValidation = false;
        // }

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
        $dataform = Dataforms::find()->all();
        $request = Yii::$app->request;
        if ($request->post('Massrows')) {
            foreach ($request->post('Massrows') as $number => $row) {
                $p = 0;
                foreach ($dataform as $idtable) {
                    if ($request->post('id')[$number] == $idtable['iddataforms']) {
                        $saveintable = Dataforms::findOne($request->post('id')[$number]);
                        $saveintable->datafilds = $row[0][0];
                        $saveintable->save();
                        $saveintable = Dataforms::findOne($request->post('id')[$number] + 1);
                        $saveintable->datafilds = $row[0][1];
                        $saveintable->save();
                        $saveintable = Dataforms::findOne($request->post('id')[$number] + 2);
                        $saveintable->datafilds = $row[0][2];
                        $saveintable->save();
                        if (isset($row[1])) {
                            $saveintable = new Form2email();
                            $emails = $saveintable::findAll(['iddataforms' => $request->post('id')[$number]]);
                            foreach ($row[1] as $num => $row1) {
                                if (isset($emails[$num]['idform2email'])) {
                                    $save = $saveintable::findOne(['idform2email' => $emails[$num]['idform2email']]);
                                    $save->email = $row1;
                                    $save->save();
                                } else {
                                    $saveintable = new Form2email();
                                    $saveintable->email = $row1;
                                    $saveintable->iddataforms = $request->post('id')[$number];
                                    $saveintable->save();
                                }

                            }
                        }
                        if (isset($row[2])) {
                            $saveintable = new Form2addres();
                            $address = $saveintable::findAll(['iddataforms' => $request->post('id')[$number]]);
                            foreach ($row[2] as $n => $row2) {
                                if (isset($address[$n]['idform2addres'])) {
                                    $save = $saveintable::findOne(['idform2addres' => $address[$n]['idform2addres']]);
                                    $save->addres = $row2;
                                    $save->save();
                                } else {
                                    $saveintable = new Form2addres();
                                    $saveintable->addres = $row2;
                                    $saveintable->iddataforms = $request->post('id')[$number];
                                    $saveintable->save();
                                }

                            }
                        }
                        $p = 1;
                    }
                }
                if ($p == 0) {
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
                            $saveintable = new Form2email();
                            $saveintable->iddataforms = $idfordop;
                            $saveintable->email = $row1;
                            $saveintable->save();
                        }
                    }
                    if (isset($row[2])) {
                        foreach ($row[2] as $row2) {
                            $saveintable = new Form2addres();
                            $saveintable->iddataforms = $idfordop;
                            $saveintable->addres = $row2;
                            $saveintable->save();
                        }
                    }
                }

            }
            //Конец сохранения адресов и сайтов
            return $this->redirect('form2');
        }
        $dataform = Dataforms::find()->one();
        $addres = Form2addres::find()->all();
        $email = Form2email::find()->all();
        $query = new Query();
        $query1 = $query->select(['iddataforms', 'datafilds',])->from('dataforms')->where(['namefildsforms' => 'Наименование учредителя образовательной организации'])->all();
        $query2 = $query->select(['iddataforms', 'datafilds',])->from('dataforms')->where(['namefildsforms' => 'Юридический адрес учредителя'])->all();
        $query3 = $query->select(['iddataforms', 'datafilds',])->from('dataforms')->where(['namefildsforms' => 'Контактный телефон учредителя'])->all();
        return $this->render('form2', ['query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'dataform' => $dataform, 'tableaddres' => $addres, 'tableemail' => $email]);
    }

    public function actionForm3()
    {
        $request = Yii::$app->request;
        $savefilestable = Savefiles::find()->all();
        $key = Yii::$app->params['key'];
        $secret = Yii::$app->params['secret'];
        $endpoint = Yii::$app->params['endpoint'];
        $bucket = Yii::$app->params['Bucket'];
        if (isset($_FILES['upload_file'])) {
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
                            $position = $data['Position'];
                            $testMimeType = FileHelper::getMimeTypeByExtension($name);
                            $s3->putObject([
                                'Bucket' => $bucket,
                                'Key' => $position,
                                'Body' => file_get_contents($_FILES['upload_file']['tmp_name'][$file]),
                                'ContentDisposition' => '"inline"',
                                'ContentType' => $testMimeType
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
                            $saveintable->NameFile = $_POST['Textarea'][$file];
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
                        $testMimeType = FileHelper::getMimeTypeByExtension($name);
                        $s3->putObject([
                            'Bucket' => $bucket,
                            'Key' => $position,
                            'Body' => file_get_contents($_FILES['upload_file']['tmp_name'][$file]),
                            'ContentDisposition' => '"inline"',
                            'ContentType' => $testMimeType
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
                        $saveintable->NameFile = $request->post('Textarea')[$file];
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
        $request = Yii::$app->request;
        $dataforms = new Dataforms();
        $data = $dataforms::find()->select(['iddataforms'])->where(['namefildsforms' => 'Название для ссылки'])->all();
        if ($request->post('Fieldsurl')) {
            foreach ($request->post('Fieldsurl') as $number => $fild) {
                $p = 0;
                foreach ($data as $id) {
                    if ($request->post('id')[$number] == $id['iddataforms']) {
                        $dataforms = new Dataforms();
                        $save = $dataforms::findOne($request->post('id')[$number]);
                        $save->datafilds = $fild[0];
                        $save->save();
                        $dataforms = new Dataforms();
                        $save = $dataforms::findOne($request->post('id')[$number] + 1);
                        $save->datafilds = $fild[1];
                        $save->save();
                        $p = 1;
                    }
                }
                if ($p == 0) {
                    $dataforms = new Dataforms();
                    $dataforms->namefildsforms = 'Название для ссылки';
                    $dataforms->datafilds = $fild[0];
                    $dataforms->save();
                    $dataforms = new Dataforms();
                    $dataforms->namefildsforms = 'Ссылка';
                    $dataforms->datafilds = $fild[1];
                    $dataforms->save();
                }
            }
            return $this->redirect('form4');
        }
        $dataforms = new Dataforms();
        $nameurl = $dataforms::find()->where(['namefildsforms' => 'Название для ссылки'])->all();
        $url = $dataforms::find()->where(['namefildsforms' => 'Ссылка'])->all();
        return $this->render('form4', ['nameurl' => $nameurl, 'url' => $url]);
    }
    public function actionPaidedu()
    {
        $request = Yii::$app->request;
        if ($request->post('paid_educational')) {
            $takedata = new Dataforms();
            $data = $takedata::find()->where(['or', 'variable=1', 'variable=2', 'variable=3', 'variable=4'])->all();
            foreach ($request->post('paid_educational') as $row) {
                $p = 0;
                foreach ($data as $idtable) {
                    if ($row[0] == $idtable['iddataforms']) {
                        $saveintable = Dataforms::findOne($row[0]);
                        $saveintable->namefildsforms = $row[2];
                        $saveintable->datafilds = $row[3];
                        $saveintable->save();
                        $p = 1;
                    }
                }
                if ($p == 0) {
                    $saveintable = new Dataforms();
                    $saveintable->variable = $row[1];
                    $saveintable->namefildsforms = $row[2];
                    $saveintable->datafilds = $row[3];
                    $saveintable->save();
                }
            }
            return $this->redirect('paid_edu');
        }
        $takedata = new Dataforms();
        $data = $takedata::find()->where(['or', 'variable=1', 'variable=2', 'variable=3', 'variable=4'])->all();
        return $this->render('paid_edu', ['data' => $data,]);
    }
    public function actionGrants()
    {
        $request = Yii::$app->request;
        if ($request->post('paid_educational')) {
            $takedata = new Dataforms();
            $data = $takedata::find()->where(['or', 'variable=5', 'variable=6', 'variable=7', 'variable=8', 'variable=9', 'variable=10'])->all();
            foreach ($request->post('paid_educational') as $row) {
                $p = 0;
                foreach ($data as $idtable) {
                    if ($row[0] == $idtable['iddataforms']) {
                        $saveintable = Dataforms::findOne($row[0]);
                        $saveintable->namefildsforms = $row[2];
                        $saveintable->datafilds = $row[3];
                        $saveintable->save();
                        $p = 1;
                    }
                }
                if ($p == 0) {
                    $saveintable = new Dataforms();
                    $saveintable->variable = $row[1];
                    $saveintable->namefildsforms = $row[2];
                    $saveintable->datafilds = $row[3];
                    $saveintable->save();
                }
            }
            return $this->redirect('grants');
        }
        $takedata = new Dataforms();
        $data = $takedata::find()->where(['or', 'variable=5', 'variable=6', 'variable=7', 'variable=8', 'variable=9', 'variable=10'])->all();
        return $this->render('grants', ['data' => $data,]);
    }
    public function actionDocument()
    {
        $request = Yii::$app->request;
        $savefilestable = Savefiles::find()->all();
        $key = Yii::$app->params['key'];
        $secret = Yii::$app->params['secret'];
        $endpoint = Yii::$app->params['endpoint'];
        $bucket = Yii::$app->params['Bucket'];
        //массив с разрешенными расширениями файлов
        $acTypesFileForUploading = array(
            "image/jpeg",//jpg or jpeg
            "image/png",//png
            "application/pdf",//pdf
            "application/msword",//doc (not docx)
            "application/vnd.ms-excel",//xls (not xlsx)
            "text/csv",//csv
            //"application/vnd.openxmlformats-officedocument.wordprocessingml.document",//docx
            //"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",//xlsx
            //"application/vnd.ms-powerpoint",//ppt
            //"application/vnd.openxmlformats-officedocument.presentationml.presentation",//pptx
        );
        if (isset($_FILES['document'])) {
            $savefilestable = Savefiles::find()->all();
            foreach ($_FILES['document']['name'] as $file => $name) {
                $p = 0;
                if ($name != '') {
                    foreach ($savefilestable as $data) {
                        //Поиск записи и её перезапись
                        if ($request->post('document')[$file][0] == $data['Position']) {
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
                            $position = $data['Position'];
                            $testMimeType = FileHelper::getMimeTypeByExtension($name);
                            //Проверка, что расширение файла разрешено
                            if (in_array($testMimeType, $acTypesFileForUploading)) {
                                $s3->putObject([
                                    'Bucket' => $bucket,
                                    'Key' => $position,
                                    'Body' => file_get_contents($_FILES['document']['tmp_name'][$file]),
                                    'ContentDisposition' => '"inline"',
                                    'ContentType' => $testMimeType
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
                            } else {
                                $link = "Загрузка не удалась, проверьте тип фалйа";
                            }
                            //Сохранение в бд
                            $saveintable = Savefiles::findOne($data["idsavefiles"]);
                            $saveintable->Titel = $request->post('document')[$file][2];
                            $saveintable->NameFile = $request->post('document')[$file][1];
                            $saveintable->Link = $link;
                            $saveintable->save();
                            $p = 1;
                            break;
                        }
                    }
                    //Первое сохранения файла
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
                        $testMimeType = FileHelper::getMimeTypeByExtension($name);
                        //Проверка, что расширение файла разрешено
                        if (in_array($testMimeType, $acTypesFileForUploading)) {
                            $s3->putObject([
                                'Bucket' => $bucket,
                                'Key' => $position,
                                'Body' => file_get_contents($_FILES['document']['tmp_name'][$file]),
                                'ContentDisposition' => '"inline"',
                                'ContentType' => $testMimeType
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
                        } else {
                            $link = "Загрузка не удалась, проверьте тип фалйа";
                        }
                        //Сохранение в бд
                        $saveintable = new Savefiles();
                        $saveintable->Titel = $request->post('document')[$file][2];
                        $saveintable->NameFile = $request->post('document')[$file][1];
                        $saveintable->Link = $link;
                        $saveintable->Position = $position;
                        $saveintable->save();
                    }
                } else {
                    foreach ($savefilestable as $data) {
                        if ($request->post('document')[$file][0] == $data['Position']) {
                            $saveintable = Savefiles::findOne($data["idsavefiles"]);
                            $saveintable->Titel = $request->post('document')[$file][2];
                            $saveintable->save();
                            $p = 1;
                            break;
                        }
                    }
                    //Сохранение в бд только назначения файла, если пользователь не выбрал файл
                    if ($p == 0) {
                        $randomString = Yii::$app->getSecurity()->generateRandomString();
                        $position = trim($randomString, "_-");
                        $saveintable = new Savefiles();
                        $saveintable->Titel = $request->post('document')[$file][2];
                        $saveintable->NameFile = $request->post('document')[$file][1];
                        $saveintable->Position = $position;
                        $saveintable->save();
                    }
                }
            }
            $savefilestable = Savefiles::find()->all();
            return $this->redirect('document');
        }
        return $this->render('document', ['tabledata' => $savefilestable]);
    }
    //Дальше идут удаления
    public function actionDeleteform2($post, $what_to_delete)
    {
        if ($what_to_delete == 'row') {
            $delintable = new Dataforms();
            $deldata = $delintable::findOne(['iddataforms' => $post]);
            $deldata->delete();
            $delintable = new Dataforms();
            $deldata = $delintable::findOne(['iddataforms' => $post + 1]);
            $deldata->delete();
            $delintable = new Dataforms();
            $deldata = $delintable::findOne(['iddataforms' => $post + 2]);
            $deldata->delete();
        }
        if ($what_to_delete == 'email') {
            $delintale = new Form2email;
            $deldata = $delintale::findOne(['idform2email' => $post]);
            $deldata->delete();
        }
        if ($what_to_delete == 'address') {
            $delintale = new Form2addres();
            $deldata = $delintale::findOne(['idform2addres' => $post]);
            $deldata->delete();
        }
        return $this->redirect('form2');
    }
    public function actionDeleteform3($post)
    {
        $saveintable = new Savefiles();
        $deldata = $saveintable::findOne(['Position' => $post]);
        $deldata->delete();
        return $this->redirect('form3');
    }
    public function actionDeleteform4($post)
    {
        $saveintable = new Dataforms();
        $deldata = $saveintable::findOne(['iddataforms' => $post]);
        $deldata->delete();
        $deldata = $saveintable::findOne(['iddataforms' => $post + 1]);
        $deldata->delete();
        return $this->redirect('form4');
    }
    public function actionDeletepaidedu($post)
    {
        $delintable = new Dataforms();
        $deldata = $delintable::findOne(['iddataforms' => $post]);
        $deldata->delete();
        return $this->redirect('paid_edu');
    }
    public function actionDeletegrants($post)
    {
        $delintable = new Dataforms();
        $deldata = $delintable::findOne(['iddataforms' => $post]);
        $deldata->delete();
        return $this->redirect('grants');
    }
    public function actionDeletedocument($post)
    {
        $key = Yii::$app->params['key'];
        $secret = Yii::$app->params['secret'];
        $endpoint = Yii::$app->params['endpoint'];
        $bucket = Yii::$app->params['Bucket'];
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
        $s3->deleteObject([
            'Bucket' => $bucket,
            'Key' => $post,
        ]);
        $saveintable = new Savefiles();
        $deldata = $saveintable::findOne(['Position' => $post]);
        $deldata->delete();
        return $this->redirect('document');
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
