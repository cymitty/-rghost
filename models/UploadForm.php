<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
  /**
   * @var UploadedFile
   */
  public $file;


  public function attributeLabels()
  {
    return [
        'file' => 'Файл'
    ];
  }

  public function rules()
  {
    return [
        [['file'], 'file', 'skipOnEmpty' => false, 'maxSize' => 1024 * 1024 * 10, 'tooBig' => 'Файл не должен превышать 10МБ',] //'extensions' => 'png, jpg',
    ];
  }

  /**
   * @return  path+name uploaded file or false
   */
  public function upload()
  {
    if ($this->validate()) {
      $today = date("Y-m-d_H-i-s");// для уникальности имени файла
      $filePath = '../files/' . $this->file->baseName . $today . '.' . $this->file->extension;
      $this->file->saveAs($filePath);
      return $filePath;
    } else {
      return false;
    }
  }
}