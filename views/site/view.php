<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\City */

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




<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <h4>Отправить комментарий:</h4>
        <form role="form" id="contactForm">

        </form>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <label for="name" class="h4">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" required>
    </div>
    <div class="form-group col-sm-6">
        <label for="email" class="h4">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" required>
    </div>
</div>
<div class="form-group">
    <label for="message" class="h4 ">Message</label>
    <textarea id="message" class="form-control" rows="5" placeholder="Enter your message" required></textarea>
</div>
<button type="submit" id="form-submit" class="btnbtn-success btn-lg pull-right ">Submit</button>
<div id="msgSubmit" class="h3 text-center hidden">Message Submitted!</div>
