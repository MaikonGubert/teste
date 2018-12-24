<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RespostaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resposta Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resposta-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Resposta Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'resposta:ntext',
            'datahora',
            'pergunta_id',
            'usuario_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
