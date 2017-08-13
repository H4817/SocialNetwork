<?php

namespace common\components;

use yii\web\Controller;

class Behaviors extends \yii\base\Behavior
{
    public static function redirectGuests($that)
    {
        if (\Yii::$app->user->isGuest && ($that instanceof Controller)) {
            $that->goHome();
        }
    }

}
