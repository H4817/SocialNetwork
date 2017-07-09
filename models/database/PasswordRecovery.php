<?php

namespace app\models\database;

use Yii;
use yii\db\ActiveRecord;

class PasswordRecovery extends ActiveRecord
{
    public $token;
    public $user_id;
    public $date;

    function __construct($user_id)
    {
        parent::__construct();
        $this->token = self::generateSecretKey();
        $this->user_id = $user_id;
        $this->date = Yii::$app->getFormatter()->asDatetime(time());
    }

    public static function tableName() { return 'password_recovery'; }

    public static function generateSecretKey()
    {
        return Yii::$app->getSecurity()->generateRandomString() . '_' . Yii::$app->getFormatter()->asDatetime(time());
    }
}
