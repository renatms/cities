<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\City */
/* @var $comments app\models\Comment */
/* @var $comment app\models\CommentForm */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <div class="city-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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

    <h4>comments</h4>
    <?php foreach ($comments as $comm): ?>

        <div class="bottom-comment"><!--bottom comment-->

<!--            <div class="comment-img">-->
<!--                <img width="30" class="img-circle" src="--><?//= $comment->user->image; ?><!--" alt="">-->
<!--            </div>-->

            <div class="text-body">
                <a href="#" class="replay btn pull-right"> Replay</a>
                <h5 class="text-justify"><?= $comm->user->username ?></h5>

                <p class="comment-date">
                    <?= $comm->getDate(); ?>
                </p>

                <p class="para" style="border-bottom-style: solid"><?= $comm->text; ?></p>
            </div>
        </div>
        <!-- end bottom comment-->

    <?php endforeach; ?>

<?php endif; ?>



<?php if (!Yii::$app->user->isGuest): ?>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <h4>Отправить комментарий:</h4>
            <form role="form" id="contactForm">

            </form>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-6">
            <label for="name" class="h4">Имя: <?= Yii::$app->user->identity->username; ?></label>
            <!--            <input type="text" class="form-control" id="name" placeholder="Enter name" required>-->
        </div>
        <div class="form-group col-sm-6">
            <label for="email" class="h4">Эл.почта: <?= Yii::$app->user->identity->email; ?></label>
            <!--            <input type="email" class="form-control" id="email" placeholder="Enter email" required>-->
        </div>
    </div>
    <div class="form-group">
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action' => ['site/view', 'id' => $model->id], 'options' => ['class' => 'form-horizontal contact-form', 'role' => 'form']]) ?>

        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($comment, 'comment')->textarea(['class' => 'form-control', 'placeholder' => 'Write message'])->label(false) ?>
            </div>
        </div>
        <button type="submit" class="btnbtn-success btn-lg pull-right">Post Comment</button>

        <?php \yii\widgets\ActiveForm::end(); ?>
    </div>
<?php endif; ?>