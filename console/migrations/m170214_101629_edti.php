<?php

use yii\db\Migration;

class m170214_101629_edti extends Migration
{

    public function safeUp()
    {
        $this->addColumn('agency', 'user_id', $this->integer()->notNull());
        $this->addForeignKey('FK_agency_user', 'agency', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_agency_user', 'user');
        $this->dropColumn('agency', 'user_id');
    }
}
