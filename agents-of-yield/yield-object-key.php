<?php declare(strict_types=1);

//function gen()
//{
//	$key           = new stdClass();
//	$key->property = 'I am an object!';
//
//	yield $key => '& I am a simple string!';
//}
//
//$generator = gen();
//echo $generator->key()->property, ' ', $generator->current();

// Try with array

$key           = new stdClass();
$key->property = 'I am an object!';

$array = [$key => '& I am a simple string.'];

echo key($array)->property, ' ', current($array);