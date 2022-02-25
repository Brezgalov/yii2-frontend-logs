<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%frontend_logs}}`.
 */
class m220225_143202_create_frontend_logs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%frontend_logs}}', [
            'id' => $this->primaryKey(),
            'action' => $this->string()->notNull(),
            'meta' => $this->text(),
            'created_at' => $this->dateTime(),
        ]);

        $this->createIndex(
            'frontend_logs_IDX_action',
            '{{%frontend_logs}}',
            'action'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%frontend_logs}}');
    }
}
