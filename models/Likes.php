<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "likes".
 *
 * @property int $id
 * @property int $user_id
 * @property int $vote
 * @property int $ratable_id id zapisi za kotor vote
 *
 * @property Comment $user
 * @property Comment $ratable
 */
class Likes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'likes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'user_id', 'vote', 'ratable_id'], 'required'],
            [['city_id', 'user_id', 'vote', 'ratable_id'], 'integer'],
            [['vote'], 'default', 'value' => 0],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Comment::className(),
                'targetAttribute' => ['user_id' => 'user_id']
            ],
            [
                ['ratable_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Comment::className(),
                'targetAttribute' => ['ratable_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City_ID',
            'user_id' => 'User ID',
            'vote' => 'Vote',
            'ratable_id' => 'Ratable ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Comment::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Ratable]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatable()
    {
        return $this->hasOne(Comment::className(), ['id' => 'ratable_id']);
    }
}
