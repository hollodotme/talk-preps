<?php declare(strict_types=1);
/**
 * @author h.woltersdorf
 */

# array to object
$arr = [ 0 => 1 ];
$obj = (object)$arr;
var_dump(
	$obj,
	$obj->{'0'},    # now accessible
	$obj->{0}       # now accessible
);

# Prints

# object to array
$obj = new class
{
	public function __construct()
	{
		$this->{0} = 1;
	}
};

$arr = (array)$obj;
var_dump(
	$arr,
	$arr[0],        # now accessible
	$arr['0']       # now accessible
);

# Prints

