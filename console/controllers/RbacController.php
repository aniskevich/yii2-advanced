<?php


namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $role = $auth->createRole('admin');
        $role->description = 'Администратор';
        $auth->add($role);

        $role = $auth->createRole('manager');
        $role->description = 'Управляющий';
        $auth->add($role);

        $role = $auth->createRole('user');
        $role->description = 'Пользователь';
        $auth->add($role);

        $role = $auth->createRole('guest');
        $role->description = 'Гость';
        $auth->add($role);

    }

    public function actionAdminPermission()
    {
        $auth = Yii::$app->authManager;

        $adminPageAccess = $auth->createPermission('adminPageAccess');
        $adminPageAccess->description = 'Доступ к админке';
        $auth->add($adminPageAccess);

        $role = $auth->getRole('admin');
        $permit = $auth->getPermission('adminPageAccess');
        $auth->addChild($role, $permit);
    }
}