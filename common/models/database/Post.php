<?php

namespace common\models\database;

use yii\helpers\FileHelper;
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date = date('Y-m-d H:i:s', time());
            $this->userId = \Yii::$app->user->id;
            return true;
        }
        return false;
    }

    public function createDirsIfDoesNotExist()
    {
        if (!file_exists(\Yii::getAlias('@frontend') . '/web/uploads')) {
            FileHelper::createDirectory(\Yii::getAlias('@frontend') . '/web/uploads');
        }
        if (!file_exists(\Yii::getAlias('@frontend') . '/web/uploads/postImages')) {
            FileHelper::createDirectory(\Yii::getAlias('@frontend') . '/web/uploads/postImages');
        }
        if (!file_exists(\Yii::getAlias('@frontend') . '/web/uploads/postImages/' . date('Y-m-d'))) {
            FileHelper::createDirectory(\Yii::getAlias('@frontend') . '/web/uploads/postImages/' . date('Y-m-d'));
        }
    }


    public function savePostImage()
    {
        if ($this->validate()) {
            $this->filename = strtolower(md5(uniqid($this->imageFile->baseName))) . '.' . $this->imageFile->extension;
            $this->path = \Yii::getAlias('@frontend') . '/web/uploads/postImages/'
                . date('Y-m-d') . '/' . $this->filename;
            $this->createDirsIfDoesNotExist();
            $this->imageFile->saveAs($this->path);
            return true;
        } else {
            return false;
        }
    }
}
