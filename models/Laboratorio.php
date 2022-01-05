<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "laboratorio".
 *
 * @property int $ID_LABORATORIO
 * @property string $NOMBRE_LAB
 *
 * @property Reserva[] $reservas
 */
class Laboratorio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'laboratorio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOMBRE_LAB'], 'required'],
            [['NOMBRE_LAB'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_LABORATORIO' => 'Id  Laboratorio',
            'NOMBRE_LAB' => 'Nombre  Lab',
        ];
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['ID_LABORATORIO' => 'ID_LABORATORIO']);
    }
}
