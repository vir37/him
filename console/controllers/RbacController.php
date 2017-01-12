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

class RbacController extends Controller {

    public function actionCreateRole($roleName, $description="") {
        $auth = Yii::$app->authManager;

        $role = $auth->createRole($roleName);
        $role->description = $description;
        $auth->add($role);
        echo "Role added";
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
    }

    public function actionShowRules() {
        $rules = Yii::$app->authManager->getRules();
    }
} 