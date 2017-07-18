<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFileForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $path;
    public $filename;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->filename = strtolower(md5(uniqid($this->imageFile->baseName))) . '.' . $this->imageFile->extension;
            $this->path = Yii::getAlias('@common') . '/uploads/' . $this->filename;
            $this->imageFile->saveAs($this->path);
            return true;
        } else {
            return false;
        }
    }
}