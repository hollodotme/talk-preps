<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

$pattern = '/^(what)(\s+i)?(s)\s+(new)\s+(in)\s+(php72)$/';
$string  = 'whats new in php72';

preg_match( $pattern, $string, $matches );
var_export($matches);

preg_match( $pattern, $string, $matches, PREG_UNMATCHED_AS_NULL );
var_export($matches);
