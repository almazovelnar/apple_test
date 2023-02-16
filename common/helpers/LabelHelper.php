<?php

namespace common\helpers;

use yii\helpers\Html;

class LabelHelper
{
    const DEFAULT = 'default';
    const SECONDARY = 'secondary';
    const INFO = 'info';
    const PRIMARY = 'primary';
    const SUCCESS = 'success';
    const WARNING = 'warning';
    const DANGER = 'danger';

    public static function types()
    {
        return [
            self::DEFAULT,
            self::SECONDARY,
            self::INFO,
            self::PRIMARY,
            self::SUCCESS,
            self::WARNING,
            self::DANGER,
        ];
    }

    public static function getType($type): string
    {
        return in_array($type, self::types()) ? $type : self::DEFAULT;
    }

    public static function generate(string $content, ?string $type = self::DEFAULT): string
    {
        return \yii\helpers\Html::tag('span', $content, [
            'class' => 'badge badge-' . self::getType($type),
            'style' => 'font-size: 85%;'
        ]);
    }
}