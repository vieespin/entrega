<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Users extends ActiveRecord{
    
    public static function getDb()
    {
        return Yii::$app->db;
    }
    
    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'authKey', 'accessToken', 'RUT', 'NOMBRE', 'AP_PATERNO'], 'required'],
            [['activate'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 80],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 250],
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
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'activate' => 'Activate',
            'RUT' => 'Rut',
            'NOMBRE' => 'Nombre',
            'AP_PATERNO' => 'Ap  Paterno',
            'AP_MATERNO' => 'Ap  Materno',
        ];
    }
        public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['USERS_ID' => 'id']);
    }

    public function email_existe($attribute, $params)
    {
  
      //Buscar el email en la tabla
      $table = Users::find()->where("email=:email", [":email" => $this->email]);
      
      //Si el email existe mostrar el error
      if ($table->count() == 1)
      {
                    $this->addError($attribute, "El email seleccionado existe");
      }
        }
     
        public function username_existe($attribute, $params)
        {
      //Buscar el username en la tabla
      $table = Users::find()->where("username=:username", [":username" => $this->username]);
      
      //Si el username existe mostrar el error
      if ($table->count() == 1)
      {
                    $this->addError($attribute, "El usuario seleccionado existe");
      }
        }
}
