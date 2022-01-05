<?php

namespace app\controllers;

use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FormRegister;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
  
     
     public function actionRegister()
     {
      //Creamos la instancia con el model de validación
      $model = new FormRegister;

        //$model = new Users;
       
      //Mostrará un mensaje en la vista cuando el usuario se haya registrado
      $msg = null;
       
      //Validación mediante ajax
      if ($model->load(\Yii::$app->request->post()) && \Yii::$app->request->isAjax)
            {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
       
      //Validación cuando el formulario es enviado vía post
      //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
      //También previene por si el usuario tiene desactivado javascript y la
      //validación mediante ajax no puede ser llevada a cabo
      if ($model->load(\Yii::$app->request->post()))
      {
       if($model->validate())
       {
        //Preparamos la consulta para guardar el usuario
        $table = new Users;
        $table->username = $model->username;
        $table->email = $model->email;


        //Encriptamos el password
        $table->password = crypt($model->password, \Yii::$app->params["salt"]);
        //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
        //clave será utilizada para activar el usuario
        $table->authKey = $this->randKey("abcdef0123456789", 200);
        //Creamos un token de acceso único para el usuario
        $table->accessToken = $this->randKey("abcdef0123456789", 200);

        $table->NOMBRE = $model->NOMBRE;
        $table->AP_PATERNO = $model->AP_PATERNO;
        $table->AP_MATERNO = $model->AP_MATERNO;
        $table->RUT = $model->RUT;
         
        //Si el registro es guardado correctamente
        if ($table->insert())
        {
         //Nueva consulta para obtener el id del usuario
         //Para confirmar al usuario se requiere su id y su authKey
         $user = $table->find()->where(["email" => $model->email])->one();
         $id = urlencode($user->id);
         $authKey = urlencode($user->authKey);
          
         $subject = "Confirmar registro";
         $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
         $body .= "<a href='http://localhost:8080/entrega/web/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>";
          
         //Enviamos el correo
         \Yii::$app->mailer2->compose()
         ->setTo($user->email)
         ->setFrom([\Yii::$app->params["adminEmail"] => \Yii::$app->params["title"]])
         ->setSubject($subject)
         ->setHtmlBody($body)
         ->send();
         
         $model->username = null;
         $model->email = null;
         $model->password = null;
         $model->password_repeat = null;
         
         $msg = "Enhorabuena, ahora sólo falta que confirmes tu registro en tu cuenta de correo";
        }
        else
        {
         $msg = "Ha ocurrido un error al llevar a cabo tu registro";
        }
         
       }
       else
       {
        $model->getErrors();
       }
      }
      return $this->render("register", ["model" => $model, "msg" => $msg]);
     }
}
