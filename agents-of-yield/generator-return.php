<?php declare(strict_types=1);

function genFibonacci( int $loops ) : Generator
{
	$fibonacci = '';
	for ( $i = 0; $i < $loops; $i++ )
	{
		yield $i;

		$fibonacci .= round(
			pow( (sqrt( 5 ) + 1) / 2, $i ) / sqrt( 5 )
		);
	}

	return $fibonacci;
}

$generator = genFibonacci( 10 );
while ( $generator->valid() )
{
	print $generator->current();
	$generator->next();
}
print PHP_EOL . 'Fibonacci: ' . $generator->getReturn() . PHP_EOL;
