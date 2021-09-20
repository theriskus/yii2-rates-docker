<?php

namespace app\helpers;

use yii\filters\auth\AuthMethod;

class ParamAuth extends AuthMethod
{
    public function authenticate($user, $request, $response)
    {
        $accessToken = $request->getHeaders()->get('token');
        if (is_string($accessToken)) {
            $identity = $user->loginByAccessToken($accessToken, get_class($this));
            if ($identity !== null) {
                return $identity;
            }
        }
        if ($accessToken !== null) {
            $this->handleFailure($response);
        }

        return null;
    }
}