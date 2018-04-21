<?php declare(strict_types=1);

use function hollodotme\TalkPreps\AgentsOfYield\xrange;

require 'xrange.func.php';

$generator = xrange( 1, 100 );

count( $generator );

$count = count( iterator_to_array( $generator ) );

echo 'Count: ', $count, PHP_EOL;

$generator->rewind();
$count = 0;
foreach ( $generator as $item )
{
	$count++;
}

echo 'Count: ', $count, PHP_EOL;
