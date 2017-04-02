<?php

use yii\db\Migration;

class m170402_244417_initial_data extends Migration
{
    public static $tableName = '{{%logs}}';

    public function up()
    {
        $this->batchInsert('{{%companies}}', ['name', 'quota'], [
            ['Apple', 10000000000000],
            ['Alibaba', 1000000000000]
        ]);

        $this->batchInsert('{{%users}}', ['name', 'email', 'company_id'], [
            ['John', 'John@doe.com', 1],
            ['Jane', 'jane@doe.com', 1],
            ['Jim', 'jim@doe.com', 2],
            ['Richard', 'richard@apple.com', 1],
            ['Picasso', 'picasso@apple.com', 2],
        ]);
    }

    public function down()
    {
        // No revert for data
    }
}
