<?php

namespace app\controllers;

use Yii;
use app\models\PerguntaModel;
use app\models\PerguntaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PerguntaController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

//    public function actionIndex()
//    {
//        $searchModel = new PerguntaSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new PerguntaModel();

        if ($model->load(Yii::$app->request->post())) {

            $model->datahora = date('Y-m-d H:i:s');

            $model->usuario_id = Yii::$app->user->getId();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Pergunta criada com sucesso!");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', "Falha ao criar a pergunta!");
                return $this->refresh();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->usuario_id == Yii::$app->user->getId()) {

            if ($model->load(Yii::$app->request->post())) {

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', "Pergunta editada com sucesso!");
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', "Falha ao editar a pergunta!");
                    return $this->refresh();
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);

        } else {
            Yii::$app->session->setFlash('info', "Você não tem permissao para editar esta pergunta!");
            return $this->redirect(['faq/index']);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->usuario_id == Yii::$app->user->getId()) {

            if ($model->delete()) {
                Yii::$app->session->setFlash('success', "Pergunta excluida com sucesso!");
            } else {
                Yii::$app->session->setFlash('error', "Falha ao excluir a pergunta!");
            }

        } else {
            Yii::$app->session->setFlash('info', "Você não tem permissao para excluir esta pergunta!");
        }

        return $this->redirect(['faq/index']);
    }

    public function actionAuto($term)
    {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        $searchModel = new PerguntaSearch();
        return $searchModel->autoComplete($term);
    }

    protected function findModel($id)
    {
        if (($model = PerguntaModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
