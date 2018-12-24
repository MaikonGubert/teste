<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PerguntaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pergunta Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pergunta-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pergunta Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo',
            'pergunta:ntext',
            'datahora',
            'categoria_id',
            //'usuario_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
