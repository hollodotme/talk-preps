<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\TalkPreps\AgentsOfYield;

require 'range.func.php';
require 'xrange.func.php';

echo 'RANGE:' . PHP_EOL . PHP_EOL;

foreach ( range( 1, 100 ) as $i )
{
	print $i . '.';
}

echo PHP_EOL;
echo PHP_EOL;

echo 'XRANGE:' . PHP_EOL . PHP_EOL;

foreach ( xrange( 1, 100 ) as $i )
{
	print $i . '.';
}

echo PHP_EOL;
echo PHP_EOL;
