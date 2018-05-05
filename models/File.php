<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $name
 * @property string $meta
 */
class File extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'file';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
        [['name', 'meta'], 'required'],
        [['meta'], 'string'],
        [['name'], 'string', 'max' => 60],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
        'id' => 'ID',
        'name' => 'Name',
        'meta' => 'Meta',
    ];
  }

  /*
   * $file - Путь и название файла с расширением
   *
   */
  public function generateFileMeta($file)
  {
    if (!isset($getID3)) $getID3 = new \getID3;// Initialize getID3 core
    $ThisFileInfo = $getID3->analyze($file);
//    getid3_lib::CopyTagsToComments($ThisFileInfo);
    $fileMeta = [
        'filename'      => $ThisFileInfo['filename'],
        'filepath'      => $ThisFileInfo['filepath'],
        'filesize'      => $ThisFileInfo['filesize'],
        'filenamepath'  => $ThisFileInfo['filenamepath'],
        'fileformat'    => $ThisFileInfo['fileformat'],
        'mime_type'     => $ThisFileInfo['mime_type']
    ];
    $fileMeta = json_encode($fileMeta);
    return $fileMeta;
  }

}
