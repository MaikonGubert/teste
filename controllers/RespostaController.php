<?php

namespace app\controllers;

use Yii;
use app\models\RespostaModel;
use app\models\RespostaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class RespostaController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new RespostaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($pergunta_id)
    {
        $model = new RespostaModel();
        $model->pergunta_id = $pergunta_id;
        $model->datahora = date('Y-m-d H:i:s');
        $model->usuario_id = Yii::$app->user->getId();

        if (Yii::$app->request->isAjax) {

            $post = Yii::$app->request->post();
            $model->resposta = $post['resposta'];
            $response = Yii::$app->response;
            $response->format = yii\web\Response::FORMAT_JSON;
            if ($model->save()) {
                $model->datahora = Yii::$app->formatter->format($model->datahora, 'datetime');
                $response->setStatusCode(200);
                $response->data = [$model];
            } else {
                $response->setStatusCode(400);
                $response->data = 'Falha ao salvar a resposta';
            }
            return $response;
        }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Resposta criada com sucesso!");
                return $this->redirect(['pergunta/view', 'id' => $model->pergunta_id]);
            } else {
                Yii::$app->session->setFlash('error', "Falha ao salvar a resposta!");
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
                    Yii::$app->session->setFlash('success', "Resposta editada com sucesso!");
                    return $this->redirect(['pergunta/view', 'id' => $model->pergunta_id]);
                } else {
                    Yii::$app->session->setFlash('error', "Falha ao editar a resposta!");
                    return $this->refresh();
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);

        } else {
            Yii::$app->session->setFlash('info', "Você não tem permissao para editar esta resposta!");
            return $this->redirect(['faq/index']);
        }

    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $pergunta_id = $model->pergunta_id;

        if ($model->usuario_id == Yii::$app->user->getId()) {

            if ($model->delete()) {
                Yii::$app->session->setFlash('success', "Resposta excluida com sucesso!");
            } else {
                Yii::$app->session->setFlash('error', "Falha ao excluir a resposta!");
            }

        } else {
            Yii::$app->session->setFlash('info', "Você não tem permissao para excluir esta resposta!");
        }
        return $this->redirect(['pergunta/view', 'id' => $pergunta_id]);
    }

    protected function findModel($id)
    {
        if (($model = RespostaModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
