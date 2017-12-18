<?php
/**
 * @author hollodotme
 */

# Returns the integer object handle for the given object

$a = new \stdClass();
$b = new class
{
};
$c = function ()
{
};

var_dump( spl_object_id( $a ) );
var_dump( spl_object_id( $b ) );
var_dump( spl_object_id( $c ) );

unset($b);

var_dump( spl_object_id( $a ) );
var_dump( spl_object_id( $b ) );
var_dump( spl_object_id( $c ) );

var_dump( spl_object_id( $a ) );
var_dump( spl_object_id( new \stdClass() ) );
var_dump( spl_object_id( $c ) );

# Prints
