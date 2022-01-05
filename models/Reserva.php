<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reserva".
 *
 * @property int $ID_RESERVA
 * @property int $ID_LABORATORIO
 * @property int $ID_USUARIO
 * @property string $FECHA
 * @property string|null $OBSERVACION
 *
 * @property Laboratorio $lABORATORIO
 * @property Usuario $uSUARIO
 */
class Reserva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_LABORATORIO', 'USERS_ID', 'FECHA'], 'required'],
            [['ID_LABORATORIO', 'USERS_ID'], 'integer'],
            [['FECHA'], 'safe'],
            //['FECHA', 'unique', 'message'=>'pero wn como se te ocurre'],
            [['OBSERVACION'], 'string', 'max' => 100],
            [['USERS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['USERS_ID' => 'id']],
            [['ID_LABORATORIO'], 'exist', 'skipOnError' => true, 'targetClass' => Laboratorio::className(), 'targetAttribute' => ['ID_LABORATORIO' => 'ID_LABORATORIO']],
            
            ['FECHA', 'validarHora'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_RESERVA' => 'Id  Reserva',
            'ID_LABORATORIO' => 'Id  Laboratorio',
            'USERS_ID' => 'Id  Usuario',
            'FECHA' => 'Fecha',
            'OBSERVACION' => 'Observacion',
        ];
    }
    public function validarHora($attribute,$params)
    {
        $result = Reserva::find()
            ->where(['FECHA'=>$this->FECHA])
            ->andWhere(['ID_LABORATORIO'=>$this->ID_LABORATORIO])
            ->exists(); //one() // all()

        if($result){

            $this->addError('FECHA', 'Este laboratorio ya se encuentra reservado para este horario.');


        }
    }

    /**
     * Gets query for [[LABORATORIO]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLABORATORIO()
    {
        return $this->hasOne(Laboratorio::className(), ['ID_LABORATORIO' => 'ID_LABORATORIO']);
    }

    /**
     * Gets query for [[USUARIO]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUSUARIO()
    {
        return $this->hasOne(Users::className(), ['id' => 'USERS_ID']);
    }
}
