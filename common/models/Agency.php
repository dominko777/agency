<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "agency".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $country_id
 * @property string $phone
 *
 * @property Country $country
 */
class Agency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'name', 'phone', 'user_id'], 'required'],
            [['country_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['phone'], 'string', 'max' => 15],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'country_id' => 'Страна',
            'country' => 'Страна',
            'phone' => 'Телефон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
}
