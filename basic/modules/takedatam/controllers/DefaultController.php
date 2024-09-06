<?php

namespace frontend\modules\takedatam\controllers;

use Yii;
use yii\helpers\FileHelper;
use yii\db\Query;
use yii\web\Controller;
use yii\validators\UrlValidator;
use frontend\modules\takedatam\models\Dataforms;
use frontend\modules\takedatam\models\Form2addres;
use frontend\modules\takedatam\models\Form2email;
use frontend\modules\takedatam\models\Savefiles;
use frontend\modules\takedatam\models\UploadForm;
use frontend\modules\takedatam\models\Fieldsforms;
use frontend\modules\takedatam\models\ExtraFields;
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
        // if ($action->id == 'paid_edu') {
        //     $this->enableCsrfValidation = false;
        // }

        // $this->enableCsrfValidation = true; 
        Yii::$app->request->enableCsrfValidation = true;

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
        $saveintable->titel = 'О полном наименовании образовательной организации';
        $dataht = $request->get('Textarea1');
        $saveintable->data = $dataht;
        $saveintable->save();

        $saveintable = new Dataforms();
        $saveintable->titel = 'Сокращенное (при наличии) наименование образовательной организации';
        $dataht = $request->get('Textarea2');
        $saveintable->data = $dataht;
        $saveintable->save();

        $saveintable = new Dataforms();
        $saveintable->titel = 'Дата создания образовательной организации';
        $dataht = $request->get('Textarea3');
        $saveintable->data = $dataht;
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
                    if ($request->post('id')[$number] == $idtable['id']) {
                        $saveintable = Dataforms::findOne($request->post('id')[$number]);
                        $saveintable->data = $row[0][0];
                        $saveintable->save();
                        $saveintable = Dataforms::findOne($request->post('id')[$number] + 1);
                        $saveintable->data = $row[0][1];
                        $saveintable->save();
                        $saveintable = Dataforms::findOne($request->post('id')[$number] + 2);
                        $saveintable->data = $row[0][2];
                        $saveintable->save();
                        if (isset($row[1])) {
                            $saveintable = new Form2email();
                            $emails = $saveintable::findAll(['id' => $request->post('id')[$number]]);
                            foreach ($row[1] as $num => $row1) {
                                if (isset($emails[$num]['idform2email'])) {
                                    $save = $saveintable::findOne(['idform2email' => $emails[$num]['idform2email']]);
                                    $save->email = $row1;
                                    $save->save();
                                } else {
                                    $saveintable = new Form2email();
                                    $saveintable->email = $row1;
                                    $saveintable->id = $request->post('id')[$number];
                                    $saveintable->save();
                                }

                            }
                        }
                        if (isset($row[2])) {
                            $saveintable = new Form2addres();
                            $address = $saveintable::findAll(['id' => $request->post('id')[$number]]);
                            foreach ($row[2] as $n => $row2) {
                                if (isset($address[$n]['idform2addres'])) {
                                    $save = $saveintable::findOne(['idform2addres' => $address[$n]['idform2addres']]);
                                    $save->addres = $row2;
                                    $save->save();
                                } else {
                                    $saveintable = new Form2addres();
                                    $saveintable->addres = $row2;
                                    $saveintable->id = $request->post('id')[$number];
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
                    $saveintable->titel = 'Наименование учредителя образовательной организации';
                    $saveintable->data = $row[0][0];
                    $saveintable->save();
                    $idfordop = Yii::$app->db->getLastInsertID();

                    $saveintable = new Dataforms();
                    $saveintable->titel = 'Юридический адрес учредителя';
                    $saveintable->data = $row[0][1];
                    $saveintable->save();

                    $saveintable = new Dataforms();
                    $saveintable->titel = 'Контактный телефон учредителя';
                    $saveintable->data = $row[0][2];
                    $saveintable->save();
                    //Конец сохранения всех textarea  в строке

                    //Сохранение адресов и сайтов
                    if (isset($row[1])) {
                        foreach ($row[1] as $row1) {
                            $saveintable = new Form2email();
                            $saveintable->id = $idfordop;
                            $saveintable->email = $row1;
                            $saveintable->save();
                        }
                    }
                    if (isset($row[2])) {
                        foreach ($row[2] as $row2) {
                            $saveintable = new Form2addres();
                            $saveintable->id = $idfordop;
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
        $query1 = $query->select(['id', 'data',])->from('dataforms')->where(['titel' => 'Наименование учредителя образовательной организации'])->all();
        $query2 = $query->select(['id', 'data',])->from('dataforms')->where(['titel' => 'Юридический адрес учредителя'])->all();
        $query3 = $query->select(['id', 'data',])->from('dataforms')->where(['titel' => 'Контактный телефон учредителя'])->all();
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
                        if ($_POST['upload_file'][$file] == $data['position']) {
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
                            $saveintable = Savefiles::findOne($data["id"]);
                            $saveintable->titel = $_POST['Textarea'][$file];
                            $saveintable->fieldsforms_id = $_POST['Textarea'][$file];
                            $saveintable->link = $link;
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
                        $saveintable->titel = $_POST['Textarea'][$file];
                        $saveintable->fieldsforms_id = $request->post('Textarea')[$file];
                        $saveintable->link = $link;
                        $saveintable->position = $position;
                        $saveintable->save();
                    }
                } else {
                    foreach ($savefilestable as $data) {
                        if ($_POST['upload_file'][$file] == $data['position']) {
                            $saveintable = Savefiles::findOne($data["id"]);
                            $saveintable->titel = $_POST['Textarea'][$file];
                            $saveintable->save();
                            $p = 1;
                            break;
                        }
                    }
                    if ($p == 0) {
                        $randomString = Yii::$app->getSecurity()->generateRandomString();
                        $position = trim($randomString, "_-");
                        $saveintable = new Savefiles();
                        $saveintable->titel = $_POST['Textarea'][$file];
                        $saveintable->position = $position;
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
        $data = $dataforms::find()->select(['id'])->where(['titel' => 'Название для ссылки'])->all();
        if ($request->post('Fieldsurl')) {
            foreach ($request->post('Fieldsurl') as $number => $fild) {
                $p = 0;
                foreach ($data as $id) {
                    if ($request->post('id')[$number] == $id['id']) {
                        $dataforms = new Dataforms();
                        $save = $dataforms::findOne($request->post('id')[$number]);
                        $save->data = $fild[0];
                        $save->save();
                        $dataforms = new Dataforms();
                        $save = $dataforms::findOne($request->post('id')[$number] + 1);
                        $save->data = $fild[1];
                        $save->save();
                        $p = 1;
                    }
                }
                if ($p == 0) {
                    $dataforms = new Dataforms();
                    $dataforms->titel = 'Название для ссылки';
                    $dataforms->data = $fild[0];
                    $dataforms->save();
                    $dataforms = new Dataforms();
                    $dataforms->titel = 'Ссылка';
                    $dataforms->data = $fild[1];
                    $dataforms->save();
                }
            }
            return $this->redirect('form4');
        }
        $dataforms = new Dataforms();
        $nameurl = $dataforms::find()->where(['titel' => 'Название для ссылки'])->all();
        $url = $dataforms::find()->where(['titel' => 'Ссылка'])->all();
        return $this->render('form4', ['nameurl' => $nameurl, 'url' => $url]);
    }
    public function actionPaidedu()
    {
        $takedata = new Dataforms();
        $data = $takedata::find()
            ->joinWith('fieldsforms')
            ->andWhere(['fieldsforms.nameform' => 'paid_edu'])
            ->all();
        $request = Yii::$app->request;
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
        if (isset($_FILES['document']) && $request->post('document')) {
            foreach ($_FILES['document']['name'] as $file => $name) {
                $link = '';
                $p = 0;
                $position = '';
                //Проверка на наличие файла
                if ($name != '') {
                    $testMimeType = FileHelper::getMimeTypeByExtension($name);
                    //Проверка на расширение файла
                    if (in_array($testMimeType, $acTypesFileForUploading)) {
                        //Проверка, что запись старая
                        if ($request->post('document')[$file][0] != '0') {
                            //Поиск записи и её перезапись
                            $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                            if (!empty($saveintable)) {
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
                                $position = $saveintable['position'];
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
                                $saveintable->titel = $request->post('document')[$file][2];
                                $saveintable->data = $link;
                                $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                if ($saveintable->validate()) {
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            //Новая запись в бд
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
                            $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                            $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                            $position = $tabel_filds->fieldform . $count_upload_doc;
                            $testMimeType = FileHelper::getMimeTypeByExtension($name);
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
                            $saveintable = new Dataforms();
                            $saveintable->titel = $request->post('document')[$file][2];
                            $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                            $saveintable->data = $link;
                            $saveintable->position = $position;
                            if ($saveintable->validate()) {
                                $tabel_filds->count_upload_doc = $count_upload_doc;
                                $tabel_filds->save();
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    } else {
                        $p = 1;
                    }
                } else {
                    //Запись в бд при отсутствии файла
                    //Проверка,что запись старая
                    if ($request->post('document')[$file][0] != '0') {
                        $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                        //Поиск записи и её перезапись
                        if (!empty($saveintable) && $saveintable['titel'] != $request->post('document')[$file][2]) {
                            $saveintable->titel = $request->post('document')[$file][2];
                            $saveintable->updated_at = new \yii\db\Expression('NOW()');
                            if ($saveintable->validate()) {
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    } else {
                        //Запись новых данных
                        $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                        $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                        $position = $tabel_filds->fieldform . $count_upload_doc;
                        $saveintable = new Dataforms();
                        $saveintable->titel = $request->post('document')[$file][2];
                        $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                        $saveintable->position = $position;
                        if ($saveintable->validate()) {
                            $tabel_filds->count_upload_doc = $count_upload_doc;
                            $tabel_filds->save();
                            $saveintable->save();
                        } else {
                            $p = 1;
                        }
                    }
                }
                //Проверка была ли допущена,где-то ошибка при добавлении данных
                if ($p == 1) {
                    //Проверка, что  запись старая
                    if ($request->post('document')[$file][0] != '0') {
                        $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                        $wrong[] = [
                            'titel' => $request->post('document')[$file][2],
                            'fieldsforms_id' => $request->post('document')[$file][1],
                            'position' => $request->post('document')[$file][0],
                            'data' => $saveintable->data
                        ];
                    } else {
                        $wrong[] = [
                            'titel' => $request->post('document')[$file][2],
                            'fieldsforms_id' => $request->post('document')[$file][1],
                            'position' => '0',
                            'data' => ''
                        ];
                    }
                    //Создание в сесси переменной wrong_data, куда передается массив wrong с ошибками
                    Yii::$app->session->set('wrong_data', $wrong);
                    Yii::$app->session->setFlash('error', 'Проверьте правильность введенных данных.');
                }
            }
            return $this->redirect('');
        }
        return $this->render('paid_edu', ['tabledata' => $data]);
    }
    public function actionGrantsold()
    {
        $request = Yii::$app->request;
        if ($request->post('paid_educational')) {
            foreach ($request->post('paid_educational') as $row) {
                $p = 0;
                if (!empty($row[3]) && ((new UrlValidator())->validate($row[3]))) {
                    if ($row[0] != '0') {
                        $saveintable = Dataforms::findOne($row[0]);
                        if (!empty($saveintable) && ($row[3] != $saveintable['data'] || $row[2] != $saveintable['titel'])) {
                            $saveintable->titel = $row[2];
                            $saveintable->data = $row[3];
                            $saveintable->updated_at = new \yii\db\Expression('NOW()');
                            if ($saveintable->validate()) {
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    } else {
                        $saveintable = new Dataforms();
                        $saveintable->fieldsforms_id = $row[1];
                        $saveintable->titel = $row[2];
                        $saveintable->data = $row[3];
                        if ($saveintable->validate()) {
                            $saveintable->save();
                        } else {
                            $p = 1;
                        }
                    }
                } else {
                    $p = 1;
                }
                if ($p == 1) {
                    //Заполняем пустую link следующим текстом
                    if (empty($row[3])) {
                        $row[3] = "Введите данные";
                    }
                    // Проверка на то какая это запись, новая или старая
                    if ($row[0] == 0) {
                        $wrong[] = [
                            "titel" => $row[2],
                            "id" => 0,
                            "data" => $row[3],
                            "fieldsforms_id" => $row[1]
                        ];
                    } else {
                        $wrong[] = [
                            "titel" => $row[2],
                            "id" => $row[0],
                            "data" => $row[3],
                            "fieldsforms_id" => $row[1]
                        ];
                    }
                    // Создание переменной в сесси wrong_data, которая будет содержать ошибки допущенные пользователем
                    Yii::$app->session->set('wrong_data', $wrong);
                    Yii::$app->session->setFlash('error', 'Проверьте правильность введенных данных.');
                }
            }
            return $this->redirect('grants');
        }
        $takedata = new Dataforms();
        $data = $takedata::find()
            ->joinWith('fieldsforms')
            ->andWhere(['fieldsforms.nameform' => 'grants'])
            ->all();
        // Проверка на то  есть ли переменная wrong_data
        if (Yii::$app->session->has('wrong_data')) {
            $wrong_data = Yii::$app->session->get('wrong_data');
            //Если переменная wrong_data есть, сравнимаем полученные данные из таблицы 
            //и либо заменяем их, либо добавляем новые в массив data
            foreach ($wrong_data as $wr) {
                if ($wr["id"] != 0) {
                    foreach ($data as $tabledata) {
                        if ($wr["id"] == $tabledata["id"]) {
                            $tabledata["titel"] = $wr["titel"];
                            $tabledata["data"] = $wr["data"];
                            break;
                        }
                    }
                } else {
                    $data[] = $wr;
                }
            }
            Yii::$app->session->remove('wrong_data');
        }
        return $this->render('grantsold', ['tabledata' => $data,]);
    }
    public function actionDocument()
    {
        $takedata = new Dataforms();
        $request = Yii::$app->request;
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
        if (isset($_FILES['document']) && $request->post('document')) {
            foreach ($_FILES['document']['name'] as $file => $name) {
                $link = '';
                $p = 0;
                $position = '';
                //Проверка на наличие файла
                if ($name != '') {
                    $testMimeType = FileHelper::getMimeTypeByExtension($name);
                    //Проверка на расширение файла
                    if (in_array($testMimeType, $acTypesFileForUploading)) {
                        //Проверка, что запись старая
                        if ($request->post('document')[$file][0] != '0') {
                            //Поиск записи и её перезапись
                            $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                            if (!empty($saveintable)) {
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
                                $position = $saveintable['position'];
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
                                $saveintable->titel = $request->post('document')[$file][2];
                                $saveintable->data = $link;
                                $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                if ($saveintable->validate()) {
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            //Новая запись в бд
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
                            $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                            $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                            $position = $tabel_filds->fieldform . $count_upload_doc;
                            $testMimeType = FileHelper::getMimeTypeByExtension($name);
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
                            $saveintable = new Dataforms();
                            $saveintable->titel = $request->post('document')[$file][2];
                            $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                            $saveintable->data = $link;
                            $saveintable->position = $position;
                            if ($saveintable->validate()) {
                                $tabel_filds->count_upload_doc = $count_upload_doc;
                                $tabel_filds->save();
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    } else {
                        $p = 1;
                    }
                } else {
                    //Запись в бд при отсутствии файла
                    //Проверка,что запись старая
                    if ($request->post('document')[$file][0] != '0') {
                        $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                        //Поиск записи и её перезапись
                        if (!empty($saveintable) && $saveintable['titel'] != $request->post('document')[$file][2]) {
                            $saveintable->titel = $request->post('document')[$file][2];
                            $saveintable->updated_at = new \yii\db\Expression('NOW()');
                            if ($saveintable->validate()) {
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    } else {
                        //Запись новых данных
                        $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                        $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                        $position = $tabel_filds->fieldform . $count_upload_doc;
                        $saveintable = new Dataforms();
                        $saveintable->titel = $request->post('document')[$file][2];
                        $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                        $saveintable->position = $position;
                        if ($saveintable->validate()) {
                            $tabel_filds->count_upload_doc = $count_upload_doc;
                            $tabel_filds->save();
                            $saveintable->save();
                        } else {
                            $p = 1;
                        }
                    }
                }
                //Проверка была ли допущена,где-то ошибка при добавлении данных
                if ($p == 1) {
                    //Проверка, что  запись старая
                    if ($request->post('document')[$file][0] != '0') {
                        $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                        $wrong[] = [
                            'titel' => $request->post('document')[$file][2],
                            'fieldsforms_id' => $request->post('document')[$file][1],
                            'position' => $request->post('document')[$file][0],
                            'data' => $saveintable->data
                        ];
                    } else {
                        $wrong[] = [
                            'titel' => $request->post('document')[$file][2],
                            'fieldsforms_id' => $request->post('document')[$file][1],
                            'position' => '0',
                            'data' => ''
                        ];
                    }
                    //Создание в сесси переменной wrong_data, куда передается массив wrong с ошибками
                    Yii::$app->session->set('wrong_data', $wrong);
                    Yii::$app->session->setFlash('error', 'Проверьте правильность введенных данных.');
                }
            }
            return $this->redirect('document');
        }
        $savefilestable = $takedata::find()
            ->joinWith('fieldsforms')
            ->andWhere(['fieldsforms.nameform' => 'document'])
            ->all();
        $position_wrong[] = '';
        if (Yii::$app->session->has('wrong_data')) {
            $position_wrong[] = '0';
            $wrong_data = Yii::$app->session->get('wrong_data');
            //Если переменная wrong_data есть, сравнимаем полученные данные из таблицы 
            //и либо заменяем их, либо добавляем новые в массив data
            foreach ($wrong_data as $wr) {
                if ($wr["position"] != '0') {
                    foreach ($savefilestable as $tabledata) {
                        if ($wr["position"] == $tabledata["position"]) {
                            $tabledata["titel"] = $wr["titel"];
                            $position_wrong[] = $wr["position"];
                            break;
                        }
                    }
                } else {
                    $savefilestable[] = $wr;
                }
            }
            Yii::$app->session->remove('wrong_data');
        }
        return $this->render('document', ['tabledata' => $savefilestable, 'position_wrong' => $position_wrong]);
    }
    public function actionCommon()
    {
        $takedata = new Dataforms();
        $datarows = $takedata::find()
            ->joinWith('fieldsforms')
            ->andWhere(['and', ['fieldsforms.nameform' => 'common'], ['position' => Null]])
            ->joinWith('extraFields')
            ->all();
        $datadoc = $takedata::find()->joinWith('fieldsforms')
            ->andWhere(['or', ['fieldsforms.fieldform' => 'licence_to_carry_out_educational_activities'], ['fieldsforms.fieldform' => 'state_accreditation_of_educational_activities_under_implemented_educational_programmes']])
            ->all();
        $request = Yii::$app->request;
        if ($request->post()) {
            if ($request->post('common')) {
                if ($request->post('common')[0][0][0] != 0) {
                    $change_true = false;
                    $dataforms = new Dataforms();
                    $dataforms = $dataforms::findOne($request->post('common')[0][0][0]);
                    if ($request->post('common')[0][0][2] != $dataforms->titel or $request->post('common')[0][0][3] != $dataforms->data) {
                        $dataforms->titel = $request->post('common')[0][0][2];
                        $dataforms->data = $request->post('common')[0][0][3];
                        $dataforms->save();
                        $change_true = true;
                    }
                    $income_true = false;
                    $expenditure_true = false;
                    $website_true = false;
                    if (!empty($request->post('common')[0][1][0]) or !empty($request->post('common')[0][2][0]) or !empty($request->post('common')[0][3][0])) {
                        $extraFields = new ExtraFields();
                        $extraFields = $extraFields::find()->where(['dataforms_id' => $request->post('common')[0][0][0]])->all();
                        if (!empty($extraFields)) {
                            foreach ($extraFields as $extraField) {
                                switch ($extraField["type"]) {
                                    case "phone":
                                        if ($extraField["data"] != $request->post('common')[0][1][0]) {
                                            $chagedata = ExtraFields::findOne($extraField["id"]);
                                            $chagedata->data = $request->post('common')[0][1][0];
                                            $chagedata->save();
                                        }
                                        $change_true = true;
                                        $income_true = true;
                                        break;
                                    case "email":
                                        if ($extraField["data"] != $request->post('common')[0][2][0]) {
                                            $chagedata = ExtraFields::findOne($extraField["id"]);
                                            $chagedata->data = $request->post('common')[0][2][0];
                                            $chagedata->save();
                                        }
                                        $change_true = true;
                                        $expenditure_true = true;
                                        break;
                                    case "website":
                                        if ($extraField["data"] != $request->post('common')[0][3][0]) {
                                            $chagedata = ExtraFields::findOne($extraField["id"]);
                                            $chagedata->data = $request->post('common')[0][3][0];
                                            $chagedata->save();
                                        }
                                        $change_true = true;
                                        $website_true = true;
                                        break;
                                }
                            }
                            if (!empty($request->post('common')[0][1][0]) && !$income_true) {
                                $extraFields = new ExtraFields();
                                $extraFields->type = 'phone';
                                $extraFields->data = $request->post('common')[0][1][0];
                                $extraFields->dataforms_id = $request->post('common')[0][0][0];
                                $extraFields->fieldsforms_id = 24;
                                $extraFields->save();
                                $change_true = true;
                            }
                            if (!empty($request->post('common')[0][2][0]) && !$expenditure_true) {
                                $extraFields = new ExtraFields();
                                $extraFields->type = 'email';
                                $extraFields->data = $request->post('common')[0][2][0];
                                $extraFields->dataforms_id = $request->post('common')[0][0][0];
                                $extraFields->fieldsforms_id = 24;
                                $extraFields->save();
                                $change_true = true;
                            }
                            if (!empty($request->post('common')[0][3][0]) && !$website_true) {
                                $extraFields = new ExtraFields();
                                $extraFields->type = 'website';
                                $extraFields->data = $request->post('common')[0][3][0];
                                $extraFields->dataforms_id = $request->post('common')[0][0][0];
                                $extraFields->fieldsforms_id = 24;
                                $extraFields->save();
                                $change_true = true;
                            }
                        } else {
                            if (!empty($request->post('common')[0][1][0])) {
                                $extraFields = new ExtraFields();
                                $extraFields->type = 'phone';
                                $extraFields->data = $request->post('common')[0][1][0];
                                $extraFields->dataforms_id = $request->post('common')[0][0][0];
                                $extraFields->fieldsforms_id = 24;
                                $extraFields->save();
                                $change_true = true;
                            }
                            if (!empty($request->post('common')[0][2][0])) {
                                $extraFields = new ExtraFields();
                                $extraFields->type = 'email';
                                $extraFields->data = $request->post('common')[0][2][0];
                                $extraFields->dataforms_id = $request->post('common')[0][0][0];
                                $extraFields->fieldsforms_id = 24;
                                $extraFields->save();
                                $change_true = true;
                            }
                            if (!empty($request->post('common')[0][3][0])) {
                                $extraFields = new ExtraFields();
                                $extraFields->type = 'website';
                                $extraFields->data = $request->post('common')[0][3][0];
                                $extraFields->dataforms_id = $request->post('common')[0][0][0];
                                $extraFields->fieldsforms_id = 24;
                                $extraFields->save();
                                $change_true = true;
                            }
                        }
                    }
                    if ($change_true) {
                        $dataforms = Dataforms::findOne($request->post('common')[0][0][0]);
                        $dataforms->updated_at = new \yii\db\Expression('NOW()');
                        $dataforms->save();
                    }
                } else {
                    $dataforms = new Dataforms();
                    $dataforms->fieldsforms_id = 24;
                    $dataforms->titel = $request->post('common')[0][0][2];
                    $dataforms->data = $request->post('common')[0][0][3];
                    $dataforms->save();
                    $idDataformsforExtraFields = Yii::$app->db->getLastInsertID();
                    if (!empty($request->post('common')[0][1][0])) {
                        $extraFields = new ExtraFields();
                        $extraFields->type = 'phone';
                        $extraFields->data = $request->post('common')[0][1][0];
                        $extraFields->dataforms_id = $idDataformsforExtraFields;
                        $extraFields->fieldsforms_id = 24;
                        $extraFields->save();
                    }
                    if (!empty($request->post('common')[0][2][0])) {
                        $extraFields = new ExtraFields();
                        $extraFields->type = 'email';
                        $extraFields->data = $request->post('common')[0][2][0];
                        $extraFields->dataforms_id = $idDataformsforExtraFields;
                        $extraFields->fieldsforms_id = 24;
                        $extraFields->save();
                    }
                    if (!empty($request->post('common')[0][3][0])) {
                        $extraFields = new ExtraFields();
                        $extraFields->type = 'website';
                        $extraFields->data = $request->post('common')[0][3][0];
                        $extraFields->dataforms_id = $idDataformsforExtraFields;
                        $extraFields->fieldsforms_id = 24;
                        $extraFields->save();
                    }

                }

            }
            $request = Yii::$app->request;
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
            if (isset($_FILES['document']) && $request->post('document')) {
                foreach ($_FILES['document']['name'] as $file => $name) {
                    $link = '';
                    $p = 0;
                    $position = '';
                    //Проверка на наличие файла
                    if ($name != '') {
                        $testMimeType = FileHelper::getMimeTypeByExtension($name);
                        //Проверка на расширение файла
                        if (in_array($testMimeType, $acTypesFileForUploading)) {
                            //Проверка, что запись старая
                            if ($request->post('document')[$file][0] != '0') {
                                //Поиск записи и её перезапись
                                $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                                if (!empty($saveintable)) {
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
                                    $position = $saveintable['position'];
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
                                    $saveintable->titel = $request->post('document')[$file][2];
                                    $saveintable->data = $link;
                                    $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                    if ($saveintable->validate()) {
                                        $saveintable->save();
                                    } else {
                                        $p = 1;
                                    }
                                }
                            } else {
                                //Новая запись в бд
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
                                $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                                $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                                $position = $tabel_filds->fieldform . $count_upload_doc;
                                $testMimeType = FileHelper::getMimeTypeByExtension($name);
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
                                $saveintable = new Dataforms();
                                $saveintable->titel = $request->post('document')[$file][2];
                                $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                                $saveintable->data = $link;
                                $saveintable->position = $position;
                                if ($saveintable->validate()) {
                                    $tabel_filds->count_upload_doc = $count_upload_doc;
                                    $tabel_filds->save();
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            $p = 1;
                        }
                    } else {
                        //Запись в бд при отсутствии файла
                        //Проверка,что запись старая
                        if ($request->post('document')[$file][0] != '0') {
                            $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                            //Поиск записи и её перезапись
                            if (!empty($saveintable) && $saveintable['titel'] != $request->post('document')[$file][2]) {
                                $saveintable->titel = $request->post('document')[$file][2];
                                $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                if ($saveintable->validate()) {
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            //Запись новых данных
                            $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                            $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                            $position = $tabel_filds->fieldform . $count_upload_doc;
                            $saveintable = new Dataforms();
                            $saveintable->titel = $request->post('document')[$file][2];
                            $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                            $saveintable->position = $position;
                            if ($saveintable->validate()) {
                                $tabel_filds->count_upload_doc = $count_upload_doc;
                                $tabel_filds->save();
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    }
                    //Проверка была ли допущена,где-то ошибка при добавлении данных
                    if ($p == 1) {
                        //Проверка, что  запись старая
                        if ($request->post('document')[$file][0] != '0') {
                            $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                            $wrong[] = [
                                'titel' => $request->post('document')[$file][2],
                                'fieldsforms_id' => $request->post('document')[$file][1],
                                'position' => $request->post('document')[$file][0],
                                'data' => $saveintable->data
                            ];
                        } else {
                            $wrong[] = [
                                'titel' => $request->post('document')[$file][2],
                                'fieldsforms_id' => $request->post('document')[$file][1],
                                'position' => '0',
                                'data' => ''
                            ];
                        }
                        //Создание в сесси переменной wrong_data, куда передается массив wrong с ошибками
                        Yii::$app->session->set('wrong_data', $wrong);
                        Yii::$app->session->setFlash('error', 'Проверьте правильность введенных данных.');
                    }
                }
            }
            return $this->redirect('common');
        }
        return $this->render('common', ['datarows' => $datarows, 'tabledata' => $datadoc]);
    }
    public function actionEdustandarts()
    {
        $takedata = new Dataforms();
        $data = $takedata::find()
            ->joinWith('fieldsforms')
            ->andWhere(['fieldsforms.nameform' => 'edustandarts'])
            ->all();
        $request = Yii::$app->request;
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
        if (isset($_FILES['document']) && $request->post('document')) {
            foreach ($_FILES['document']['name'] as $file => $name) {
                $link = '';
                $p = 0;
                $position = '';
                //Проверка на наличие файла
                if ($name != '') {
                    $testMimeType = FileHelper::getMimeTypeByExtension($name);
                    //Проверка на расширение файла
                    if (in_array($testMimeType, $acTypesFileForUploading)) {
                        //Проверка, что запись старая
                        if ($request->post('document')[$file][0] != '0') {
                            //Поиск записи и её перезапись
                            $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                            if (!empty($saveintable)) {
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
                                $position = $saveintable['position'];
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
                                $saveintable->titel = $request->post('document')[$file][2];
                                $saveintable->data = $link;
                                $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                if ($saveintable->validate()) {
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            //Новая запись в бд
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
                            $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                            $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                            $position = $tabel_filds->fieldform . $count_upload_doc;
                            $testMimeType = FileHelper::getMimeTypeByExtension($name);
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
                            $saveintable = new Dataforms();
                            $saveintable->titel = $request->post('document')[$file][2];
                            $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                            $saveintable->data = $link;
                            $saveintable->position = $position;
                            if ($saveintable->validate()) {
                                $tabel_filds->count_upload_doc = $count_upload_doc;
                                $tabel_filds->save();
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    } else {
                        $p = 1;
                    }
                } else {
                    //Запись в бд при отсутствии файла
                    //Проверка,что запись старая
                    if ($request->post('document')[$file][0] != '0') {
                        $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                        //Поиск записи и её перезапись
                        if (!empty($saveintable) && $saveintable['titel'] != $request->post('document')[$file][2]) {
                            $saveintable->titel = $request->post('document')[$file][2];
                            $saveintable->updated_at = new \yii\db\Expression('NOW()');
                            if ($saveintable->validate()) {
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    } else {
                        //Запись новых данных
                        $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                        $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                        $position = $tabel_filds->fieldform . $count_upload_doc;
                        $saveintable = new Dataforms();
                        $saveintable->titel = $request->post('document')[$file][2];
                        $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                        $saveintable->position = $position;
                        if ($saveintable->validate()) {
                            $tabel_filds->count_upload_doc = $count_upload_doc;
                            $tabel_filds->save();
                            $saveintable->save();
                        } else {
                            $p = 1;
                        }
                    }
                }
                //Проверка была ли допущена,где-то ошибка при добавлении данных
                if ($p == 1) {
                    //Проверка, что  запись старая
                    if ($request->post('document')[$file][0] != '0') {
                        $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                        $wrong[] = [
                            'titel' => $request->post('document')[$file][2],
                            'fieldsforms_id' => $request->post('document')[$file][1],
                            'position' => $request->post('document')[$file][0],
                            'data' => $saveintable->data
                        ];
                    } else {
                        $wrong[] = [
                            'titel' => $request->post('document')[$file][2],
                            'fieldsforms_id' => $request->post('document')[$file][1],
                            'position' => '0',
                            'data' => ''
                        ];
                    }
                    //Создание в сесси переменной wrong_data, куда передается массив wrong с ошибками
                    Yii::$app->session->set('wrong_data', $wrong);
                    Yii::$app->session->setFlash('error', 'Проверьте правильность введенных данных.');
                }
            }
            return $this->redirect('');
        }
        return $this->render('eduStandarts', ['tabledata' => $data]);
    }
    public function actionInter()
    {
        $tabledata = new Dataforms();
        $request = Yii::$app->request;
        if ($request->post("inter")) {
            foreach ($request->post("inter") as $inter) {
                if ($inter[0][0] != 0) {
                    $data = $tabledata::findOne($inter[0][0]);
                    if ($inter[0][2] != $data["titel"] or $inter[0][3] != $data["data"]) {
                        $data->titel = $inter[0][2];
                        $data->data = $inter[0][3];
                        $data->updated_at = new \yii\db\Expression('NOW()');
                        $data->save();
                    }
                    if (!empty($inter[1])) {
                        foreach ($inter[1] as $number => $inter_dop) {
                            $extrafields = new ExtraFields();
                            $dop = $extrafields::find()->where(["dataforms_id" => $inter[0][0]])->all();
                            if (!empty($dop)) {
                                if (!empty($dop[$number]["data"])) {
                                    if ($dop[$number]["data"] != $inter_dop) {
                                        $change = $extrafields::findOne(["data" => $dop[$number]["data"]]);
                                        $change->data = $inter_dop;
                                        $change->save();
                                        $change = Dataforms::findOne($inter[0][0]);
                                        $change->updated_at = new \yii\db\Expression('NOW()');
                                    }
                                } else {
                                    $extrafields = new ExtraFields();
                                    $extrafields->dataforms_id = $inter[0][0];
                                    $extrafields->type = "document";
                                    $extrafields->data = $inter_dop;
                                    $extrafields->save();
                                    $change = Dataforms::findOne($inter[0][0]);
                                    $change->updated_at = new \yii\db\Expression('NOW()');
                                }
                            } else {
                                $extrafields = new ExtraFields();
                                $extrafields->dataforms_id = $inter[0][0];
                                $extrafields->type = "document";
                                $extrafields->data = $inter_dop;
                                $extrafields->save();
                                $change = Dataforms::findOne($inter[0][0]);
                                $change->updated_at = new \yii\db\Expression('NOW()');
                            }
                        }
                    }
                } else {
                    $dataforms = new Dataforms();
                    $dataforms->fieldsforms_id = $inter[0][1];
                    $dataforms->titel = $inter[0][2];
                    $dataforms->data = $inter[0][3];
                    $dataforms->save();
                    if (!empty($inter[1])) {
                        $idDataformsforExtraFields = Yii::$app->db->getLastInsertID();
                        foreach ($inter[1] as $inter_dop) {
                            $extrafields = new ExtraFields();
                            $extrafields->dataforms_id = $idDataformsforExtraFields;
                            $extrafields->type = "document";
                            $extrafields->data = $inter_dop;
                            $extrafields->save();
                        }
                    }
                }
            }
            return $this->redirect('');
        }
        $data = $tabledata::find()
            ->joinWith('fieldsforms')
            ->andWhere(['fieldsforms.nameform' => 'inter'])
            ->joinWith('extraFields')
            ->all();
        return $this->render('inter', ["data" => $data]);
    }
    public function actionGrants()
    {
        $request = Yii::$app->request;
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
        if ($request->post()) {
            if ($request->post("grants")) {
                foreach ($request->post("grants") as $grants) {
                    if ($grants[0] != "0") {
                        $saveintable = Dataforms::findOne($grants[0]);
                        if ($grants[3] != $saveintable->data) {
                            $saveintable->data = $grants[3];
                            $saveintable->updated_at = new \yii\db\Expression('NOW()');
                            $saveintable->save();
                        }
                    } else {
                        $saveintable = new Dataforms();
                        $saveintable->fieldsforms_id = $grants[1];
                        $saveintable->titel = $grants[2];
                        $saveintable->data = $grants[3];
                        $saveintable->save();
                    }
                }
            }
            if (isset($_FILES['document']) && $request->post('document')) {
                foreach ($_FILES['document']['name'] as $file => $name) {
                    $link = '';
                    $p = 0;
                    $position = '';
                    //Проверка на наличие файла
                    if ($name != '') {
                        $testMimeType = FileHelper::getMimeTypeByExtension($name);
                        //Проверка на расширение файла
                        if (in_array($testMimeType, $acTypesFileForUploading)) {
                            //Проверка, что запись старая
                            if ($request->post('document')[$file][0] != '0') {
                                //Поиск записи и её перезапись
                                $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                                if (!empty($saveintable)) {
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
                                    $position = $saveintable['position'];
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
                                    $saveintable->titel = $request->post('document')[$file][2];
                                    $saveintable->data = $link;
                                    $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                    if ($saveintable->validate()) {
                                        $saveintable->save();
                                    } else {
                                        $p = 1;
                                    }
                                }
                            } else {
                                //Новая запись в бд
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
                                $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                                $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                                $position = $tabel_filds->fieldform . $count_upload_doc;
                                $testMimeType = FileHelper::getMimeTypeByExtension($name);
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
                                $saveintable = new Dataforms();
                                $saveintable->titel = $request->post('document')[$file][2];
                                $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                                $saveintable->data = $link;
                                $saveintable->position = $position;
                                if ($saveintable->validate()) {
                                    $tabel_filds->count_upload_doc = $count_upload_doc;
                                    $tabel_filds->save();
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            $p = 1;
                        }
                    } else {
                        //Запись в бд при отсутствии файла
                        //Проверка,что запись старая
                        if ($request->post('document')[$file][0] != '0') {
                            $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                            //Поиск записи и её перезапись
                            if (!empty($saveintable) && $saveintable['titel'] != $request->post('document')[$file][2]) {
                                $saveintable->titel = $request->post('document')[$file][2];
                                $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                if ($saveintable->validate()) {
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            //Запись новых данных
                            $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                            $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                            $position = $tabel_filds->fieldform . $count_upload_doc;
                            $saveintable = new Dataforms();
                            $saveintable->titel = $request->post('document')[$file][2];
                            $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                            $saveintable->position = $position;
                            if ($saveintable->validate()) {
                                $tabel_filds->count_upload_doc = $count_upload_doc;
                                $tabel_filds->save();
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    }
                    //Проверка была ли допущена,где-то ошибка при добавлении данных
                    if ($p == 1) {
                        //Проверка, что  запись старая
                        if ($request->post('document')[$file][0] != '0') {
                            $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                            $wrong[] = [
                                'titel' => $request->post('document')[$file][2],
                                'fieldsforms_id' => $request->post('document')[$file][1],
                                'position' => $request->post('document')[$file][0],
                                'data' => $saveintable->data
                            ];
                        } else {
                            $wrong[] = [
                                'titel' => $request->post('document')[$file][2],
                                'fieldsforms_id' => $request->post('document')[$file][1],
                                'position' => '0',
                                'data' => ''
                            ];
                        }
                        //Создание в сесси переменной wrong_data, куда передается массив wrong с ошибками
                        Yii::$app->session->set('wrong_data', $wrong);
                        Yii::$app->session->setFlash('error', 'Проверьте правильность введенных данных.');
                    }
                }
            }
            return $this->redirect('');
        }
        $singledata = Dataforms::find()
            ->joinWith('fieldsforms')
            ->andWhere(['and', ['fieldsforms.nameform' => 'grants'], ['=', 'fieldsforms.count_upload_doc', 0]])
            ->all();
        $savefilestable = Dataforms::find()
            ->joinWith('fieldsforms')
            ->andWhere(['and', ['fieldsforms.nameform' => 'grants'], ['>', 'fieldsforms.count_upload_doc', 0]])
            ->all();
        $position_wrong[] = '';
        if (Yii::$app->session->has('wrong_data')) {
            $position_wrong[] = '0';
            $wrong_data = Yii::$app->session->get('wrong_data');
            //Если переменная wrong_data есть, сравнимаем полученные данные из таблицы 
            //и либо заменяем их, либо добавляем новые в массив data
            foreach ($wrong_data as $wr) {
                if ($wr["position"] != '0') {
                    foreach ($savefilestable as $tabledata) {
                        if ($wr["position"] == $tabledata["position"]) {
                            $tabledata["titel"] = $wr["titel"];
                            $position_wrong[] = $wr["position"];
                            break;
                        }
                    }
                } else {
                    $savefilestable[] = $wr;
                }
            }
            Yii::$app->session->remove('wrong_data');
        }
        return $this->render("grants", ['tabledata' => $savefilestable, 'singledata' => $singledata]);
    }
    public function actionBudget()
    {
        $request = Yii::$app->request;
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
        if ($request->post()) {
            if ($request->post("budget")) {
                foreach ($request->post("budget") as $budget) {
                    if ($budget[0] != "0") {
                        $saveintable = Dataforms::findOne($budget[0]);
                        if ($budget[3] != $saveintable->data) {
                            $saveintable->data = $budget[3];
                            $saveintable->updated_at = new \yii\db\Expression('NOW()');
                            $saveintable->save();
                        }
                    } else {
                        $saveintable = new Dataforms();
                        $saveintable->fieldsforms_id = $budget[1];
                        $saveintable->titel = $budget[2];
                        $saveintable->data = $budget[3];
                        $saveintable->save();
                    }
                }
            }
            if ($request->post('report')) {
                foreach ($request->post('report') as $report) {
                    if ($report[0] != 0) {
                        $change_true = false;
                        $dataforms = Dataforms::findOne($report[0]);
                        if ($report[2] != $dataforms->data) {
                            $dataforms->data = $report[2];
                            $dataforms->save();
                            $change_true = true;
                        }
                        if (!empty($report[3]) && !empty($report[4])) {
                            $extraFields = ExtraFields::findOne($report[3]);
                            if (!empty($extraFields)) {
                                if ($extraFields["data"] != $report[4]) {
                                    $chagedata = ExtraFields::findOne($extraFields["id"]);
                                    $chagedata->data = $report[4];
                                    $chagedata->save();
                                    $change_true = true;
                                }
                            }
                        }
                        if (!empty($report[5]) && !empty($report[6])) {
                            $extraFields = ExtraFields::findOne($report[5]);
                            if (!empty($extraFields)) {
                                if ($extraFields["data"] != $report[6]) {
                                    $chagedata = ExtraFields::findOne($extraFields["id"]);
                                    $chagedata->data = $report[6];
                                    $chagedata->save();
                                    $change_true = true;
                                }
                            }
                        }
                        if ($change_true) {
                            $dataforms = Dataforms::findOne($report[0]);
                            $dataforms->updated_at = new \yii\db\Expression('NOW()');
                            $dataforms->save();
                        }
                    } else {
                        $dataforms = new Dataforms();
                        $dataforms->fieldsforms_id = 44;
                        $dataforms->titel = "Год отчетности";
                        $dataforms->data = $report[2];
                        $dataforms->save();
                        $idDataformsforExtraFields = Yii::$app->db->getLastInsertID();
                        if (!empty($report[4])) {
                            $extraFields = new ExtraFields();
                            $extraFields->type = 'income';
                            $extraFields->data = $report[4];
                            $extraFields->dataforms_id = $idDataformsforExtraFields;
                            $extraFields->fieldsforms_id = 47;
                            $extraFields->save();
                        }
                        if (!empty($report[6])) {
                            $extraFields = new ExtraFields();
                            $extraFields->type = 'expenditure';
                            $extraFields->data = $report[6];
                            $extraFields->dataforms_id = $idDataformsforExtraFields;
                            $extraFields->fieldsforms_id = 48;
                            $extraFields->save();
                        }
                    }
                }
            }
            //Сохранение url
            if ($request->post('paid_educational')) {
                foreach ($request->post('paid_educational') as $row) {
                    $p = 0;
                    if (!empty($row[3]) && ((new UrlValidator())->validate($row[3]))) {
                        if ($row[0] != '0') {
                            $saveintable = Dataforms::findOne($row[0]);
                            if (!empty($saveintable) && ($row[3] != $saveintable['data'] || $row[2] != $saveintable['titel'])) {
                                $saveintable->titel = $row[2];
                                $saveintable->data = $row[3];
                                $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                if ($saveintable->validate()) {
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            $saveintable = new Dataforms();
                            $saveintable->fieldsforms_id = $row[1];
                            $saveintable->titel = $row[2];
                            $saveintable->data = $row[3];
                            if ($saveintable->validate()) {
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    } else {
                        $p = 1;
                    }
                    //ПРОВЕРИТЬ НА БАГИ, ТАК КАК ТАКОЙ ЖЕ МАССИВ И ДЛЯ ДОКУМЕНТОВ, но там еще добавляется в него position
                    // if ($p == 1) {
                    //     //Заполняем пустую link следующим текстом
                    //     if (empty($row[3])) {
                    //         $row[3] = "Введите данные";
                    //     }
                    //     // Проверка на то какая это запись, новая или старая
                    //     if ($row[0] == 0) {
                    //         $wrong[] = [
                    //             "titel" => $row[2],
                    //             "id" => 0,
                    //             "data" => $row[3],
                    //             "fieldsforms_id" => $row[1]
                    //         ];
                    //     } else {
                    //         $wrong[] = [
                    //             "titel" => $row[2],
                    //             "id" => $row[0],
                    //             "data" => $row[3],
                    //             "fieldsforms_id" => $row[1]
                    //         ];
                    //     }
                    //     // Создание переменной в сесси wrong_data, которая будет содержать ошибки допущенные пользователем
                    //     Yii::$app->session->set('wrong_data', $wrong);
                    //     Yii::$app->session->setFlash('error', 'Проверьте правильность введенных данных.');
                    // }
                }
            }
            if (isset($_FILES['document']) && $request->post('document')) {
                foreach ($_FILES['document']['name'] as $file => $name) {
                    $link = '';
                    $p = 0;
                    $position = '';
                    //Проверка на наличие файла
                    if ($name != '') {
                        $testMimeType = FileHelper::getMimeTypeByExtension($name);
                        //Проверка на расширение файла
                        if (in_array($testMimeType, $acTypesFileForUploading)) {
                            //Проверка, что запись старая
                            if ($request->post('document')[$file][0] != '0') {
                                //Поиск записи и её перезапись
                                $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                                if (!empty($saveintable)) {
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
                                    $position = $saveintable['position'];
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
                                    $saveintable->titel = $request->post('document')[$file][2];
                                    $saveintable->data = $link;
                                    $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                    if ($saveintable->validate()) {
                                        $saveintable->save();
                                    } else {
                                        $p = 1;
                                    }
                                }
                            } else {
                                //Новая запись в бд
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
                                $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                                $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                                $position = $tabel_filds->fieldform . $count_upload_doc;
                                $testMimeType = FileHelper::getMimeTypeByExtension($name);
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
                                $saveintable = new Dataforms();
                                $saveintable->titel = $request->post('document')[$file][2];
                                $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                                $saveintable->data = $link;
                                $saveintable->position = $position;
                                if ($saveintable->validate()) {
                                    $tabel_filds->count_upload_doc = $count_upload_doc;
                                    $tabel_filds->save();
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            $p = 1;
                        }
                    } else {
                        //Запись в бд при отсутствии файла
                        //Проверка,что запись старая
                        if ($request->post('document')[$file][0] != '0') {
                            $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                            //Поиск записи и её перезапись
                            if (!empty($saveintable) && $saveintable['titel'] != $request->post('document')[$file][2]) {
                                $saveintable->titel = $request->post('document')[$file][2];
                                $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                if ($saveintable->validate()) {
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            //Запись новых данных
                            $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                            $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                            $position = $tabel_filds->fieldform . $count_upload_doc;
                            $saveintable = new Dataforms();
                            $saveintable->titel = $request->post('document')[$file][2];
                            $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                            $saveintable->position = $position;
                            if ($saveintable->validate()) {
                                $tabel_filds->count_upload_doc = $count_upload_doc;
                                $tabel_filds->save();
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    }
                    //Проверка была ли допущена,где-то ошибка при добавлении данных
                    if ($p == 1) {
                        //Проверка, что  запись старая
                        if ($request->post('document')[$file][0] != '0') {
                            $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                            $wrong[] = [
                                'titel' => $request->post('document')[$file][2],
                                'fieldsforms_id' => $request->post('document')[$file][1],
                                'position' => $request->post('document')[$file][0],
                                'data' => $saveintable->data
                            ];
                        } else {
                            $wrong[] = [
                                'titel' => $request->post('document')[$file][2],
                                'fieldsforms_id' => $request->post('document')[$file][1],
                                'position' => '0',
                                'data' => ''
                            ];
                        }
                        //Создание в сесси переменной wrong_data, куда передается массив wrong с ошибками
                        Yii::$app->session->set('wrong_data', $wrong);
                        Yii::$app->session->setFlash('error', 'Проверьте правильность введенных данных.');
                    }
                }
            }
            return $this->redirect('');
        }
        //Ссылки и одиночные поля
        $singledata = Dataforms::find()
            ->joinWith('fieldsforms')
            ->andWhere(['and', ['fieldsforms.nameform' => 'budget'], ['=', 'fieldsforms.count_upload_doc', 0], ['not in', 'fieldsforms.id', [44, 47, 48]]])
            ->all();
        //Отчетность по доходам и расходам
        $report = Dataforms::find()
            ->joinWith('fieldsforms')
            ->andWhere(['and', ['fieldsforms.nameform' => 'budget'], ['=', 'fieldsforms.count_upload_doc', 0], ['not in', 'fieldsforms.id', [40, 41, 42, 43, 45, 46]]])
            ->all();
        //Файлы
        $tabledata = Dataforms::find()
            ->joinWith('fieldsforms')
            ->andWhere(['and', ['fieldsforms.nameform' => 'budget'], ['>', 'fieldsforms.count_upload_doc', 0]])
            ->all();
        return $this->render("budget", ["tabledata" => $tabledata, "singledata" => $singledata, "report" => $report]);
    }
    public function actionObjects()
    {
        $request = Yii::$app->request;
        if ($request->post()) {
            if ($request->post("tableobj")) {
                foreach ($request->post("tableobj") as $obj) {
                    if ($obj[0][0] != "0") {
                        for ($i = 2; $i <= count($obj[0]) - 2; $i += 2) {
                            $saveintable = ExtraFields::findOne($obj[0][$i]);
                            if ($saveintable->data != $obj[0][$i + 1]) {
                                $saveintable->data = $obj[0][$i + 1];
                                $saveintable->save();
                                $saveintable = Dataforms::findOne($obj[0][0]);
                                $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                $saveintable->save();
                            }
                        }
                    } else {
                        $saveintable = new Dataforms();
                        if ($obj[0][1] == "49") {
                            $saveintable->titel = "Сведения о библиотеке";
                            $saveintable->fieldsforms_id = $obj[0][1];
                            $saveintable->save();
                        } else {
                            $saveintable->titel = "Сведения об объекте спорта";
                            $saveintable->fieldsforms_id = $obj[0][1];
                            $saveintable->save();
                        }
                        $idDataformsforExtraFields = Yii::$app->db->getLastInsertID();
                        for ($i = 2; $i <= count($obj[0]) - 2; $i += 2) {
                            $type;
                            $saveintable = new ExtraFields();
                            $saveintable->dataforms_id = $idDataformsforExtraFields;
                            switch ($obj[0][$i]) {
                                case "51":
                                case "52":
                                    $type = "text";
                                    break;
                                case "53":
                                    $type = "float";
                                    break;
                                case "54":
                                case "55":
                                    $type = "int";
                                    break;
                            }
                            $saveintable->fieldsforms_id = $obj[0][$i];
                            $saveintable->data = $obj[0][$i + 1];
                            $saveintable->type = $type;
                            $saveintable->save();
                        }
                    }
                }
            }
            if ($request->post("budget")) {
                foreach ($request->post("budget") as $budget) {
                    if ($budget[0] != "0") {
                        $saveintable = Dataforms::findOne($budget[0]);
                        if ($budget[3] != $saveintable->data) {
                            $saveintable->data = $budget[3];
                            $saveintable->updated_at = new \yii\db\Expression('NOW()');
                            $saveintable->save();
                        }
                    } else {
                        $saveintable = new Dataforms();
                        $saveintable->fieldsforms_id = $budget[1];
                        $saveintable->titel = $budget[2];
                        $saveintable->data = $budget[3];
                        $saveintable->save();
                    }
                }
            }
            //Сохранение url
            if ($request->post('paid_educational')) {
                foreach ($request->post('paid_educational') as $row) {
                    $p = 0;
                    if (!empty($row[3]) && ((new UrlValidator())->validate($row[3]))) {
                        if ($row[0] != '0') {
                            $saveintable = Dataforms::findOne($row[0]);
                            if (!empty($saveintable) && ($row[3] != $saveintable['data'] || $row[2] != $saveintable['titel'])) {
                                $saveintable->titel = $row[2];
                                $saveintable->data = $row[3];
                                $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                if ($saveintable->validate()) {
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            $saveintable = new Dataforms();
                            $saveintable->fieldsforms_id = $row[1];
                            $saveintable->titel = $row[2];
                            $saveintable->data = $row[3];
                            if ($saveintable->validate()) {
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    } else {
                        $p = 1;
                    }
                    //ПРОВЕРИТЬ НА БАГИ, ТАК КАК ТАКОЙ ЖЕ МАССИВ И ДЛЯ ДОКУМЕНТОВ, но там еще добавляется в него position
                    // if ($p == 1) {
                    //     //Заполняем пустую link следующим текстом
                    //     if (empty($row[3])) {
                    //         $row[3] = "Введите данные";
                    //     }
                    //     // Проверка на то какая это запись, новая или старая
                    //     if ($row[0] == 0) {
                    //         $wrong[] = [
                    //             "titel" => $row[2],
                    //             "id" => 0,
                    //             "data" => $row[3],
                    //             "fieldsforms_id" => $row[1]
                    //         ];
                    //     } else {
                    //         $wrong[] = [
                    //             "titel" => $row[2],
                    //             "id" => $row[0],
                    //             "data" => $row[3],
                    //             "fieldsforms_id" => $row[1]
                    //         ];
                    //     }
                    //     // Создание переменной в сесси wrong_data, которая будет содержать ошибки допущенные пользователем
                    //     Yii::$app->session->set('wrong_data', $wrong);
                    //     Yii::$app->session->setFlash('error', 'Проверьте правильность введенных данных.');
                    // }
                }
            }
            return $this->redirect('');
        }
        $tables = Dataforms::find()
            ->joinWith('fieldsforms')
            ->andWhere(['and', ['fieldsforms.nameform' => 'objects'], ['or', ['fieldsforms.id' => "50"], ['fieldsforms.id' => "49"]]])
            ->joinWith('extraFields')
            ->all();
        //Ссылки и одиночные поля
        $singledata = Dataforms::find()
            ->joinWith('fieldsforms')
            ->andWhere(['and', ['fieldsforms.nameform' => 'objects'], ['not in', 'fieldsforms.id', [49, 50, 51, 52, 53, 54, 55]]])
            ->all();
        return $this->render("objects", ["singledata" => $singledata, "tables" => $tables]);
    }
    public function actionCatering()
    {
        $request = Yii::$app->request;
        if ($request->post("tableobj")) {
            foreach ($request->post("tableobj") as $obj) {
                if ($obj[0][0] != "0") {
                    for ($i = 2; $i <= count($obj[0]) - 2; $i += 2) {
                        $saveintable = ExtraFields::findOne($obj[0][$i]);
                        if ($saveintable->data != $obj[0][$i + 1]) {
                            $saveintable->data = $obj[0][$i + 1];
                            $saveintable->save();
                            $saveintable = Dataforms::findOne($obj[0][0]);
                            $saveintable->updated_at = new \yii\db\Expression('NOW()');
                            $saveintable->save();
                        }
                    }
                } else {
                    $saveintable = new Dataforms();
                    if ($obj[0][1] == "69") {
                        $saveintable->titel = "Сведения об условиях питания обучающихся";
                        $saveintable->fieldsforms_id = $obj[0][1];
                        $saveintable->save();
                    } else {
                        $saveintable->titel = "Сведения об условиях охраны здоровья обучающихся";
                        $saveintable->fieldsforms_id = $obj[0][1];
                        $saveintable->save();
                    }
                    $idDataformsforExtraFields = Yii::$app->db->getLastInsertID();
                    for ($i = 2; $i <= count($obj[0]) - 2; $i += 2) {
                        $type;
                        $saveintable = new ExtraFields();
                        $saveintable->dataforms_id = $idDataformsforExtraFields;
                        switch ($obj[0][$i]) {
                            case "51":
                            case "52":
                                $type = "text";
                                break;
                            case "53":
                                $type = "float";
                                break;
                            case "54":
                            case "55":
                                $type = "int";
                                break;
                        }
                        $saveintable->fieldsforms_id = $obj[0][$i];
                        $saveintable->data = $obj[0][$i + 1];
                        $saveintable->type = $type;
                        $saveintable->save();
                    }
                }
            }
            return $this->redirect('');
        }
        $tables = Dataforms::find()
            ->joinWith('fieldsforms')
            ->andWhere(['and', ['fieldsforms.nameform' => 'catering']])
            ->joinWith('extraFields')
            ->all();
        return $this->render("catering", ["tables" => $tables]);
    }
    public function actionEducation()
    {
        $request = Yii::$app->request;
        $takedata = new Dataforms();
        $data = $takedata::find()
            ->joinWith('fieldsforms')
            ->andWhere(['fieldsforms.nameform' => 'education'])
            ->all();
        if ($request->post()) {
            if ($request->post("tableobj")) {
                foreach ($request->post("tableobj") as $obj) {
                    if ($obj[0][0] != "0") {
                        for ($i = 2; $i <= count($obj[0]) - 2; $i += 2) {
                            $saveintable = ExtraFields::findOne($obj[0][$i]);
                            if ($saveintable->data != $obj[0][$i + 1]) {
                                $saveintable->data = $obj[0][$i + 1];
                                $saveintable->save();
                                $saveintable = Dataforms::findOne($obj[0][0]);
                                $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                $saveintable->save();
                            }
                        }
                    } else {
                        $saveintable = new Dataforms();
                        $saveintable->titel = "Информация о трудоустройстве выпускников для каждой реализуемой образовательной программы, по которой состоялся выпуск";
                        $saveintable->fieldsforms_id = $obj[0][1];
                        $saveintable->save();
                        $idDataformsforExtraFields = Yii::$app->db->getLastInsertID();
                        for ($i = 2; $i <= count($obj[0]) - 2; $i += 2) {
                            $type;
                            $saveintable = new ExtraFields();
                            $saveintable->dataforms_id = $idDataformsforExtraFields;
                            switch ($obj[0][$i]) {
                                case "76":
                                case "77":
                                case "78":
                                    $type = "text";
                                    break;
                                case "79":
                                case "80":
                                    $type = "int";
                                    break;
                            }
                            $saveintable->fieldsforms_id = $obj[0][$i];
                            $saveintable->data = $obj[0][$i + 1];
                            $saveintable->type = $type;
                            $saveintable->save();
                        }
                    }
                }
            }
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
            if (isset($_FILES['document']) && $request->post('document')) {
                foreach ($_FILES['document']['name'] as $file => $name) {
                    $link = '';
                    $p = 0;
                    $position = '';
                    //Проверка на наличие файла
                    if ($name != '') {
                        $testMimeType = FileHelper::getMimeTypeByExtension($name);
                        //Проверка на расширение файла
                        if (in_array($testMimeType, $acTypesFileForUploading)) {
                            //Проверка, что запись старая
                            if ($request->post('document')[$file][0] != '0') {
                                //Поиск записи и её перезапись
                                $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                                if (!empty($saveintable)) {
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
                                    $position = $saveintable['position'];
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
                                    $saveintable->titel = $request->post('document')[$file][2];
                                    $saveintable->data = $link;
                                    $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                    if ($saveintable->validate()) {
                                        $saveintable->save();
                                    } else {
                                        $p = 1;
                                    }
                                }
                            } else {
                                //Новая запись в бд
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
                                $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                                $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                                $position = $tabel_filds->fieldform . $count_upload_doc;
                                $testMimeType = FileHelper::getMimeTypeByExtension($name);
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
                                $saveintable = new Dataforms();
                                $saveintable->titel = $request->post('document')[$file][2];
                                $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                                $saveintable->data = $link;
                                $saveintable->position = $position;
                                if ($saveintable->validate()) {
                                    $tabel_filds->count_upload_doc = $count_upload_doc;
                                    $tabel_filds->save();
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            $p = 1;
                        }
                    } else {
                        //Запись в бд при отсутствии файла
                        //Проверка,что запись старая
                        if ($request->post('document')[$file][0] != '0') {
                            $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                            //Поиск записи и её перезапись
                            if (!empty($saveintable) && $saveintable['titel'] != $request->post('document')[$file][2]) {
                                $saveintable->titel = $request->post('document')[$file][2];
                                $saveintable->updated_at = new \yii\db\Expression('NOW()');
                                if ($saveintable->validate()) {
                                    $saveintable->save();
                                } else {
                                    $p = 1;
                                }
                            }
                        } else {
                            //Запись новых данных
                            $tabel_filds = Fieldsforms::findOne($request->post('document')[$file][1]);
                            $count_upload_doc = $tabel_filds->count_upload_doc + 1;
                            $position = $tabel_filds->fieldform . $count_upload_doc;
                            $saveintable = new Dataforms();
                            $saveintable->titel = $request->post('document')[$file][2];
                            $saveintable->fieldsforms_id = $request->post('document')[$file][1];
                            $saveintable->position = $position;
                            if ($saveintable->validate()) {
                                $tabel_filds->count_upload_doc = $count_upload_doc;
                                $tabel_filds->save();
                                $saveintable->save();
                            } else {
                                $p = 1;
                            }
                        }
                    }
                    //Проверка была ли допущена,где-то ошибка при добавлении данных
                    if ($p == 1) {
                        //Проверка, что  запись старая
                        if ($request->post('document')[$file][0] != '0') {
                            $saveintable = Dataforms::findOne(['position' => $request->post('document')[$file][0]]);
                            $wrong[] = [
                                'titel' => $request->post('document')[$file][2],
                                'fieldsforms_id' => $request->post('document')[$file][1],
                                'position' => $request->post('document')[$file][0],
                                'data' => $saveintable->data
                            ];
                        } else {
                            $wrong[] = [
                                'titel' => $request->post('document')[$file][2],
                                'fieldsforms_id' => $request->post('document')[$file][1],
                                'position' => '0',
                                'data' => ''
                            ];
                        }
                        //Создание в сесси переменной wrong_data, куда передается массив wrong с ошибками
                        Yii::$app->session->set('wrong_data', $wrong);
                        Yii::$app->session->setFlash('error', 'Проверьте правильность введенных данных.');
                    }
                }
            }
            return $this->redirect('');
        }
        $tables = Dataforms::find()
            ->joinWith('fieldsforms')
            ->andWhere(['between', 'fieldsforms.id', 75, 80])
            ->joinWith('extraFields')
            ->all();
        return $this->render("education", ['tabledata' => $data,'tables'=>$tables]);
    }

    //Дальше идут удаления
    public function actionDeleteform2($post, $what_to_delete)
    {
        if ($what_to_delete == 'row') {
            $delintable = new Dataforms();
            $deldata = $delintable::findOne(['id' => $post]);
            $deldata->delete();
            $delintable = new Dataforms();
            $deldata = $delintable::findOne(['id' => $post + 1]);
            $deldata->delete();
            $delintable = new Dataforms();
            $deldata = $delintable::findOne(['id' => $post + 2]);
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
        $deldata = $saveintable::findOne(['id' => $post]);
        $deldata->delete();
        $deldata = $saveintable::findOne(['id' => $post + 1]);
        $deldata->delete();
        return $this->redirect('form4');
    }
    public function actionDeletepaidedu()
    {
        $request = Yii::$app->request;
        $table = new Dataforms();
        $delintable = $table::find()
            ->joinWith('fieldsforms')
            ->andWhere(['fieldsforms.nameform' => 'paid_edu'])
            ->all();
        if ($request->post('paid_educational')) {
            $post_paid_educational = [];
            foreach ($request->post('paid_educational') as $postdata) {
                $post_paid_educational[] = $postdata[0];
            }
            foreach ($delintable as $deldata) {
                if (in_array($deldata['id'], $post_paid_educational)) {
                } else {
                    //Если enabled не существует то мы его удаляем, а если существует, скрываем элемент
                    if (!$request->post('enabled')) {
                        $del = $table::findOne($deldata['id']);
                        $del->delete();
                    } else {
                        $del = $table::findOne($deldata['id']);
                        $del->enabled = 0;
                        $del->updated_at = new \yii\db\Expression('NOW()');
                        $del->save();
                    }
                }
            }
        } else {
            $table = $table::find()
                ->joinWith('fieldsforms')
                ->andWhere(['and', ['fieldsforms.nameform' => 'paid_edu'], ['enabled' => 1]])
                ->one();
            if (!$request->post('enabled')) {
                $table->delete();
            } else {
                $table->enabled = 0;
                $table->updated_at = new \yii\db\Expression('NOW()');
                $table->save();
            }
        }
    }
    public function actionDeletegrants()
    {
        $request = Yii::$app->request;
        $table = new Dataforms();
        $delintable = $table::find()
            ->joinWith('fieldsforms')
            ->andWhere(['fieldsforms.nameform' => 'grants'])
            ->all();
        if ($request->post('paid_educational')) {
            $post_paid_educational = [];
            foreach ($request->post('paid_educational') as $postdata) {
                $post_paid_educational[] = $postdata[0];
            }
            foreach ($delintable as $deldata) {
                if (in_array($deldata['id'], $post_paid_educational)) {
                } else {
                    //Если enabled не существует то мы его удаляем, а если существует, скрываем элемент
                    if (!$request->post('enabled')) {
                        $del = $table::findOne($deldata['id']);
                        $del->delete();
                    } else {
                        $del = $table::findOne($deldata['id']);
                        $del->enabled = 0;
                        $del->updated_at = new \yii\db\Expression('NOW()');
                        $del->save();
                    }
                }
            }
        } else {
            $table = $table::find()
                ->joinWith('fieldsforms')
                ->andWhere(['and', ['fieldsforms.nameform' => 'grants'], ['enabled' => 1]])
                ->one();
            if (!$request->post('enabled')) {
                $table->delete();
            } else {
                $table->enabled = 0;
                $table->updated_at = new \yii\db\Expression('NOW()');
                $table->save();
            }
        }
    }
    public function actionDeletedocument()
    {
        $request = Yii::$app->request;
        $table = new Dataforms();
        if ($request->post('document')) {
            //создаем массив id из POST
            foreach ($request->post('document') as $postdata) {
                $post_document[] = $postdata[0];
            }
            if ($request->post('whatisurl')) {
                switch ($request->post('whatisurl')) {
                    //documetn
                    case "1":
                        $delintable = $table::find()
                            ->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'document'], ['enabled' => 1]])
                            ->all();
                        break;
                    //common
                    case "2":
                        $delintable = $table::find()->joinWith('fieldsforms')
                            ->andWhere(['fieldsforms.fieldform' => 'licence_to_carry_out_educational_activities'])
                            ->orWhere(['fieldsforms.fieldform' => 'state_accreditation_of_educational_activities_under_implemented_educational_programmes'])
                            ->andWhere(['enabled' => 1])
                            ->all();
                        break;
                    //edustandart
                    case "3":
                        $delintable = $table::find()->joinWith('fieldsforms')
                            ->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'edustandarts'], ['enabled' => 1]])
                            ->all();
                        break;
                    //paid_edu
                    case "4":
                        $delintable = $table::find()->joinWith('fieldsforms')
                            ->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'paid_edu'], ['enabled' => 1]])
                            ->all();
                        break;
                    //grants
                    case "5":
                        $delintable = $table::find()->joinWith('fieldsforms')
                            ->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'grants'], ['enabled' => 1], ['>', 'fieldsforms.count_upload_doc', 0]])
                            ->all();
                        break;
                    //budget
                    case "6":
                        $delintable = $table::find()->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'budget'], ['enabled' => 1], ['>', 'fieldsforms.count_upload_doc', 0]])
                            ->all();
                        break;
                    //education
                    case "7":
                        $delintable = $table::find()->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'education'], ['enabled' => 1]])
                            ->all();
                        break;
                }
            }
            foreach ($delintable as $deldata) {
                if (in_array($deldata['position'], $post_document)) {
                } else {
                    //Если enabled не существует то мы его удаляем, а если существует, скрываем элемент
                    if (!$request->post('enabled')) {
                        $link = $table::findOne(['position' => $deldata['position']]);
                        //Если ссылка пустая, то удаляем только из таблицы, если нет, то удаляем еще и файл
                        if ($link['data'] == '') {
                            $del = $table::findOne(['position' => $deldata['position']]);
                            $del->delete();
                        } else {
                            if (!$request->post('enabled')) {
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
                                    'Key' => $deldata['position'],
                                ]);
                                $del = $table::findOne(['position' => $deldata['position']]);
                                $del->delete();
                            } else {
                                $del = $table::findOne(['position' => $deldata['position']]);
                                $del->enabled = 0;
                                $del->save();
                            }
                        }
                    } else {
                        $del = $table::findOne(['position' => $deldata['position']]);
                        $del->enabled = 0;
                        $del->updated_at = new \yii\db\Expression('NOW()');
                        $del->save();
                    }
                }
            }
        } else {
            if ($request->post('whatisurl')) {
                switch ($request->post('whatisurl')) {
                    //documetn
                    case "1":
                        $table = $table::find()
                            ->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'document'], ['enabled' => 1]])
                            ->one();
                        break;
                    //common
                    case "2":
                        $table = $table::find()->joinWith('fieldsforms')
                            ->andWhere(['or', ['fieldsforms.fieldform' => 'licence_to_carry_out_educational_activities'], ['fieldsforms.fieldform' => 'state_accreditation_of_educational_activities_under_implemented_educational_programmes']])
                            ->andWhere(['enabled' => 1])
                            ->one();
                        break;
                    //edustandart
                    case "3":
                        $table = $table::find()->joinWith('fieldsforms')
                            ->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'edustandarts'], ['enabled' => 1]])
                            ->one();
                        break;
                    //paid_edu
                    case "4":
                        $table = $table::find()->joinWith('fieldsforms')
                            ->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'paid_edu'], ['enabled' => 1]])
                            ->one();
                        break;
                    //grants
                    case "5":
                        $table = $table::find()->joinWith('fieldsforms')
                            ->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'grants'], ['>', 'fieldsforms.count_upload_doc', 0], ['enabled' => 1]])
                            ->one();
                        break;
                    //budget
                    case "6":
                        $table = $table::find()->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'budget'], ['>', 'fieldsforms.count_upload_doc', 0], ['enabled' => 1]])
                            ->one();
                        break;
                    //education
                    case "7":
                        $table = $table::find()->joinWith('fieldsforms')
                            ->andWhere(['and', ['fieldsforms.nameform' => 'education'], ['enabled' => 1]])
                            ->one();
                        break;
                }
            }
            if (!$request->post('enabled')) {
                //Если сслыка для файла пустая, удаляем только запись, если нет то и сам файл
                if ($table['data'] == '') {
                    $table->delete();
                } else {
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
                        'Key' => $table['position'],
                    ]);
                    $table->delete();
                }
            } else {
                $table->enabled = 0;
                $table->updated_at = new \yii\db\Expression('NOW()');
                $table->save();
            }
        }
    }
    public function actionDeleteinter()
    {
        $request = Yii::$app->request;
        if ($request->post("id") && !$request->post("name")) {
            $dataforms = new Dataforms();
            $del = $dataforms::findOne($request->post("id"));
            $del->delete();
        }
        if ($request->post("name")) {
            $extrafields = new ExtraFields();
            $del = $extrafields::findOne($request->post("id"));
            $del->delete();
        }
    }
    public function actionDeletebudget()
    {
        $request = Yii::$app->request;
        $table = new Dataforms();
        $delintable = $table::find()
            ->joinWith('fieldsforms')
            ->andWhere(['and', ['fieldsforms.nameform' => 'budget'], ['=', 'fieldsforms.count_upload_doc', 0], ['enabled' => 1], ['fieldsforms.id' => 46]])
            ->all();
        if ($request->post('paid_educational')) {
            $post_paid_educational = [];
            foreach ($request->post('paid_educational') as $postdata) {
                $post_paid_educational[] = $postdata[0];
            }
            foreach ($delintable as $deldata) {
                if (in_array($deldata['id'], $post_paid_educational)) {
                } else {
                    //Если enabled не существует то мы его удаляем, а если существует, скрываем элемент
                    if (!$request->post('enabled')) {
                        $del = $table::findOne($deldata['id']);
                        $del->delete();
                    } else {
                        $del = $table::findOne($deldata['id']);
                        $del->enabled = 0;
                        $del->updated_at = new \yii\db\Expression('NOW()');
                        $del->save();
                    }
                }
            }
        } else {
            $table = $table::find()
                ->joinWith('fieldsforms')
                ->andWhere(['and', ['fieldsforms.nameform' => 'budget'], ['=', 'fieldsforms.count_upload_doc', 0], ['enabled' => 1], ['fieldsforms.id' => 46]])
                ->one();
            if (!$request->post('enabled')) {
                $table->delete();
            } else {
                $table->enabled = 0;
                $table->updated_at = new \yii\db\Expression('NOW()');
                $table->save();
            }
        }
    }
    public function actionDeleteobjects()
    {
        $request = Yii::$app->request;
        $table = new Dataforms();
        $delintable = $table::find()
            ->joinWith('fieldsforms')
            ->andWhere(['and', ['enabled' => 1], ['or', ['fieldsforms.id' => 65], ['fieldsforms.id' => 66]]])
            ->all();
        if ($request->post('paid_educational')) {
            $post_paid_educational = [];
            foreach ($request->post('paid_educational') as $postdata) {
                $post_paid_educational[] = $postdata[0];
            }
            foreach ($delintable as $deldata) {
                if (in_array($deldata['id'], $post_paid_educational)) {
                } else {
                    //Если enabled не существует то мы его удаляем, а если существует, скрываем элемент
                    if (!$request->post('enabled')) {
                        $del = $table::findOne($deldata['id']);
                        $del->delete();
                    } else {
                        $del = $table::findOne($deldata['id']);
                        $del->enabled = 0;
                        $del->updated_at = new \yii\db\Expression('NOW()');
                        $del->save();
                    }
                }
            }
        } else {
            $table = $table::find()
                ->joinWith('fieldsforms')
                ->andWhere(['and', ['enabled' => 1], ['or', ['fieldsforms.id' => 65], ['fieldsforms.id' => 66]]])
                ->one();
            if (!$request->post('enabled')) {
                $table->delete();
            } else {
                $table->enabled = 0;
                $table->updated_at = new \yii\db\Expression('NOW()');
                $table->save();
            }
        }
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
