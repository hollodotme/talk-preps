<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\TalkPreps\AgentsOfYield;

require 'xrange.func.php';

$generator = xrange( 1, 100 );

echo 'XRANGE:' . PHP_EOL . PHP_EOL;

while ( $generator->valid() )
{
	echo $generator->current() . '.';

	$generator->next();
}

echo PHP_EOL;
echo PHP_EOL;
