<?php

namespace AOC\Five;

use AOC\Helpers\Input;

class Five
{
    public function solve1(): int
    {
        $lines = Input::readLines("src/Five/input.txt", fn($line) => $this->splitLine($line));

        $max = 0;

        foreach ($lines as $line) {
            [$fbs, $lrs] = $line;

            $row = $this->narrow1($fbs, 0, 127, 'F', 'B');
            $col = $this->narrow1($lrs, 0, 7, 'L', 'R');

            $seat = $row * 8 + $col;

            if ($seat > $max) {
                $max = $seat;
            }
        }

        return $max;
    }

    public function solve2(): int
    {
        $lines = Input::readLines("src/Five/input.txt", fn($line) => $this->splitLine($line));

        $seats = [];

        foreach ($lines as $line) {
            [$fbs, $lrs] = $line;

            $row = $this->narrow1($fbs, 0, 127, 'F', 'B');
            $col = $this->narrow1($lrs, 0, 7, 'L', 'R');

            $seats[] = $row * 8 + $col;
        }

        $max = $this->solve1();

        for ($i = 1; $i <= $max; $i++) {
            if (in_array($i - 1, $seats) && in_array($i + 1, $seats) && ! in_array($i, $seats)) {
                return $i;
            }
        }

        return 0;
    }

    private function narrow1(string $seq, int $min, int $max, string $low, string $high): int
    {
        $chars = str_split($seq);
        $last = '';

        foreach ($chars as $char) {
            [$min, $max] = $char == $low ? $this->takeLower($min, $max) : $this->takeUpper($min, $max);
            $last = $char;
        }

        return $last == $low ? $min : $max;
    }

    private function takeLower(int $min, int $max): array
    {
        return [
            $min,
            $min + floor(($max - $min) / 2),
        ];
    }

    private function takeUpper(int $min, int $max): array
    {
        return [
            $max - floor(($max - $min) / 2),
            $max,
        ];
    }

    function splitLine(string $line): array
    {
        return [
            substr($line, 0, 7),
            substr($line, 7),
        ];
    }
}