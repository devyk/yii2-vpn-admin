<?php

use yii\db\Migration;

class m170329_204417_logs extends Migration
{
    public static $tableName = '{{%logs}}';

    public function up()
    {
        $this->createTable(self::$tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'date' => $this->dateTime(),
            'resource' => $this->text(),
            'transfer_total' => $this->bigInteger()->unsigned()
        ]);

        $this->addForeignKey('fk_user', self::$tableName, 'user_id', '{{%users}}', 'id', 'cascade');
        $this->createIndex('idx_transfer', self::$tableName, 'transfer_total');
    }

    public function down()
    {
        $this->dropIndex('idx_transfer', self::$tableName);
        $this->dropForeignKey('fk_user', self::$tableName);
        $this->dropTable(self::$tableName);
    }
}
