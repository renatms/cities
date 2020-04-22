<?php

namespace app\models;


use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $title;
    public $comment;
    public $image;

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'length' => [3, 250]],
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3, 250]],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, png'],
        ];
    }

    public function upload($file)
    {
        if ($this->validate()) {
            $this->image->saveAs("uploads/{$file}");
            return $file;
        } else {
            return false;
        }
    }

    /**
     * @param $city_id
     * @return bool
     */
    public function saveComment($city_id)
    {
        $comment = new Comment();

        $comment->title = $this->title;
        $comment->text = $this->comment;
        $comment->image = $this->image;
        $comment->user_id = Yii::$app->user->id;
        $comment->city_id = $city_id;
        $comment->rating = 0;
        $comment->created_at = date('Y-m-d');
        return $comment->save(false);
    }
}

