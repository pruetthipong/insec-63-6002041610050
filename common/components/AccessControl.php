<?php
namespace common\components;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class AccessControl extends ActionFilter {

public $params = [];
public $denyCallback;
private $separator = '-';

private function getItemName($component) {
    return strtr($component->getUniqueId(), '/', $this->separator);
}

public function beforeAction($action) {
    $user = Yii::$app->getUser();

    $controller = $action->controller;
    // echo $user->id;
    // echo $controller->id;
    // echo '-';
    // echo $controller->action->id;
    $permission = $controller->id;
    $permission.='-';
    $permission.=$controller->action->id;
    // echo $permissiom;
    // exit;
    if(Yii::$app->user->can($permission)){
        // echo 'can be access '.$permissiom;
        return true;
    }
    else{
        // echo 'do not access '.$permissiom;
        throw new ForbiddenHttpException('Contact Administrator');
    }

}

}
?>