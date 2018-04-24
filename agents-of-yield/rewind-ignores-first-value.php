<?php declare(strict_types=1);

function gen()
{
	yield 'foo';
	yield 'bar';
}

$gen = gen();
print $gen->send( '' ) . PHP_EOL;

// As the send() happens before the first yield there is an implicit rewind() call,
// so what really happens is this:

$gen = gen();
$gen->rewind();
print $gen->send( '' ) . PHP_EOL;

// The rewind() will advance to the first yield (and ignore its value), the send() will
// advance to the second yield (and dump its value). Thus we loose the first yielded value!

$gen = gen();
$gen->rewind();	# can be omitted
print $gen->current() . PHP_EOL;
print $gen->send( '' ) . PHP_EOL;
