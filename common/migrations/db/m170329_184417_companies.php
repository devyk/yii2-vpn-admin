<?php

use yii\db\Migration;

class m170329_184417_companies extends Migration
{
    public static $tableName = '{{%companies}}';

    public function up()
    {
        $this->createTable(self::$tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'quota' => $this->bigInteger()->unsigned()
        ]);

        $this->createIndex('idx_quota', self::$tableName, 'quota');
    }

    public function down()
    {
        $this->dropTable(self::$tableName);
    }
}
