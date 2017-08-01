<?php

namespace common\models\database;

use yii\web\UploadedFile;

/**
 * This is the model class for table "post".
 *
 * @property integer $postId
 * @property integer $userId
 * @property string $content
 * @property string $imageReference
 * @property string $date
 *
 * @property User $user
 */
class Post extends BasePost
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $path;
    public $filename;

/*    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
        ];
    }*/

    public function savePostImage()
    {
        if ($this->validate()) {
            $this->filename = strtolower(md5(uniqid($this->imageFile->baseName))) . '.' . $this->imageFile->extension;
            $this->path = \Yii::getAlias('@common') . '/uploads/' . $this->filename;
            $this->imageFile->saveAs($this->path);
            return true;
        } else {
            return false;
        }
    }

        public function saveToDatabase($userId, $content)
        {
            $this->userId = $userId;
            $this->date = date('Y-m-d H:i:s', time());
            $this->imageReference = $this->filename;
            $this->content = $content;
            if ($this->save()) {
                $this->content = '';
                return true;
            }
            $this->content = '';
            return false;
        }
}
