<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apples}}`.
 */
class m230215_125230_create_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apples}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(),
            'status' => $this->tinyInteger(),
            'eaten' => $this->smallInteger(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'fell_at' => $this->timestamp()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apples}}');
    }
}
