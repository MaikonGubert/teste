<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\CategoriaModel;

/* @var $this yii\web\View */
/* @var $model app\models\PerguntaModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pergunta-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pergunta')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'categoria_id')->dropDownList(
            ArrayHelper::map(CategoriaModel::find()->asArray()->all(), 'id', 'nome')
        )
    ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancelar', Yii::$app->request->referrer ?: 'faq/index' ,['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
