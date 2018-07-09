<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "wish_list".
 *
 * @property int $id
 * @property int $book_id
 * @property int $user_id
 * @property string $status
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Books $book
 * @property User $user
 */
class WishList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wish_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'user_id'], 'required'],
            [['book_id', 'user_id'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'modified_at'], 'safe'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::className(), 'targetAttribute' => ['book_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return WishListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WishListQuery(get_called_class());
    }
}
