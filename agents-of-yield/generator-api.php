<?php declare(strict_types=1);

$gen = (function () : Generator
{
	yield 1;
})();

$refClass   = new ReflectionClass( $gen );
$refMethods = $refClass->getMethods();

foreach ( $refMethods as $refMethod )
{
	print $refMethod->getName() . '(';
	foreach ( $refMethod->getParameters() as $parameter )
	{
		print '$' . $parameter->getName();
	}
	print ')' . PHP_EOL;
}