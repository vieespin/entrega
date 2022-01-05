<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Laboratorio */

$this->title = 'Update Laboratorio: ' . $model->ID_LABORATORIO;
$this->params['breadcrumbs'][] = ['label' => 'Laboratorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_LABORATORIO, 'url' => ['view', 'id' => $model->ID_LABORATORIO]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="laboratorio-Update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
