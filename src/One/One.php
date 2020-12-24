<?php

namespace AOC\One;

use AOC\Helpers\Input;

class One
{
    public function run(): void
    {
        print(sprintf("One: %s\nTwo: %s\n", $this->solve1(), $this->solve2()));
    }

    public function solve1(): int
    {
        $lines = Input::readLines("src/One/input.txt", fn($line): int => (int) $line);
        $seen = [];

        foreach ($lines as $i) {
            $rem = 2020 - $i;

            if (in_array($rem, $seen)) {
                return $i * $rem;
            }

            array_push($seen, $i);
        }

        return -1;
    }

    public function solve2(): int
    {
        $lines = Input::readLines("src/One/input.txt", fn($line): int => (int) $line);

        foreach ($lines as $i) {
            foreach ($lines as $j) {
                foreach ($lines as $k) {
                    if ($i + $j + $k == 2020) {
                        return $i * $j * $k;
                    }
                }
            }
        }

        return -1;
    }
}