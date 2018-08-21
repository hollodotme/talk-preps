<?php declare(strict_types=1);

function gen() : Generator
{
	while ( true )
	{
		try
		{
			echo "\n", yield;
		}
		catch ( LogicException $e )
		{
			echo 'Exception: ' . $e->getMessage();
		}
		catch ( RuntimeException $e )
		{
			echo 'Stopping coroutine.';
			break;
		}
	}
}

$generator = gen();
$generator->send( 'Hello ' );
$generator->throw( new LogicException( 'Raised inside the generator.' ) );
$generator->send( 'World' );
$generator->throw( new RuntimeException( 'Raised inside the generator.' ) );
$generator->send( 'of tomorrow' );

