<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

# Is the stream a file descriptor attached to a terminal?

var_dump( stream_isatty( STDIN ) );
var_dump( stream_isatty( STDOUT ) );
var_dump( stream_isatty( STDERR ) );
var_dump( stream_isatty( fopen( 'php://memory', 'rb' ) ) );
var_dump( stream_isatty( tmpfile() ) );

# Prints
