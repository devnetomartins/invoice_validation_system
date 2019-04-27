<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Certificados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="certificados-form">


    <?php $form = ActiveForm::begin(); 
    ?>

    <?= $form->field($model, 'chave')->textInput(['maxlength' => true]) ?>

    <div align='center' class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
