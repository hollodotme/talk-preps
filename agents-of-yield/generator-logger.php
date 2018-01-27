<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\TalkPreps\AgentsOfYield;

function logger( string $fileName ) : \Generator
{
	$fileHandle = fopen( $fileName, 'ab' );

	while ( true )
	{
		fwrite( $fileHandle, yield . PHP_EOL );
	}
}

$logger = logger( 'php://stdout' );
$logger->send( 'Foo' );
$logger->send( 'Bar' );
