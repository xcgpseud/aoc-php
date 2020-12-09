<?php

namespace AOC\Two;

use AOC\Helpers\Input;
use JetBrains\PhpStorm\Pure;

class Two
{
    public function run(): void
    {
        print(sprintf("One: %s\nTwo: %s\n", $this->solve1(), $this->solve2()));
    }

    private function solve1(): int
    {
        $lines = Input::readLines("src/Two/input.txt", fn($line): array => $this->fnRead($line));
        $valid = 0;

        foreach ($lines as $inst) {
            [$low, $high, $char, $chars] = $inst;

            $count = substr_count($chars, $char);

            if ($count >= $low && $count <= $high) {
                $valid++;
            }
        }

        return $valid;
    }

    private function solve2(): int
    {
        $lines = Input::readLines("src/Two/input.txt", fn($line): array => $this->fnRead($line));
        $valid = 0;

        foreach ($lines as $inst) {
            [$low, $high, $char, $chars] = $inst;

            [$pLow, $pHigh] = $this->getAtPositions($chars, [$low, $high]);

            $bothMatch = $pLow == $char && $pHigh == $char;
            $eitherMatch = $pLow == $char || $pHigh == $char;

            if ($bothMatch) {
                continue;
            }

            if ($eitherMatch) {
                $valid++;
            }
        }

        return $valid;
    }

    #[Pure]
    private function fnRead(
        string $line
    ): array {
        [$left, $chars] = explode(": ", $line);
        [$nums, $char] = explode(' ', $left);;
        [$low, $high] = explode('-', $nums);

        return [$low, $high, $char, $chars];
    }

    private function getAtPositions(string $str, array $positions): array
    {
        $out = [];

        foreach ($positions as $pos) {
            $out[] = substr($str, $pos - 1, 1);
        }

        return $out;
    }
}