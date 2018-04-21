<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\TalkPreps\AgentsOfYield;

function generate()
{
	print 'generate - start' . PHP_EOL;
	for ( $i = 1; $i <= 5; $i++ )
	{
		print 'generate - yielding...' . PHP_EOL;
		yield $i;
		print 'generate - continued' . PHP_EOL;
	}
	print 'generate - end' . PHP_EOL;
}

$generator = generate();
print 'Generator created' . PHP_EOL;

while ( $generator->valid() )
{
	print 'Loop gets current value' . PHP_EOL;
	print $generator->current() . PHP_EOL;
	$generator->next();
}

echo PHP_EOL;
echo PHP_EOL;
