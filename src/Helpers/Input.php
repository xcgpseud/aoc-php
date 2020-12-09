<?php

namespace AOC\Helpers;

use JetBrains\PhpStorm\Pure;
use SplFileObject;

class Input
{
    #[Pure]
    public static function readLines(
        string $file,
        callable $fn = null
    ): array {
        $out = [];

        $file = new SplFileObject($file);
        while ( ! $file->eof()) {
            $out[] = is_null($fn) ? $file->fgets() : $fn($file->fgets());
        }
        $file = null;

        return $out;
    }
}