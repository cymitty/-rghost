<?php

/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\jui\Droppable;

$this->title = 'My Yii Application';
?>
<div class="site-index">
  <div class="row">
    <div class="col-md-6">
      <div class="jumbotron">
        <h1>Загрузить файл</h1>

        <p class="lead">Можете просто перетащить файл в окно браузера</p>

        <p>
          <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

          <?= $form->field($model, 'file')->fileInput() ?>
          <?= $form->field($model, 'comment')->textInput() ?>

          <button>Submit</button>

          <?php ActiveForm::end() ?>
        </p>
      </div>
    </div>
    <div class="col-md-6">
      <h2>Недавно загруженные файлы</h2>
      <?php Pjax::begin(); ?>
      <?= GridView::widget([
          'dataProvider' => $filesProvider,
          'columns' => [
              'id',
              [
                  'attribute' => 'Name',
                  'value' => function ($data) {
                    return Html::a(Html::encode($data->name), [ 's/file', 'id' => $data->id ]);
                  },
                  'format' => 'raw',
              ],
              [
                  'attribute' => 'Size',
                  'value' => function ($data) {
                    $meta = json_decode($data->meta, true);
                    return $meta['filesize'];
                  },
              ],
          ],

      ]) ?>
      <?php Pjax::end(); ?>

    </div>
  </div>
</div>