<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Laboratorio;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Reserva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reserva-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'ID_LABORATORIO')->textInput() ?>
    <?=$form->field($model, 'ID_LABORATORIO')->dropDownList(ArrayHelper::map(Laboratorio::find()->all(), 'ID_LABORATORIO', 'NOMBRE_LAB')) ?>


    <?php //echo $form->field($model, 'ID_USUARIO')->textInput() ?>

    <?=$form->field($model, 'USERS_ID')->dropDownList(ArrayHelper::map(Users::find()->all(), 'id', function($model){
        return $model->NOMBRE.' '.$model->AP_PATERNO.' '.$model->AP_MATERNO;
    })) ?>

    <?= $form->field($model, 'FECHA')->textInput(['type'=>"datetime-local"]) ?>


    <?= $form->field($model, 'OBSERVACION')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
