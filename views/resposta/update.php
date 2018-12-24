<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RespostaModel */

$this->title = 'Editando Resposta:';
$this->params['breadcrumbs'][] = ['label' => 'FAQ', 'url' => ['faq/index']];
$this->params['breadcrumbs'][] = ['label' => $model->pergunta->titulo, 'url' => ['pergunta/view', 'id' => $model->pergunta->id]];
?>
<div class="resposta-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
