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
			echo $e->getMessage();
			break;
		}
	}
}

$generator = gen();
$generator->send( 'Hello ' );
$generator->throw( new LogicException( 'Raised inside the generator.' ) );
$generator->send( 'World' );
$generator->throw( new RuntimeException( 'Stopping coroutine.' ) );
$generator->send( 'of tomorrow' );

