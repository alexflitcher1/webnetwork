<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\User;
use frontend\models\Login;
use frontend\models\Signup;
use frontend\models\UserPost;
use frontend\models\Userdata;
use frontend\models\Comments;
use frontend\models\Usernotices;
use frontend\models\CommentsManager;

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
        $posts = Usernotices::find()->where(['userid' => $user->id])->
        orderBy('id DESC')->all();
        $comments = Comments::find()->where(['authorid' => $user->id])->all();

        $commentators = [];
        for ($i = 0; $i < count($comments); $i++)
            $commentators[$i] = User::findOne(['id' => $comments[$i]->userid]);

        $model = new UserPost();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $usernotices = new Usernotices();
            $usernotices->userid = $user->id;
            $usernotices->text = $model->text;
            $model->text = "";
            $usernotices->datepost = date("Y-m-d H:i:s", time());
            if ($usernotices->save())
                return $this->redirect('/user/index');
        }
        $model2 = new CommentsManager();
        if ($model2->load(Yii::$app->request->post()) && $model2->validate()) {
            $comm = new Comments();
            $comm->userid = $user->id;
            $comm->postid = $model2->postid;
            $comm->authorid = $user->id;
            $comm->comment = $model2->comment;
            $model2->comment = "";
            $comm->datepub = date("Y-m-d H:i:s", time());
            if ($comm->save())
                return $this->redirect('/user/index');
        }
        return $this->render('index',
        ['user' => $user, 'userdata' => $userdata, 'login' => $cookie,
         'model' => $model, 'posts' => $posts, 'model2' => $model2,
         'comments' => $comments, 'commentators' => $commentators]);
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

    public function actionProfile($id)
    {
        $cookies = Yii::$app->request->cookies;
        if (($cookie = $cookies->get('auth')) == null) {
            return $this->redirect('/user/signup');
        }
        $commentator = User::findOne(['login' => $cookie])->id;
        $user = User::findOne(['id' => $id]);
        $userdata = Userdata::findOne(['userid' => $user->id]);
        $posts = Usernotices::find()->where(['userid' => $user->id])->
        orderBy('id DESC')->all();

        $comments = Comments::find()->where(['authorid' => $user->id])->all();
        $commentators = [];
        for ($i = 0; $i < count($comments); $i++)
            $commentators[$i] = User::findOne(['id' => $comments[$i]->userid]);

        $model2 = new CommentsManager();
        if ($model2->load(Yii::$app->request->post()) && $model2->validate()) {
            $comm = new Comments();
            $comm->userid = $commentator;
            $comm->postid = $model2->postid;
            $comm->authorid = $user->id;
            $comm->comment = $model2->comment;
            $model2->comment = "";
            $comm->datepub = date("Y-m-d H:i:s", time());
            if ($comm->save())
                return $this->redirect('/user/profile?id=' . $id);
        }

        return $this->render('profile',
        ['user' => $user, 'userdata' => $userdata, 'posts' => $posts,
         'comments' => $comments, 'commentators' => $commentators,
         'model2' => $model2]);
    }
}
