<?php
$this->title = 'Скачать файл';
use yii\helpers\Url;
?>

<div class="site-index">

  <div>
    <?php if (isset($file)) : ?>
      <h1><?= $file->name ?></h1>

      <p class="lead">
        Размер: <?= $fileInfo['filesize']; ?> <br>
        Формат: <?= $fileInfo['fileformat']; ?>
      </p>
    <a class="lead" href="<?= $url = Url::toRoute(['s/download', 'name' => $fileInfo['filename']]); ?>">Скачать файл</a>
    <?php else : ?>
      <h1>Файла не существует, проверьте корректность ссылки</h1>
    <?php endif; ?>
    <p>
    </p>
  </div>