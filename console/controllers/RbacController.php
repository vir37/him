<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.01.2017
 * Time: 22:36
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

class RbacController extends Controller {

    public function actionCreateRole($roleName, $description="") {
        $auth = Yii::$app->authManager;

        $role = $auth->createRole($roleName);
        $role->description = $description;
        $auth->add($role);
        echo "Role added";
    }

    public function actionCreatePermission($permName, $description="") {
        $auth = Yii::$app->authManager;

        $permission = $auth->createPermission($permName);
        $permission->description = $description;
        $auth->add($permission);
        echo "Permission added";
    }

    public function actionShowRoles(){
        $roles = Yii::$app->authManager->getRoles();
        $format = "%5s %-15s %s\n";
        printf($format."%'-5s %'-15s %'-20s\n", "Type", "Name", "Description", "", "", "","");
        foreach ($roles as $role) {
            printf($format, $role->type, $role->name, $role->description);
        }
    }

    public function actionShowPermissions() {
        $permissions = Yii::$app->authManager->getPermissions();
        $format = "%5s %-15s %s\n";
        printf($format."%'-5s %'-15s %'-20s\n", "Type", "Name", "Description", "", "", "","");
        foreach ($permissions as $permission) {
            printf($format, $permission->type, $permission->name, $permission->description);
        }
    }

    public function actionShowRules() {
        $rules = Yii::$app->authManager->getRules();
    }

    public function actionCreateUser($login, $email, $pwd) {
        $user = new User();
        $user->username = $login;
        $user->email = $email;
        $user->setPassword($pwd);
        $user->generateAuthKey();
        $user->save(false);

        $auth = Yii::$app->authManager;
        $auth->assign($auth->getRole('guest'), $user->getId());
        echo "User added";
    }
} 