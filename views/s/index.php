<?php

/* @var $this yii\web\View */
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">

  <div class="jumbotron">
    <h1>Загрузить файл</h1>

    <p class="lead">Можете просто перетащить файл в окно браузера</p>

    <p>
      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

      <?= $form->field($model, 'file')->fileInput() ?>

      <button>Submit</button>

      <?php ActiveForm::end() ?>
    </p>
  </div>

<!--  <div class="body-content">-->
<!---->
<!--    <div class="row">-->
<!--      <div class="col-lg-4">-->
<!--        <h2>Heading</h2>-->
<!---->
<!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--          dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--          ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--          fugiat nulla pariatur.</p>-->
<!---->
<!--        <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
<!--      </div>-->
<!--      <div class="col-lg-4">-->
<!--        <h2>Heading</h2>-->
<!---->
<!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--          dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--          ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--          fugiat nulla pariatur.</p>-->
<!---->
<!--        <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>-->
<!--      </div>-->
<!--      <div class="col-lg-4">-->
<!--        <h2>Heading</h2>-->
<!---->
<!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--          dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--          ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--          fugiat nulla pariatur.</p>-->
<!---->
<!--        <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
<!--      </div>-->
<!--    </div>-->
<!---->
<!--  </div>-->
</div>