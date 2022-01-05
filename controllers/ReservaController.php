<?php

namespace app\controllers;

use app\models\Reserva;
use app\models\ReservaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReservaController implements the CRUD actions for Reserva model.
 */
class ReservaController extends Controller
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
     * Lists all Reserva models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReservaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reserva model.
     * @param integer $ID_RESERVA
     * @param integer $ID_LABORATORIO
     * @param integer $ID_USUARIO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID_RESERVA, $ID_LABORATORIO, $ID_USUARIO)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID_RESERVA, $ID_LABORATORIO, $ID_USUARIO),
        ]);
    }

    /**
     * Creates a new Reserva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reserva();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                // return $this->redirect(['view', 'ID_RESERVA' => $model->ID_RESERVA, 'ID_LABORATORIO' => $model->ID_LABORATORIO, 'ID_USUARIO' => $model->ID_USUARIO]);

                return $this->redirect(['reserva/calendario']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Reserva model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $ID_RESERVA
     * @param integer $ID_LABORATORIO
     * @param integer $ID_USUARIO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID_RESERVA, $ID_LABORATORIO, $ID_USUARIO)
    {
        $model = $this->findModel($ID_RESERVA, $ID_LABORATORIO, $ID_USUARIO);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID_RESERVA' => $model->ID_RESERVA, 'ID_LABORATORIO' => $model->ID_LABORATORIO, 'ID_USUARIO' => $model->ID_USUARIO]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Reserva model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $ID_RESERVA
     * @param integer $ID_LABORATORIO
     * @param integer $ID_USUARIO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID_RESERVA, $ID_LABORATORIO, $ID_USUARIO)
    {
        $this->findModel($ID_RESERVA, $ID_LABORATORIO, $ID_USUARIO)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reserva model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $ID_RESERVA
     * @param integer $ID_LABORATORIO
     * @param integer $ID_USUARIO
     * @return Reserva the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID_RESERVA, $ID_LABORATORIO, $ID_USUARIO)
    {
        if (($model = Reserva::findOne(['ID_RESERVA' => $ID_RESERVA, 'ID_LABORATORIO' => $ID_LABORATORIO, 'ID_USUARIO' => $ID_USUARIO])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCalendario(){

        $reservas = Reserva::find()->all();

        $eventos = [];

        foreach ($reservas as $reserva) {

            $array_temp = [
                'id'               => $reserva->ID_RESERVA,
                'title'            => $reserva->uSUARIO->NOMBRE.': '.$reserva->OBSERVACION.','.$reserva->lABORATORIO->NOMBRE_LAB,

                'start'            => $reserva->FECHA,
                // 'end'              => '2021-12-17T19:30:00',
                'overlap'          => false, // Overlap is default true
                'editable'         => false,
                'startEditable'    => false,
                'durationEditable' => true,
            ];

            array_push($eventos, $array_temp);
        }


        return $this->render('calendario', [
            'eventos' => $eventos,
        ]);
    }
}