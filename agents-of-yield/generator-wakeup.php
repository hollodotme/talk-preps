<?php declare(strict_types=1);

function gen() {
	yield 1;
}

$generator = gen();
$generator->__wakeup();