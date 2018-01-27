<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\TalkPreps\AgentsOfYield;

/**
 * @param int $start
 * @param int $limit
 * @param int $step
 *
 * @return \Generator
 */
function xrange( int $start, int $limit, int $step = 1 ) : \Generator
{
	for ( $i = $start; $i <= $limit; $i += $step )
	{
		yield $i;
	}
}
