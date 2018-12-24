<?php

use yii\db\Migration;

/**
 * Class m181220_164249_criar_tabela_pergunta
 */
class m181220_164249_criar_tabela_pergunta extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pergunta', [
            'id' => $this->primaryKey()->unsigned(),
            'titulo' => $this->string(90),
            'pergunta' => $this->text(),
            'datahora' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'categoria_id' => $this->integer()->unsigned(),
            'usuario_id' => $this->integer()
        ]);
        $this->addForeignKey('categoria_id_fk', 'pergunta', 'categoria_id', 'categoria', 'id', null, null);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pergunta');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181220_164249_criar_tabela_pergunta cannot be reverted.\n";

        return false;
    }
    */
}
