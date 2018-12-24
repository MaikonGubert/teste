<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resposta".
 *
 * @property string $id
 * @property string $resposta
 * @property string $datahora
 * @property string $pergunta_id
 * @property int $usuario_id
 *
 * @property Pergunta $pergunta
 */
class RespostaModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resposta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resposta', 'pergunta_id', 'usuario_id'], 'required'],
            [['resposta'], 'string'],
            [['datahora'], 'safe'],
            [['pergunta_id', 'usuario_id'], 'integer'],
            [['pergunta_id'], 'exist', 'skipOnError' => true, 'targetClass' => PerguntaModel::className(), 'targetAttribute' => ['pergunta_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resposta' => 'Resposta',
            'datahora' => 'Datahora',
            'pergunta_id' => 'Pergunta ID',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPergunta()
    {
        return $this->hasOne(PerguntaModel::className(), ['id' => 'pergunta_id']);
    }
}
