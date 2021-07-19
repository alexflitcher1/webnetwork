<?php
namespace frontend\models;

use Yii;
use yii\base\Model;


class Signup extends Model {

    public $login;
    public $password, $repass;
    public $firstname, $lastname;

    public function rules() {
        return [
            [['login', 'firstname', 'lastname', 'password', 'repass'], 'required', 'message' => 'Заполните поле'],
            ['repass', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
            ['login', 'unique', 'targetClass' => User::className()]
        ];
    }

    public function attributeLabels() {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'repass' => 'Повторите пароль',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия'
        ];
    }

}
