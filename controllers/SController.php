<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\File;

class SController extends Controller
{
  public function actionIndex()
  {
    $model = new UploadForm();

    if (Yii::$app->request->isPost) {
      $model->file = UploadedFile::getInstance($model, 'file');
      $transaction = Yii::$app->db->beginTransaction();
      if ($filePath = $model->upload()) {
        // file is uploaded successfully
        $newFile = new File();
        $newFile->name = $model->file->baseName . '.' . $model->file->extension;
        $newFile->meta = $newFile->generateFileMeta($filePath);
        $newFile->save();
        $transaction->commit();

        $fileInfo = json_decode($newFile->meta, true);
        return Yii::$app->response->redirect(['s/file', 'name' => $newFile->name]);
        //return $this->render('download/file', ['newFile' => $newFile, 'fileInfo' => $fileInfo]);
      } else {
        // file not uploaded correctly
        $transaction->rollBack();
        return $this->render('index', ['model' => $model]);
      }
    }
    return $this->render('index', ['model' => $model]);
  }

  /*
   * Страница с информацией о файле и ссылкой на скачивание
   */
  public function actionFile($name = false)
  {

    $model = new File();
    $file = $model::find()->where(['name' => $name])->one();
    if (isset($file))
    {
      // Такой файл существует
      $fileInfo = json_decode($file->meta, true);
      return $this->render('file', ['file' => $file, 'fileInfo' => $fileInfo]);
    } else {
      // Если файла с таким id нет
      return $this->render('file');
    }

  }

  public function actionDownload($name)
  {
    $filePath = 'C:\docs\projects\rghost\files\\' . $name;
//    Yii::$app->getResponse()
//        ->getHeaders()
//        ->set('X-SendFile: ' . $filePath);
    header('Content-Description: File Transfer');
    header("Content-Disposition: attachment; filename=\"". basename($filePath) . "\"");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('Content-Length: ' . filesize($filePath));
    header("X-Sendfile: $filePath");
//    die();
  }
}