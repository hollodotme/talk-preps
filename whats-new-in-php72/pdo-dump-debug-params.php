<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

$pdo = new \PDO(
	'mysql:host=127.0.0.1;port=3306',
	'root',
	'root',
	[
		\PDO::ATTR_EMULATE_PREPARES => true,
	]
);

$statement = $pdo->prepare(
	'SELECT * FROM mysql.user WHERE user = :user LIMIT 1'
);

$statement->execute( ['user' => 'root'] );

$statement->debugDumpParams();

