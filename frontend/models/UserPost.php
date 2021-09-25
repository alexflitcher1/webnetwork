<?php
namespace frontend\models;

use Yii;
use yii\base\Model;


class UserPost extends Model {

    public $text;

    public function rules() {
        return [
            [['text'], 'required', 'message' => 'Заполните поле'],
        ];
    }

    public function attributeLabels() {
        return [
            'text' => '',
        ];
    }

}
