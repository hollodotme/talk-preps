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
 * @return array
 */
function range( int $start, int $limit, int $step = 1 ) : array
{
	$elements = [];

	for ( $i = $start; $i <= $limit; $i += $step )
	{
		$elements[] = $i;
	}

	return $elements;
}
