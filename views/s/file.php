<?php
$this->title = 'Скачать файл';

use yii\helpers\Url;
use yii\helpers\Html;
use yii\i18n\Formatter;

?>

<div class="site-index">

  <div>
    <?php if (isset($file)) : ?>
      <h1><?= Html::encode($file->name) ?></h1>
      <p class="lead">
        Размер: <?= Html::encode($fileInfo['filesize']) ?><br>
        Загружен: <?= Yii::$app->formatter->asDate($file->date) ?><br>
      <?php if (strpos($file->meta, 'image'))://Если картинка - показать превью ?>
        Уменьшенная копия:<br>
          <img src="/imagepreviews/<?= $fileInfo['filename'] ?>" alt="">
      <?php endif; ?>
      </p>
      <?php if (!empty($file->comment)): ?>
      <p>
        <strong>Комментарий автора:</strong><br>
        <?= Html::encode($file->comment) ?>
      </p>
      <?php endif; ?>
      <a class="lead" href="<?= $url = Url::toRoute(['s/download', 'name' => $fileInfo['filename']]); ?>">Скачать файл</a>
    <?php else : ?>
      <h1>Файла не существует, проверьте корректность ссылки</h1>
    <?php endif; ?>
    <p>
    </p>
  </div>