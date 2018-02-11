<?php declare(strict_types=1);
/**
 * @author  hollodotme
 * @license MIT (See LICENSE file)
 */

function gen()
{
	yield 'foo';
	yield 'bar';
}

$gen = gen();
var_dump( $gen->send( 'something' ) );

// As the send() happens before the first yield there is an implicit rewind() call,
// so what really happens is this:
$gen = gen();
$gen->rewind();
var_dump( $gen->send( 'something' ) );

// The rewind() will advance to the first yield (and ignore its value), the send() will
// advance to the second yield (and dump its value). Thus we loose the first yielded value!

$gen = gen();
var_dump( $gen->current() );
var_dump( $gen->send( 'something' ) );
