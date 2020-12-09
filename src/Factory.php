<?php

namespace AOC;

use AOC\One\One;
use AOC\Two\Two;

class Factory
{
    public static function One(): void
    {
        $one = new One();
        $one->run();
    }

    public static function Two(): void
    {
        $two = new Two();
        $two->run();
    }
}