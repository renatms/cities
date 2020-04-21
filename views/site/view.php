<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\City */
/* @var $comments app\models\Comment */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="city-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Post Comment', ['set-comment', 'id' => $model->id], ['class' => 'btn btn-default ']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            //'created_at',
        ],
    ]) ?>

</div>

<?php if (!empty($comments)): ?>

    <h4 class="label-info">comments</h4>
    <?php foreach ($comments as $comm): ?>

        <div class="media-list"><!--bottom comment-->

            <!--            <div class="comment-img">-->
            <!--                <img width="30" class="img-circle" src="-->
            <? //= $comment->user->image; ?><!--" alt="">-->
            <!--            </div>-->

            <div class="mar-btm">

                <h5 class="btn-link text-semibold media-heading box-inline"><?= $comm->user->username ?></h5>

                <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i>
                    <?= $comm->getDate(); ?>
                </p>

                <p><?= $comm->title; ?></p>
                <p><?= $comm->text; ?></p>

                <a class="btn btn-sm btn-default btn-hover-success" href="<?= Url::toRoute([
                    'site/view',
                    'id' => $model->id,
                    'user_like' =>$comm->user_id,
                    'comm_id' => $comm->id
                ]) ?>"><i class="fa fa-thumbs-up"></i><?= $comm->rating ?></a>
            </div>
            <br/>
        </div>
        <!-- end bottom comment-->

    <?php endforeach; ?>

<?php endif; ?>



<?php //if (!Yii::$app->user->isGuest): ?>
<!--    <h4 class="label-info">Добавить комментарий:</h4>-->
<!--    <div class="row">-->
<!--        <div class="col-sm-6 col-sm-offset-3">-->
<!---->
<!--            <form role="form" id="contactForm">-->
<!---->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="row">-->
<!--        <div class="form-group col-sm-6">-->
<!--            <p for="name" class="btn-link text-semibold media-heading box-inline">-->
<!--                <i> --><?//= Yii::$app->user->identity->username; ?><!--</i></p>-->
<!--            <p for="email" class="btn-link text-semibold media-heading box-inline">-->
<!--                <i> --><?//= Yii::$app->user->identity->email; ?><!--</i></p>-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-12">-->
<!--        --><?php //$form = \yii\widgets\ActiveForm::begin([
//            'action' => ['site/view', 'id' => $model->id],
//            'options' => ['class' => 'form-horizontal contact-form', 'role' => 'form']
//        ]) ?>
<!---->
<!--        <div class="panel">-->
<!--            <div class="panel-body">-->
<!--                --><?//= $form->field($comment, 'comment')->textarea([
//                    'class' => 'form-control',
//                    'placeholder' => 'Write message'
//                ])->label(false) ?>
<!--            </div>-->
<!--        </div>-->
<!--        <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-pencil fa-fw"></i>Post Comment-->
<!--        </button>-->
<!---->
<!--        --><?php //\yii\widgets\ActiveForm::end(); ?>
<!--    </div>-->
<?php //endif; ?>