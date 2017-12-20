<?php declare(strict_types=1);
/**
 * @author h.woltersdorf
 */

$resource = fopen( 'php://memory', 'rb' );

var_dump( gettype( $resource ) );

fclose( $resource );

var_dump( gettype( $resource ) );

# Prints

# PHP < 7.2
