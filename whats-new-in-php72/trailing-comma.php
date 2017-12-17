<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

# OLD: arrays
$array = [1, 2, 3,];

# NEW: grouped namespaces
use Foo\Bar\
{
	Bar,
	Baz,
	Foo,
};
