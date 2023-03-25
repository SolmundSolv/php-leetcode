<?php

// zad 1

class Pipeline
{
    public static function make(...$functions)
    {
        foreach ($functions as $function) {
            if (!is_callable($function)) {
                throw new InvalidArgumentException('Invalid argument: ' . var_export($function, true));
            }
        }
        return function ($arg) use ($functions) {
            $result = $arg;
            foreach ($functions as $function) {
                $result = $function($result);
            }
            return $result;
        };
    }
}


$pipeline = Pipeline::make(
    function ($var) {
        return $var * 3;
    },
    function ($var) {
        return $var + 1;
    },
    function ($var) {
        return $var / 2;
    }
);

$result = $pipeline(3);

echo $result; // Output: 5
