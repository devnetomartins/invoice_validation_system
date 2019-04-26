<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;
use Yii;
use yii\web\ServerErrorHttpException;

/**
 * Default controller for the `api` module
 */
class DefaultController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $modelClass = 'app\models\Certificados';

    public function actions()
	{
	    $actions = parent::actions();
	    unset($actions['create']);
	    return $actions;
	}

    public function actionCreate()
    {
        
        $model = new $this->modelClass;

        $model->chave = Yii::$app->getRequest()->getBodyParams()['chave'];

        $model->pdf = Yii::$app->getRequest()->getBodyParams()['pdf'];

        if($model->chave != null && $model->pdf != null){

        	if($model->save()){
        		$response = Yii::$app->getResponse();
				$response->setStatusCode(201);
        	}else{
        		$response = Yii::$app->getResponse();
				$response->setStatusCode(400);
        	}

    		return $model->pdf;

        }

        
    }
}
