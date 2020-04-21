<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int|null $city_id
 * @property string|null $title
 * @property string|null $text
 * @property int|null $rating
 * @property string|null $image
 * @property int|null $user_id
 * @property string|null $created_at
 *
 * @property City $city
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3, 250]],
            [['city_id', 'rating', 'user_id'], 'integer'],
            [['rating'], 'default', 'value' => 0],
            [['created_at'], 'date', 'format' => 'php:Y-m-d'],
            [['created_at'], 'default', 'value' => date('Y-m-d')],
            [['title', 'text'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'jpg,png'],
            [
                ['city_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => City::className(),
                'targetAttribute' => ['city_id' => 'id']
            ],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']
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
            'city_id' => 'City ID',
            'title' => 'Title',
            'text' => 'Text',
            'rating' => 'Rating',
            'image' => 'Image',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    public function getImage()
    {
        return $this->image ? '/uploads/' . $this->image : 'no-image';
    }

//    public function saveImage(Comment $model)
//    {
//        return $model->save();
//    }

    public function deleteImage($file)
    {
        unlink("uploads/{$file}");
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->created_at);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
