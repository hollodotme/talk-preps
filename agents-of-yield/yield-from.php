<?php declare(strict_types=1);

function countToTen() : Generator
{
	yield 1;
	for ( $i = 2; $i < 4; $i++ ) {
		yield $i;
	}
	yield from [4, 5];
	yield from json_decode( '[6,7]' );
	yield from eightNine();
	yield 10;
}

function eightNine() : Generator
{
	yield '8 ' => 9;
}

$generator = countToTen();
foreach ( $generator as $key => $number )
{
	print (is_string($key) ? $key : '') . $number . ' ';
}

echo PHP_EOL;
