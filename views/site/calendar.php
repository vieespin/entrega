<?php

use yii\helpers\Html;
use yii\web\JsExpression;


?>
<p>
        <?= Html::a(Yii::t('app', 'Crear Reserva'), ['reserva/create'], ['class' => 'btn btn-success btn-lg']) ?>
</p>
<?= edofre\fullcalendar\Fullcalendar::widget([
        'options' =>[
                'id'=>'calendar',
                'language'=>'es',
        ],
        'clientOptions' => [
            'weekNumbers' => true,
            'selectable'  => true,
            //'defaultView' => 'agendaWeek',
            'eventResize' => new JsExpression("
                function(event, delta, revertFunc, jsEvent, ui, view) {
                    console.log('funciona');
                    console.log(event);
                    console.log(delta);
                }
            "),

        ],
        'events'        => $eventos
    ]);
?>


