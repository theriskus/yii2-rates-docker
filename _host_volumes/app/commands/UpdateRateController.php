<?php

namespace app\commands;

use app\models\Rate;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Json;

class UpdateRateController extends Controller
{
    public $defaultAction = 'load';

    public function actionLoad()
    {
        $json = json_decode(file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js'), true);
        if (empty($json)) {
            return ExitCode::DATAERR;
        }
        foreach ($json["Valute"] as $code => $valute) {
            $rate = new Rate();
            $rate->numcode = $valute['NumCode'];
            $rate->charcode = $valute['CharCode'];
            $rate->nominal = $valute['Nominal'];
            $rate->value = $valute['Value'];
            $rate->name = $valute['Name'];

            $rate->save();
        }

        return ExitCode::OK;
    }
}
