<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\TalkPreps\AgentsOfYield;

use function memory_get_peak_usage;
use const PHP_EOL;

require 'xrange.func.php';

echo 'XRANGE:' . PHP_EOL . PHP_EOL;

foreach ( xrange( 1, 1000000 ) as $i )
{
	print $i . '.';
}

echo PHP_EOL;
echo round(memory_get_peak_usage( true ) / 1024 / 1024, 2), ' MiB';
echo PHP_EOL;
echo PHP_EOL;
