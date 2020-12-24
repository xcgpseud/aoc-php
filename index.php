<?php

use AOC\Factory;

require_once "vendor/autoload.php";

if (isset($argv[1])) {
    $class = ucfirst(strtolower($argv[1]));
    $full = sprintf("AOC\%s\%s", $class, $class);
    $obj = new $full();

    print(sprintf("One: %s\nTwo: %s\n", $obj->solve1(), $obj->solve2()));
}
