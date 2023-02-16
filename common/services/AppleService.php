<?php

namespace common\services;

use common\enum\Status;
use common\models\Apple;

class AppleService
{
    public function eat(Apple $apple, int $percent)
    {
        if ($apple->status == Status::ON_TREE) {
            throw new \RuntimeException('Apple is on tree! Drop it for eat :)');
        } else if ($apple->isRotten()) {
            throw new \RuntimeException('Apple is rotten, you can`t eat it :(');
        } else {
            $apple->eaten = ($apple->eaten + $percent) > 100 ? 100 : $apple->eaten + $percent;
            $apple->save();
        }
    }

    public function drop(Apple $apple)
    {
        $apple->status = Status::ON_GROUND;
        $apple->fell_at = date('Y-m-d H:i:s');
        $apple->save();
    }

    public function remove(Apple $apple)
    {
        if ($apple->isRotten() || $apple->isEated()) {
            $apple->delete();
        }

        throw new \RuntimeException('Apple is good, you can`t delete it');
    }
}