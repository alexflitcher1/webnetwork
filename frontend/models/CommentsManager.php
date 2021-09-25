<?php
namespace frontend\models;

use Yii;
use yii\base\Model;


class CommentsManager extends Model {

    public $comment, $postid;

    public function rules() {
        return [
            [['comment', 'postid'], 'required', 'message' => 'Заполните поле'],
        ];
    }

    public function attributeLabels() {
        return [
            'comment' => '',
            'postid' => '',
        ];
    }

}
