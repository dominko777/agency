<?php
namespace frontend\models;

use common\models\Agency;
use yii\base\Model;
use common\models\User;
use Yii;
use yii\helpers\Url;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $fio;
    public $email;
    public $password;
    public $role;
    public $agency;
    public $phone;
    public $country_id;
    public $repeat_password;
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fio', 'phone', 'name', 'country_id'], 'trim'],
            [['fio', 'country_id', 'phone', 'role'], 'required'],
            ['fio', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя уже занято.'],
            ['fio', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email уже занят.'],

            [['password', 'repeat_password'], 'required'],
            ['password', 'string', 'min' => 6],
            [['repeat_password'], 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли должны совпадать.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        
        $user = new User();
        $user->fio = $this->fio;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save())
        {
            $agency = new Agency();
            $agency->phone = $this->phone;
            $agency->country_id = $this->country_id;
            $agency->name = $this->name;
            $agency->user_id = $user->id;
            if ($agency->save())
            {
                Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom(Yii::$app->params['supportEmail'])
                    ->setSubject('Создание нового агенства')
                    ->setTextBody('Ваше агентство ' . $agency->name . ' успешно зарегистрировано в Системе. Спасибо, что вы с нами. 
                Тел тех поддержки - ' . Yii::$app->params['supportPhone'] . ' и ' . Yii::$app->params['adminEmail'] . ' - email мастера системы')
                    ->send();

                Yii::$app->mailer->compose()
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setFrom(Yii::$app->params['supportEmail'])
                    ->setSubject('Создание нового агенства')
                    ->setHtmlBody('Зарегистрировано новое агентство <a href="' . Url::base() . '">' . $agency->name . '</a>')
                    ->send();

                return $user;
            }
        }
        else
            return null;
    }

    public function attributeLabels()
    {
        return [
            'agency' => 'Агенство',
            'fio' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Ваш e-mail',
            'country_id' => 'Страна',
            'password' => 'Пароль',
            'repeat_password' => 'Повторите пароль',
            'role' => 'Роль',
        ];
    }
}
