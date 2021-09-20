<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rate".
 *
 * @property int $id
 * @property string $charcode
 * @property string $name
 * @property integer $created
 * @property integer $numcode
 * @property integer $nominal
 * @property float $value
 */
class Rate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['charcode', 'value', 'numcode', 'nominal'], 'required'],
            [['charcode', 'name'], 'string', 'max' => 400],
            [['numcode', 'value', 'created', 'nominal'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'charcode' => 'Символьный код',
            'value' => 'Значение',
            'name' => 'Наименование',
            'numcode' => 'Код валюты',
            'nominal' => 'Номинал',
            'created' => 'Дата добавления',
        ];
    }
}
