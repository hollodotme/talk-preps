<?php declare(strict_types=1);

function genFibunacci( int $loops ) : Generator
{
	$fibunacci = '';
	for ( $i = 0; $i < $loops; $i++ )
	{
		yield $i;
		$fibunacci .= '.' . round( pow( (sqrt( 5 ) + 1) / 2, $i ) / sqrt( 5 ) );
	}
	return ltrim( $fibunacci, '.' );
}

$generator = genFibunacci( 10 );
while ( $generator->valid() )
{
	print $generator->current() . '.';
	$generator->next();
}
print PHP_EOL . 'Fibunacci: ' . $generator->getReturn() . PHP_EOL;
