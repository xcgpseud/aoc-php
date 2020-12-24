<?php

namespace AOC\Three;

use AOC\Helpers\Input;
use AOC\Helpers\Iter\Iter;
use AOC\Helpers\Iter\IterNil;

class Three
{
    public function run(): void
    {
        print(sprintf("One: %s\nTwo: %s\n", $this->solve1(), $this->solve2()));
    }

    private function slideAndCountTrees(int $right, int $down, array $lines): int
    {
        $trees = 0;
        $x = $right;

        for ($i = $down; $i < count($lines); $i += $down) {
            if (substr($lines[$i], $x, 1) == "#") {
                $trees++;
            }

            $x = ($x + $right) % (strlen($lines[$i]) - 1);
        }

        return $trees;
    }

    public function solve1(): int
    {
        $lines = Input::readLines("src/Three/input.txt");

        return $this->slideAndCountTrees(3, 1, $lines);
    }

    public function solve2(): int
    {
        $lines = Input::readLines("src/Three/input.txt");

        return Iter::from([
            [1, 1],
            [3, 1],
            [5, 1],
            [7, 1],
            [1, 2],
        ])->map(function ($slope) use ($lines) {
            [$right, $down] = $slope;
            return $this->slideAndCountTrees($right, $down, $lines);
        })->foldl1(fn($a, $b) => $a * $b);
    }
}