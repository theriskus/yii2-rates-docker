<?php

namespace app\controllers;

use app\helpers\ParamAuth;
use app\models\Rate;
use app\models\User;
use app\models\Weather;
use Yii;
use yii\base\Security;
use yii\filters\AccessControl;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class ApiController extends Controller
{

    public function actions()
    {
        return [
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
            ],

        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'auth' => ['post'],
                'weather' => ['get']
            ],
        ];
        if ($this->action->id == 'auth') {
            return $behaviors;
        }

        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => ParamAuth::className(),
        ];

        $behaviors['authenticator']['except'] = ['options'];


        return $behaviors;
    }

    public function actionAuth($username, $password)
    {

        $user = User::findByUsername($username);
        if ($user) {
            $user->validatePassword($password);
            $security = new Security();
            $user->access_token = Yii::$app->security->generateRandomString();
            $user->save(false);

            return ['token' => $user->access_token];
        }
        throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
    }

    public function actionRate($valute = null)
    {
        $rate = Rate::find()->select(['name', 'value'])
            ->where(['>','created',strtotime(date('Y-m-d'))]);
        if (isset($valute)) {
            $rate->andWhere(['charcode' => $valute]);
        }
        return $rate->asArray()->all();
    }

}