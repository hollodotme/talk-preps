<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

$string = "\xf8\xa1\xa1\xa1\xa1-A-valid-string";

var_dump( json_encode( $string, JSON_INVALID_UTF8_IGNORE ) );
var_dump( json_encode( $string, JSON_INVALID_UTF8_SUBSTITUTE ) );

# Prints
