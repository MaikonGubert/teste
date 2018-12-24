<?php

use yii\db\Migration;

/**
 * Class m181220_164255_criar_tabela_resposta
 */
class m181220_164255_criar_tabela_resposta extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('resposta', [
            'id' => $this->primaryKey()->unsigned(),
            'resposta' => $this->text(),
            'datahora' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'pergunta_id' => $this->integer()->unsigned(),
            'usuario_id' => $this->integer()
        ]);
        $this->addForeignKey('pergunta_id_fk', 'resposta', 'pergunta_id', 'pergunta', 'id', 'cascade', null);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('resposta');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181220_164255_criar_tabela_resposta cannot be reverted.\n";

        return false;
    }
    */
}
