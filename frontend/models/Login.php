<?php
namespace frontend\models;

use Yii;
use yii\base\Model;


class Login extends Model {

    public $login;
    public $password;

    public function rules() {
        return [
            [['login', 'password'], 'required', 'message' => 'Заполните поле'],
            ['login', 'exist', 'targetClass' => User::className(),
            'message' => 'Логин не существует'],
        ];
    }

    public function attributeLabels() {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

}
