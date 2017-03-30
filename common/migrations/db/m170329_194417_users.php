<?php

use yii\db\Migration;

class m170329_194417_users extends Migration
{
    public static $tableName = '{{%users}}';

    public function up()
    {
        $this->createTable(self::$tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'email' => $this->string(255),
            'company_id' => $this->integer()
        ]);

        $this->addForeignKey('fk_company', self::$tableName, 'company_id', '{{%companies}}', 'id', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('fk_company', self::$tableName);
        $this->dropTable(self::$tableName);
    }
}
