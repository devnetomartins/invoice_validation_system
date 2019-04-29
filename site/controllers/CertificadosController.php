<?php

namespace app\controllers;

use Yii;
use app\models\Certificados;
use app\models\CertificadosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CertificadosController implements the CRUD actions for Certificados model.
 */
class CertificadosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Creates a new Certificados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionConsulta()
    {
        $model = new Certificados();

        $request = Yii::$app->request;

        $chave = $request->get('chave'); 

        if($chave != null){
        $pdf = (new \yii\db\Query())
        ->select(['pdf'])
        ->from('certificados')
        ->where(['chave' => $chave])
        ->all();

            if($pdf != null){
                //chave existe no banco
                chdir('../backup/');

                $diretorio = getcwd() . $pdf[0]['pdf'];

                return Yii::$app->response->sendFile($diretorio, 'nota.pdf', ['inline'=>true]);

            }else{

                //Caso nao exista

                return $this->redirect(['consulta', 'error' => '1']);
            }
        }

        if ($model->load(Yii::$app->request->post())) {

            //Busca no banco

            $pdf = (new \yii\db\Query())
        ->select(['pdf'])
        ->from('certificados')
        ->where(['chave' => $model->chave])
        ->all();

            if($pdf != null){
                //chave existe no banco
                chdir('../backup/');

                $diretorio = getcwd() . $pdf[0]['pdf'];

                return Yii::$app->response->sendFile($diretorio, 'nota.pdf', ['inline'=>true]);

            }else{

                //Caso nao exista

                return $this->redirect(['consulta', 'error' => '1']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Certificados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Certificados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Certificados::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
