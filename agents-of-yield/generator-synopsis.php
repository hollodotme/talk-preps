<?php declare(strict_types=1);

interface Traversable
{
	# Marker interface, cannot be implemented directly
}

interface Iterator extends Traversable
{
	public function rewind() : void;

	public function key();

	public function current();

	public function next() : void;

	public function valid() : bool;
}

interface Generator extends Iterator
{
	public function getReturn();

	public function send( $value ) : void;

	public function throw( Throwable $throwable ) : void;

	public function __wakeup() : void;
}