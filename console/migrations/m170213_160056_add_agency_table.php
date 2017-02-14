<?php

use yii\db\Migration;

class m170213_160056_add_agency_table extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('FK_user_country', 'user');
        $this->dropColumn('user', 'country_id');
        $this->dropColumn('user', 'agency');
        $this->dropColumn('user', 'phone');
        $this->createTable('agency', [
            'id' => $this->primaryKey(),
            'name' =>$this->string(30),
            'country_id' => $this->integer()->notNull(),
            'phone' => $this->string(15),
        ]);
        $this->addForeignKey('FK_agency_country', 'agency', 'country_id', 'country', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_agency_country', 'user');
        $this->addColumn('user', 'country_id', $this->integer()->notNull());
        $this->addColumn('user', 'phone', $this->string(15));
        $this->addColumn('user', 'agency', $this->string(15));
        $this->addForeignKey('FK_user_country', 'user', 'country_id', 'country', 'id', 'CASCADE', 'CASCADE');
    }
}
