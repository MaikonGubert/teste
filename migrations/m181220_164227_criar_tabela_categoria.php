<?php

use yii\db\Migration;

/**
 * Class m181220_164227_criar_tabela_categoria
 */
class m181220_164227_criar_tabela_categoria extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categoria', [
            'id' => $this->primaryKey()->unsigned(),
            'nome' => $this->string(45)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categoria');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181220_164227_criar_tabela_categoria cannot be reverted.\n";

        return false;
    }
    */
}
