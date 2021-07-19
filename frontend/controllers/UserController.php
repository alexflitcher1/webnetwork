<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\User;
use frontend\models\Signup;
use frontend\models\Login;
use frontend\models\Userdata;

class UserController extends Controller
{
    public function actionIndex()
    {
        $cookies = Yii::$app->request->cookies;
        if (($cookie = $cookies->get('auth')) == null) {
            return $this->redirect('/user/signup');
        }
        $user = User::findOne(['login' => $cookie]);
        $userdata = Userdata::findOne(['userid' => $user->id]);
        return $this->render('index',
        ['user' => $user, 'userdata' => $userdata, 'login' => $cookie]);
    }

    public function actionSignup()
    {
        $cookies = Yii::$app->request->cookies;
        if (($cookie = $cookies->get('auth')) != null) {
            return $this->redirect('/user/index');
        }

        $model = new Signup();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user     = new User();
            $userdata = new Userdata();
            $user->login = htmlentities($model->login);
            $user->firstname = htmlentities($model->firstname);
            $user->lastname = htmlentities($model->lastname);
            $user->password =
            Yii::$app->getSecurity()->generatePasswordHash($model->password);
            if ($user->save()) {

            }
            $userdata->userid = Yii::$app->db->getLastInsertID();
            $userdata->regdate = date('Y-m-d H:i:s', time());
            if ($userdata->save()) {
                $cookies = Yii::$app->response->cookies;
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'auth',
                    'expire' => time() + 31*24*60*60,
                    'value' => htmlentities($model->login),
                ]));
                return $this->redirect('/user/index');
            }
            return $this->render('signup', ['model' => $model]);
        }
        return $this->render('signup', ['model' => $model]);
    }

    public function actionLogin()
    {
        $cookies = Yii::$app->request->cookies;
        if (($cookie = $cookies->get('auth')) != null) {
            return $this->redirect('/user/index');
        }
        $model = new Login();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::findOne(['login' => htmlentities($model->login)]);
            $hash = $user->password;
            if (Yii::$app->getSecurity()->validatePassword(
            htmlentities($model->password), $hash)) {
                $cookies = Yii::$app->response->cookies;
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'auth',
                    'expire' => time() + 31*24*60*60,
                    'value' => htmlentities($model->login),
                ]));
                return $this->redirect('/user/index');
            } else {
                return $this->render('login', ['model' => $model,
                'error' => 'Не правильный пароль']);
            }
        }
        return $this->render('login', ['model' => $model]);
    }
}
