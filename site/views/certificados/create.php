<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Certificados */

$this->title = 'Validação de certificados';
$this->params['breadcrumbs'][] = ['label' => 'Certificados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div align='center'><?php echo Html::img('@web/images/logo.jpeg',['width' => 200 ,'height' => 130]) ?></div>
<h1 align='center'>Informe a chave para pesquisa</h1>
<div class="certificados-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
