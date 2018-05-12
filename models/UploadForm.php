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
  public $comment;

  public function attributeLabels()
  {
    return [
        'file' => 'Файл',
        'comment' => 'Комментарий'
    ];
  }

  public function rules()
  {
    return [
        [['file'], 'required'],
        [['comment'], 'string', 'max' => 60],
        [['file'], 'file', 'skipOnEmpty' => false, 'maxSize' => 1024 * 1024 * 10, 'tooBig' => 'Файл не должен превышать 10МБ',], //'extensions' => 'png, jpg',
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

      if ( $this->file->extension == 'jpg' || $this->file->extension == 'png' || $this->file->extension == 'bmp')
      {
        // Файл картинка - создаём превью
        $imagick = new \Imagick(realpath($filePath));
//        var_dump($imagick);
//        die();
        $imagick->thumbnailImage(150, 0);
        file_put_contents('imagepreviews/' . $this->file->baseName . $today . '.' . $this->file->extension, $imagick);

      }
      return $filePath;
    } else {
      return false;
    }
  }
}