<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $file
 * @property string $status
 * @property string $created_at
 * @property string $modified_at
 *
 * @property WishList[] $wishLists
 */
class Books extends \yii\db\ActiveRecord
{
	public $uploadFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'string'],
			[['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['created_at', 'modified_at','video_link'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 500],
        ];
    }

	public function upload()
    {
        if ($this->validate()) {
            $this->files->saveAs('images/' . $this->files->baseName . '.' . $this->files->extension);
            return true;
        } else {
            return false;
        }
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'file' => 'File',
            'status' => 'Status',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWishLists()
    {
        return $this->hasMany(WishList::className(), ['book_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BooksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BooksQuery(get_called_class());
    }
}
