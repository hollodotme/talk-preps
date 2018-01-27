<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\TalkPreps\AgentsOfYield;

function genFunction()
{
	print 'genFunction - start' . PHP_EOL;

	for ( $i = 1; $i <= 5; $i++ )
	{
		print 'genFunction - yielding...' . PHP_EOL;
		yield $i;
		print 'genFunction - continued' . PHP_EOL;
	}

	print 'genFunction - end' . PHP_EOL;
}

$generator = genFunction();

print 'Generator created' . PHP_EOL;

while ( $generator->valid() )
{
	print 'Getting current value from the generator...' . PHP_EOL;
	print $generator->current() . PHP_EOL;

	$generator->next();
}

echo PHP_EOL;
echo PHP_EOL;
