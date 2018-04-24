<?php declare(strict_types=1);

function gen() : Generator
{
	try
	{
		yield;
	}
	catch ( Exception $e )
	{
		echo 'Exception: ' . $e->getMessage() . PHP_EOL;
	}
}

$gen = gen();
$gen->throw( new Exception( 'Test' ) );