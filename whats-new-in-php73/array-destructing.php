<?php declare(strict_types=1);

$arr = [1, [2, 3]];

[&$a, [$b, &$c]] = $arr;

$a = 10;
$b = 20;
$c = 30;

print_r( $arr );