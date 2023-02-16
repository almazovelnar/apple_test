<?php

namespace common\repositories;

use common\models\Apple;
use yii\web\NotFoundHttpException;

class AppleRepository
{
    public function get(int $id)
    {
        if ($model = Apple::findOne($id)) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

}