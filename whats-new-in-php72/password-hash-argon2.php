<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

$options = [
	// number of KiB that should be consumed
	// (default values are 1<<10, or 1024 KiB, or 1 MiB)
	'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
	// number of iterations of the hashing algorithm
	// (defaults to 2)
	'time_cost'   => PASSWORD_ARGON2_DEFAULT_TIME_COST,
	// number of parallel threads that will be used
	// (defaults to 2)
	'threads'     => PASSWORD_ARGON2_DEFAULT_THREADS,
];

echo password_hash( 'password', PASSWORD_ARGON2I, $options );
