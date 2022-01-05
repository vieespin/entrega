<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LaboratorioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laboratorios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratorio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Laboratorio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_LABORATORIO',
            'NOMBRE_LAB',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
