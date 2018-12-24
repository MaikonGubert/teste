<?php
/**
 * Created by PhpStorm.
 * User: Maikon Gubert
 * Date: 19/12/2018
 * Time: 18:48
 */

namespace app\controllers;

use app\models\CategoriaModel;
use app\models\PerguntaModel;
use yii\web\Controller;

class FaqController extends Controller
{
    public function actionIndex($categoria = null)
    {
        $categorias = CategoriaModel::find()->All();
        if ($categoria) {
            $ultPerguntas = PerguntaModel::find()->where(['categoria_id' => $categoria])->orderBy(['id' => SORT_DESC])->limit(15)->all();
        } else {
            $ultPerguntas = PerguntaModel::find()->orderBy(['id' => SORT_DESC])->limit(15)->all();
        }
        return $this->render('index', ['categorias' => $categorias, 'ultperguntas' => $ultPerguntas]);
    }


}