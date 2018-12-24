<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

$this->title = 'Desafio - FAQ';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Bem Vindo ao Desafio FAQ!</h1>
        <p class="lead">Como podemos lhe ajudar?</p>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <?= AutoComplete::widget([
                    'options' => [
                        'showAnim' => 'fold',
                        'class' => 'form-control input-lg',
                        'placeholder' => 'Digite palavras-chave para buscar'
                    ],
                    'clientOptions' => [
                        'source' => Url::toRoute(['pergunta/auto']),
                        'minLength' => '2',
                        'autoFill' => true,
                        'select' =>
                            new yii\web\JsExpression("function( event, ui) {
                                window.location.href = ui.item.rotaview;
                            }")
                    ],
                ]); ?>
            </div>
        </div>
        <div style="padding-top: 15px">
            <?php if (Yii::$app->user->isGuest): ?>
                <a href="<?= Url::toRoute(['site/login']) ?>">Faça o login para perguntar!</a>
            <?php else: ?>
                <a href="<?= Url::toRoute(['pergunta/create']) ?>">Faça já sua pergunta!</a>
            <?php endif; ?>
        </div>
    </div>
    <div>
        <div class="col-lg-3">
            <div class="list-group">
                <a href="<?= Url::toRoute(['faq/index']) ?>" class="list-group-item <?= $this->context->actionParams['categoria'] == null ? 'active' : ''?> "> Todas Categorias</a>
                <?php foreach ($categorias as $cat): ?>
                    <a href="<?= Url::toRoute(['faq/index', 'categoria' => $cat->id]) ?>"
                       class="list-group-item <?= $this->context->actionParams['categoria'] == $cat->id ? 'active' : ''?>"><?= Html::encode("{$cat->nome}") ?></a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="panel-group">
                <?php foreach ($ultperguntas as $indice => $p): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $indice ?>">
                                    <?= Html::encode("{$p->titulo}") ?></a>
                            </h4>
                        </div>
                        <div id="collapse<?= $indice ?>" class="panel-collapse collapse">
                            <div class="panel-body text-justify">
                                <?= Html::encode("{$p->pergunta}") ?>
                            </div>
                            <div style="padding-left: 15px">
                                <?php if ((!Yii::$app->user->isGuest) && ($p->usuario_id == Yii::$app->user->identity->getId())): ?>
                                    <?= Html::a('Editar', ['pergunta/update', 'id' => $p->id]) ?>
                                    <?= Html::a('Deletar', ['pergunta/delete', 'id' => $p->id], [
                                        'data' => [
                                            'confirm' => 'Deseja mesmo deletar este item?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                <?php endif; ?>
                                <a href="<?= Url::toRoute(['pergunta/view', 'id' => $p->id]) ?>"">Ver Respostas</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!--        <div class="row">-->
        <!---->
        <!--            <div class="col-lg-3">-->
        <!--                <h2>Heading</h2>-->
        <!---->
        <!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore-->
        <!--                    et-->
        <!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut-->
        <!--                    aliquip-->
        <!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum-->
        <!--                    dolore eu-->
        <!--                    fugiat nulla pariatur.</p>-->
        <!---->
        <!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
        <!--            </div>-->
        <!--            <div class="col-lg-3">-->
        <!--                <h2>Heading</h2>-->
        <!---->
        <!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore-->
        <!--                    et-->
        <!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut-->
        <!--                    aliquip-->
        <!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum-->
        <!--                    dolore eu-->
        <!--                    fugiat nulla pariatur.</p>-->
        <!---->
        <!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>-->
        <!--            </div>-->
        <!--            <div class="col-lg-3">-->
        <!--                <h2>Heading</h2>-->
        <!---->
        <!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore-->
        <!--                    et-->
        <!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut-->
        <!--                    aliquip-->
        <!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum-->
        <!--                    dolore eu-->
        <!--                    fugiat nulla pariatur.</p>-->
        <!---->
        <!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a>-->
        <!--                </p>-->
        <!--            </div>-->
        <!--        </div>-->

    </div>
</div>
