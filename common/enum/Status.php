<?php
declare(strict_types=1);

namespace common\enum;

use common\helpers\LabelHelper;

class Status
{
    const ON_TREE = 1;
    const ON_GROUND = 2;

    public static function getList(): array
    {
        return [
            self::ON_TREE => 'On tree',
            self::ON_GROUND => 'On ground|Fallen',
        ];
    }

    public static function get(int $status): string
    {
        if (array_key_exists($status, self::getList())) {
            return self::getList()[$status];
        }

        return '';
    }

    public static function getLabels(): array
    {
        return [
            self::ON_TREE => LabelHelper::SUCCESS,
            self::ON_GROUND => LabelHelper::WARNING,
        ];
    }

    public static function label($status)
    {
        if (array_key_exists($status, self::getLabels())) {
            return self::getLabels()[$status];
        }

        return LabelHelper::DEFAULT;
    }
}
