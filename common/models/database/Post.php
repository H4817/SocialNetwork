<?php

namespace common\models\database;

use Yii;

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

    public function _save($userId, $filename, $content)
    {
        $this->userId = $userId;
        $this->date = date('Y-m-d H:i:s', time());
        $this->imageReference = $filename;
        $this->content = $content;
        if ($this->validate()) {
            return $this->save();
        }
        return false;
    }
}
