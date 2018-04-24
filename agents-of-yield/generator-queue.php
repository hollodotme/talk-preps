<?php declare(strict_types=1);

namespace hollodotme\TalkPreps\AgentsOfYield;

use Generator;
use PDO;
use const PHP_EOL;

function queue( PDO $pdo ) : Generator
{
	$pdo->query( 'CREATE TABLE queue (message TEXT)' );
	$statement = $pdo->prepare(
		'INSERT INTO queue (message) VALUES (:message)'
	);
	$counter   = 0;
	while ( true )
	{
		$message = yield $counter++;
		$statement->execute( ['message' => $message] );
		print 'Sent: ' . $message;
	}
}

$queue = queue( new PDO( 'sqlite::memory:' ) );
print 'Hidden first value: ' . $queue->current() . PHP_EOL;
$queue->send( 'Foo' );
print ' (' . $queue->current() . ')' . PHP_EOL;
$queue->send( 'Bar' );
print ' (' . $queue->current() . ')' . PHP_EOL;
