<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<?php

/* @var $this yii\web\View */
/* @var $comment app\models\CommentForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Post comment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
</div>


<?php if (!Yii::$app->user->isGuest): ?>
    <h4 class="label-info">Добавить комментарий:</h4>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">

            <form role="form" id="contactForm">

            </form>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-6">
            <p for="name" class="btn-link text-semibold media-heading box-inline">
                <i> <?= Yii::$app->user->identity->username; ?></i></p>
            <p for="email" class="btn-link text-semibold media-heading box-inline">
                <i> <?= Yii::$app->user->identity->email; ?></i></p>

        </div>
    </div>
    <div class="col-md-12">

<!--        <div class="article-form">-->
<!---->
<!--            --><?php //$form = ActiveForm::begin(); ?>
<!---->
<!--            --><?//= $form->field($comment, 'image')->fileInput(['maxlength' => true]) ?>
<!---->
<!--            <div class="form-group">-->
<!--                --><?//= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
<!--            </div>-->
<!---->
<!--            --><?php //ActiveForm::end(); ?>
<!---->
<!--        </div>-->


        <?php $form = ActiveForm::begin() ?>

        <div class="panel">

            <div class="panel-body">

                <?= $form->field($comment, 'title')->textInput(
                    [
                        'class' => 'form-control',
                        'placeholder' => 'Write title'
                    ]
                )->label(false) ?>

                <?= $form->field($comment, 'comment')->textarea([
                    'class' => 'form-control',
                    'placeholder' => 'Write message'
                ])->label(false) ?>

                <?= $form->field($comment, 'image')->fileInput(['maxlength' => true]) ?>

                <?= Html::submitButton('Post Comment', ['class' => 'btn btn-sm btn-primary pull-right']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
<?php endif; ?>