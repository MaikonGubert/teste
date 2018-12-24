<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PerguntaModel */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'FAQ', 'url' => ['faq/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<script>
    function salvarResposta() {
        $.ajax({
            url: '<?= Url::toRoute(['resposta/create', 'pergunta_id' => $model->id]) ?>',
            type: 'post',
            data: {
                resposta: $("#txtResposta").val().trim(),
            },
            success: function (data) {
                adicionaResposta(data[0]);
                $("#txtResposta").val('');
            },
            error: function (data) {
                alert(data.responseJSON);
            }
        });
    }

    function adicionaResposta(resp) {
        html = '<div class="col-lg-12">\n' +
            '                <div class="col-lg-1 padding-top-10">\n' +
            '                    <img class="avatar" src="https://lh3.googleusercontent.com/-T5ZQ5ydgwoc/AAAAAAAAAAI/AAAAAAAAAAA/Gq-SekxkaMo/s64-c/102621378331382322560.jpg">\n' +
            '                </div>\n' +
            '                <div class="col-lg-11 resposta-intro text-justify">\n' +
            '                    <div class="row">\n' +
            '                        <p>' + resp.resposta + '</p>\n' +
            '                    </div>\n' +
            '                    <div class="row">\n' +
            '                        <span>' + resp.datahora + '</span>\n' +
            '                        <a href="/resposta/update?id=' + resp.id + '">Editar</a>' +
            '                        <a href="/resposta/delete?id=' + resp.id + '" data-confirm="Deseja mesmo deletar este item?" data-method="post">Deletar</a>' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </div>';
        $('#divRespostasAjax').append(html);
    }
  
</script>
<div class="pergunta-model-view" xmlns="http://www.w3.org/1999/html">

    <div class="col-lg-12 pergunta-intro text-justify">
        <div class="row">
            <h2><?= $model->titulo ?></h2>
        </div>
        <div class="row">
            <p><?= $model->pergunta ?></p>
        </div>
        <div class="row">
            <span><?= Yii::$app->formatter->format($model->datahora, 'datetime'); ?></span>
            <?php if ((!Yii::$app->user->isGuest) && ($model->usuario_id == Yii::$app->user->identity->getId())): ?>
                <?= Html::a('Editar', ['update', 'id' => $model->id]) ?>
                <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
                    'data' => [
                        'confirm' => 'Deseja mesmo deletar este item?',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
        </div>
    </div>
    <div>
        <?php foreach ($model->respostas as $resp): ?>
            <div class="col-lg-12">
                <div class="col-lg-1 padding-top-10">
                    <img class="avatar"
                         src="https://lh3.googleusercontent.com/-T5ZQ5ydgwoc/AAAAAAAAAAI/AAAAAAAAAAA/Gq-SekxkaMo/s64-c/102621378331382322560.jpg">
                </div>
                <div class="col-lg-11 resposta-intro text-justify">
                    <div class="row">
                        <p><?= $resp->resposta ?></p>
                    </div>
                    <div class="row">
                        <span><?= Yii::$app->formatter->format($resp->datahora, 'datetime'); ?></span>
                        <?php if ((!Yii::$app->user->isGuest) && ($resp->usuario_id == Yii::$app->user->identity->getId())): ?>
                            <?= Html::a('Editar', ['resposta/update', 'id' => $resp->id]) ?>
                            <?= Html::a('Deletar', ['resposta/delete', 'id' => $resp->id], [
                                'data' => [
                                    'confirm' => 'Deseja mesmo deletar este item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div id="divRespostasAjax"></div>
    </div>
    <div class="col-lg-11 col-lg-offset-1 padding-top-10">
        <?php if (Yii::$app->user->isGuest): ?>
            <a href="<?= Url::toRoute(['site/login']) ?>">Faça o login para responder!</a>
        <?php else: ?>
            <textarea class="form-control" id="txtResposta"></textarea>
            <button class="btn btn-success" type="button" onclick="salvarResposta()"> Salvar Resposta AJAX</button>
            <a class="btn btn-info" href="<?= Url::toRoute(['resposta/create', 'pergunta_id' => $model->id]) ?>">Responder!</a>
        <?php endif; ?>
    </div>

</div>
