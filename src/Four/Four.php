<?php

namespace AOC\Four;

use AOC\Helpers\Input;

class Four
{
    public function solve1(): int
    {
        $lines = Input::readLines("src/Four/input.txt");
        $passports = $this->splitIntoPassportDatum($lines);

        $valid = 0;

        foreach ($passports as $passport) {
            if ($this->isPassportValid1($passport)) {
                $valid++;
            }
        }

        return $valid;
    }

    public function solve2(): int
    {
        $lines = Input::readLines("src/Four/input.txt");
        $passports = $this->splitIntoPassportDatum($lines);

        $valid = 0;

        foreach ($passports as $passport) {
            if ($this->isPassportValid2($passport)) {
                $valid++;
            }
        }

        return $valid;
    }

    private function splitIntoPassportDatum(array $lines): array
    {
        $out = [];
        $current = [];

        foreach ($lines as $line) {
            if (trim($line) == "") {
                $out[] = $current;
                $current = [];
                continue;
            }

            $sections = explode(' ', $line);
            foreach ($sections as $section) {
                $split = explode(':', $section);
                [$k, $v] = $split;
                $current[$k] = trim($v);
            }
        }

        $out[] = $current;

        return $out;
    }

    private function isPassportValid1(array $passport): bool
    {
        $required = [
            "byr",
            "iyr",
            "eyr",
            "hgt",
            "hcl",
            "ecl",
            "pid",
        ];

        foreach ($required as $key) {
            if ( ! isset($passport[$key])) {
                return false;
            }
        }

        return true;
    }

    private function isPassportValid2(array $passport): bool
    {
        $validation = [
            "byr" => fn($val) => (int) $val >= 1920 && (int) $val <= 2002,
            "iyr" => fn($val) => (int) $val >= 2010 && (int) $val <= 2020,
            "eyr" => fn($val) => (int) $val >= 2020 && (int) $val <= 2030,
            "hgt" => function ($val) {
                $n = (int) substr($val, 0, -2);
                $m = substr($val, -2);
                return ($m == "cm" && ($n >= 150 && $n <= 193))
                    || ($m == "in" && ($n >= 59 && $n <= 76));
            },
            "hcl" => fn($val) => preg_match("/#[0-9]*[a-f]*/", $val) === 1 && strlen($val) == 7,
            "ecl" => fn($val) => in_array($val, ["amb", "blu", "brn", "gry", "grn", "hzl", "oth"]),
            "pid" => fn($val) => strlen($val) == 9 && is_numeric($val),
        ];

        foreach ($validation as $key => $value) {
            if ( ! isset($passport[$key]) || ! $value($passport[$key])) {
                return false;
            }
        }

        return true;
    }
}