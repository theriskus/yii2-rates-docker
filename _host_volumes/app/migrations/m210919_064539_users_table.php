<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m210919_064539_users_table
 */
class m210919_064539_users_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'access_token' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $user = new User();
        $user->username = 'admin';
        $user->setPassword('admin');
        $user->access_token = Yii::$app->security->generateRandomString();
        $user->save();
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
