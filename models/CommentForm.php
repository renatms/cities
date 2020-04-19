<?php

namespace app\models;


use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $comment;

    public function rules(){
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }


    /**
     * @param $city_id
     * @return bool
     */
    public function saveComment($city_id)
    {
        $comment = new Comment();
        $comment->text = $this->comment;
        $comment->user_id = Yii::$app->user->id;
        $comment->city_id = $city_id;
//        $comment->status =0;
        $comment->created_at = date('Y-m-d' );
        return $comment->save(false);
    }
}