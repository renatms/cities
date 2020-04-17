<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cities';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (empty($searchModel->name)): ?>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="//api-maps.yandex.ru/2.0-stable/?apikey=7885a3e6-21e5-4370-896a-21f85e233349&load=package.standard&lang=ru-RU"
                type="text/javascript"></script>
        <script type="text/javascript">
            window.onload = function () {
                jQuery("#user-city").text(ymaps.geolocation.city);
                //var y = jQuery().text(ymaps.geolocation.region);
                //var z = jQuery().text(ymaps.geolocation.country);
                var x = document.getElementById('user-city');
                //var y = document.getElementById('user-region');
                //var z = document.getElementById('user-country');
                var name = prompt("Это ваш город?", x.innerHTML);
                if (name !== null) location.href = "index.php?CitySearch%5Bname%5D=" + x.innerHTML;
            };
        </script>
    </head>

    <p hidden id="user-city"></p>

<?php endif; ?>

<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create City', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
