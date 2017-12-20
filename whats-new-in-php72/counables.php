<?php declare(strict_types=1);
/**
 * @author h.woltersdorf
 */

var_dump(
	count( 1 ),          # integers are not countable
	count( 'abc' ),      # strings are not countable
	count( new stdClass() ), # objects not implementing the Countable interface are not countable
	count( [ 1, 2 ] )        # arrays are countable
);

# Prints

# PHP < 7.2


