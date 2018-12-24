<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/**
 * PerguntaSearch represents the model behind the search form of `app\models\PerguntaModel`.
 */
class PerguntaSearch extends PerguntaModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoria_id', 'usuario_id'], 'integer'],
            [['titulo', 'pergunta', 'datahora'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PerguntaModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'datahora' => $this->datahora,
            'categoria_id' => $this->categoria_id,
            'usuario_id' => $this->usuario_id,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'pergunta', $this->pergunta]);

        return $dataProvider;
    }

    public function autoComplete($term)
    {
        $res = $this->find()->where(['like', 'titulo', $term])->orderBy(['titulo' => SORT_ASC])->limit(15)->all();
        if ($res != null) {
            $result = [];
            foreach ($res as $row) {
                $result[] = ['id' => $row->id, 'value' => $row->titulo, 'rotaview' => Url::toRoute(['pergunta/view', 'id' => $row->id])];
            }
            return $result;
        } else {
            false;
        }
    }
}
