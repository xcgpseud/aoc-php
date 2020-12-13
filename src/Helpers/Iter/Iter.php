<?php

namespace AOC\Helpers\Iter;

use Closure;
use JetBrains\PhpStorm\Pure;

class Iter
{
    private function __construct(private array|null $arr)
    {
    }

    public function foldl1(Closure $fn): mixed
    {
        $out = $this->head();

        foreach ($this->tail()->get() as $e) {
            $out = $fn($out, $e);
        }

        return $out;
    }

    #[Pure]
    public static function from(array|null $arr): static
    {
        return new static($arr);
    }

    public function get(): array
    {
        return $this->arr;
    }

    public function head(): mixed
    {
        return array_slice($this->arr, 0, 1)[0];
    }

    public function map(Closure $fn): self
    {
        $out = [];

        foreach ($this->arr as $v) {
            $out[] = $fn($v);
        }

        return self::from($out);
    }

    public function tail(): Iter
    {
        return self::from(array_slice($this->arr, 1));
    }
}