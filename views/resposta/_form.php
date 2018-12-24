<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RespostaModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resposta-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'resposta')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancelar', Yii::$app->request->referrer ?: 'faq/index' ,['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
