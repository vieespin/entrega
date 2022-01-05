<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $ID_USUARIO
 * @property string $RUT
 * @property string $NOMBRE
 * @property string $AP_PATERNO
 * @property string|null $AP_MATERNO
 *
 * @property Reserva[] $reservas
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RUT', 'NOMBRE', 'AP_PATERNO'], 'required'],
            [['RUT'], 'string', 'max' => 15],
            [['NOMBRE', 'AP_PATERNO', 'AP_MATERNO'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_USUARIO' => 'Id  Usuario',
            'RUT' => 'Rut',
            'NOMBRE' => 'Nombre',
            'AP_PATERNO' => 'Ap  Paterno',
            'AP_MATERNO' => 'Ap  Materno',
        ];
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['ID_USUARIO' => 'ID_USUARIO']);
    }
}
