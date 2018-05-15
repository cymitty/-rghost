<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\File;
use yii\data\ActiveDataProvider;

class SController extends Controller
{
  public function actionIndex()
  {
    $model = new UploadForm();// Форма загрузки файла

    $query = File::find();
    $filesProvider = new ActiveDataProvider([
        'query' => $query,
        'totalCount' => 20,
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'defaultOrder' => [
                'id' => SORT_DESC,
            ]
        ],
    ]);

    if ( Yii::$app->request->isPost ) {
      $model->load(Yii::$app->request->post());
      $model->file = UploadedFile::getInstance($model, 'file');
      $transaction = Yii::$app->db->beginTransaction();
      if ($filePath = $model->upload()) {
        // file is uploaded successfully
        $newFile = new File();
        $newFile->name = $model->file->baseName . '.' . $model->file->extension;
        $fileMeta = $newFile->generateFileMeta($filePath);
        $newFile->meta = json_encode($fileMeta);;
        $newFile->size = $fileMeta['filesize'];
        $newFile->date = date("Y-m-d");
        $newFile->comment = $model->comment;
        $newFile->save();
        $transaction->commit();
        return Yii::$app->response->redirect(['s/file', 'id' => $newFile->id]);
      } else {
        // Файл не был загружен коректно
        $transaction->rollBack();
        return $this->render('index', [
            'model' => $model,
            'filesProvider' => $filesProvider,
        ]);
      }
    }
    return $this->render('index', [
        'model' => $model,
        'filesProvider' => $filesProvider,
    ]);
  }

  /*
   * Страница с информацией о файле и ссылкой на скачивание
   */
  public function actionFile($id = false)
  {

    $file = new File();
    $file = $file::find()->where(['id' => $id])->one();
    if (isset($file))
    {
      // Файл с $name имеется в дб

      $fileInfo = json_decode($file->meta, true);
      return $this->render('file', ['file' => $file, 'fileInfo' => $fileInfo ]);
    } else {
      // Если файла с таким $name нет
      return $this->render('file');
    }

  }

  public function actionDownload($name)
  {
//    $filePath = "C:\docs\projects\rghost\files" . "\\" . $name;

//    Yii::$app->getResponse()
//        ->getHeaders()
//        ->set('X-SendFile: ' . $filePath);
//    header('Content-Description: File Transfer');

//    header('Content-Transfer-Encoding: binary');
////    header('Expires: 0');
////    header('Cache-Control: no-store, no-cache, must-revalidate');
////    header('Pragma: no-cache');
//    header('Content-Length: ' . filesize($filePath));
    header("Content-Disposition: attachment; filename=" . $name);
    header('X-Sendfile: ' . $name);
//    die();
  }
}