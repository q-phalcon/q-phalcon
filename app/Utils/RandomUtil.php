<?php
declare(strict_types = 1);

namespace App\Utils;

use Phalcon\Security\Random;

class RandomUtil
{

    private static $random = null;

    private static function random()
    {
        if (self::$random === null) {
            self::$random = new Random();
        }
        return self::$random;
    }

    public static function getUuid()
    {
        $random = self::random();
        return str_replace('-', '', $random->uuid());
    }

    public static function getNum(integer $max)
    {
        $random = self::random();
        return $random->number($max);
    }
}
