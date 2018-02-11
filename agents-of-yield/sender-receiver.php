<?php declare(strict_types=1);
/**
 * @author  hollodotme
 * @license MIT (See LICENSE file)
 */

function sendAndReceive() : \Generator
{
	$ret = yield 'yield1';
	var_dump( $ret );
	$ret = yield 'yield2';
	var_dump( $ret );
}

$gen = sendAndReceive();
var_dump( $gen->current() );
var_dump( $gen->send( 'ret1' ) );
var_dump( $gen->send( 'ret2' ) );
