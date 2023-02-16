<?php

namespace common\models;

use common\enum\Status;
use yii\db\ActiveRecord;

/**
 * @property int $eaten
 * @property int $status
 * @property string $fell_at
 */
class Apple extends ActiveRecord
{
    const ROTTEN_PERIOD = 7;
    public static function tableName()
    {
        return 'apples';
    }

    public function rules()
    {
        return [
            ['color', 'string']
        ];
    }

    public function isRotten(): bool
    {
        return (time() - strtotime($this->getFellAt())) / 86400 > self::ROTTEN_PERIOD;
    }

    public function getFellAt(): ?string
    {
        return $this->fell_at;
    }

    public function setFellAt($fell_at): void
    {
        $this->fell_at = $fell_at;
    }

    public function isEated(): bool
    {
        return $this->eaten == 100;
    }
}