<?php declare(strict_types=1);

function generate()
{
	yield 1;
}

$generator = generate();

echo 'Type: ', gettype( $generator ), PHP_EOL;
echo 'Class: ', get_class( $generator ), PHP_EOL;
echo 'Is ', (is_callable( $generator ) ? 'callable' : 'not callable'), PHP_EOL;

$generatorClone = clone $generator;
