<?php

namespace AOC\Helpers;

use SplFileObject;

class Input
{
    public static function readLines(string $file, callable $fn = null): array
    {
        $out = [];

        $file = new SplFileObject($file);
        while ( ! $file->eof()) {
            $out[] = is_null($fn) ? $file->fgets() : $fn($file->fgets());
        }
        $file = null;

        return $out;
    }
}