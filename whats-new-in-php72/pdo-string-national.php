<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

$pdo = new \PDO(
	'mysql:host=127.0.0.1;port=3306',
	'root',
	'root',
	[
		\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8;',
	]
);

$statement = $pdo->prepare( "SELECT :umlaut" );
$statement->bindValue(
	'umlaut',
	'äüöÄÜÖ',
	PDO::PARAM_STR | PDO::PARAM_STR_NATL
);
$statement->execute();

$statement->debugDumpParams();

echo "\nResult: " . $statement->fetchColumn();
