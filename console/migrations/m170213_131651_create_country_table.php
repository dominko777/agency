<?php

use yii\db\Migration;

/**
 * Handles the creation of table `country`.
 */
class m170213_131651_create_country_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'name' =>$this->string(30)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('country');
    }
}
