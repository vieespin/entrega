<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reserva */

$this->title = 'Update Reserva: ' . $model->ID_RESERVA;
$this->params['breadcrumbs'][] = ['label' => 'Reservas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_RESERVA, 'url' => ['view', 'ID_RESERVA' => $model->ID_RESERVA, 'ID_LABORATORIO' => $model->ID_LABORATORIO, 'ID_USUARIO' => $model->ID_USUARIO]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reserva-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
