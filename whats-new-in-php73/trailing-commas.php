<?php declare(strict_types=1);

function test( string $param1, string $param2 )
{
	echo $param1 . $param2 . "\n";
}

class Test
{
	public function testing( string $param1, string $param2 ) : void
	{
		echo $param1 . $param2 . "\n";
	}
}

test( 'Hello ', 'World', );

(new Test())->testing(
	'Hello ',
	'World',
	);