<?php

use yii\db\Migration;

/**
 * Class m210919_170140_add_rate_info
 */
class m210919_170140_add_rate_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('rate',[
			'id' => $this->primaryKey(),
            'charcode' => $this->string()->notNull(),
            'value' => $this->decimal(10,4),
            'name' => $this->string(300),
            'numcode' => $this->integer(),
            'nominal' => $this->integer(),
            'created'=>$this->timestamp()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP'))
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rate');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210919_170140_add_rate_info cannot be reverted.\n";

        return false;
    }
    */
}
