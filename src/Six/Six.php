<?php

namespace AOC\Six;

use AOC\Helpers\Input;
use AOC\Helpers\Iter\Iter;

class Six
{
    public function solve1(): int
    {
        $lines = Input::readLines("src/Six/input.txt");
        $groups = $this->splitIntoGroups($lines);

        $count = 0;

        foreach ($groups as $group) {
            $all = "";

            foreach ($group as $str) {
                $all .= $str;
            }

            $count += count(array_unique(str_split($all)));
        }

        return $count;
    }

    public function solve2(): int
    {
        $lines = Input::readLines("src/Six/input.txt");
        $groups = $this->splitIntoGroups($lines);

        $count = 0;

        foreach ($groups as $group) {
            $all = [];

            foreach ($group as $str) {
                $all = array_merge($all, str_split($str));
            }

            $unique = array_unique($all);
            $set = array_merge([$unique], Iter::from($group)->map(fn($v) => str_split($v))->get());

            $count += count(call_user_func_array("array_intersect", $set));
        }

        return $count;
    }

    private function splitIntoGroups(array $lines): array
    {
        $group = $groups = [];

        foreach ($lines as $line) {
            if (trim($line) == "") {
                $groups[] = $group;
                $group = [];
                continue;
            }

            $group[] = trim($line);
        }

        $groups[] = $group;
        return $groups;
    }
}