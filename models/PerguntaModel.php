<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pergunta".
 *
 * @property string $id
 * @property string $titulo
 * @property string $pergunta
 * @property string $datahora
 * @property string $categoria_id
 * @property int $usuario_id
 *
 * @property Categoria $categoria
 * @property Resposta[] $respostas
 */
class PerguntaModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pergunta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'pergunta', 'categoria_id', 'usuario_id'], 'required'],
            [['pergunta'], 'string'],
            [['datahora'], 'safe'],
            [['categoria_id', 'usuario_id'], 'integer'],
            [['titulo'], 'string', 'max' => 90],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriaModel::className(), 'targetAttribute' => ['categoria_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'pergunta' => 'Pergunta',
            'datahora' => 'Datahora',
            'categoria_id' => 'Categoria ID',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(CategoriaModel::className(), ['id' => 'categoria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespostas()
    {
        return $this->hasMany(RespostaModel::className(), ['pergunta_id' => 'id']);
    }
}
