<?php

use yii\db\Migration;
use yii\db\Schema;
use app\models\User;

/**
 * Class m210211_155717_user
 */
class m210211_155717_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('user', ['nombre' => Schema::TYPE_STRING,
		'rool' => User::COLABORADOR, 'password' => Schema::TYPE_STRING]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210211_155717_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210211_155717_user cannot be reverted.\n";

        return false;
    }
    */
}
