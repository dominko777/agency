<?php

use yii\db\Migration;

class m170213_132037_edit_user_table extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('user', 'username');
        $this->addColumn('user', 'fio' , $this->string(50));
        $this->addColumn('user', 'country_id', $this->integer()->notNull());
        $this->addColumn('user', 'phone', $this->string(15));
        $this->addColumn('user', 'agency', $this->string(15));
        $this->addForeignKey('FK_user_country', 'user', 'country_id', 'country', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_user_country', 'user');
        $this->addColumn('user', 'username' , $this->string(50));
        $this->dropColumn('user', 'fio');
        $this->dropColumn('user', 'country_id');
        $this->dropColumn('user', 'agency');
    }
}
