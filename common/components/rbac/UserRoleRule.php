<?php
namespace common\components\rbac;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use common\models\User;

class UserRoleRule extends Rule
{
    public $name = 'userRole';
    public function execute($user, $item, $params)
    {
        $user = ArrayHelper::getValue($params, 'user', User::findOne($user));
        if ($user) {
            $role = $user->role;
            if ($item->name === 'master') {
                return $role == User::ROLE_MASTER;
            } elseif ($item->name === 'admin') {
                return $role == User::ROLE_MASTER || $role == User::ROLE_ADMINISTRATOR;
            }
        }
        return false;
    }
}