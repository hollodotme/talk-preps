<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

namespace hollodotme\TalkPreps\AgentsOfYield;

class ApiClient
{
	/**
	 * @var array[][]
	 */
	private static $pages = [
		'Page 1' => [
			'Users'     => ['Anton', 'Baltasar', 'Cesar'],
			'Next page' => 'Page 2',
		],

		'Page 2' => [
			'Users'     => ['Dominique', 'Emilio', 'Franko'],
			'Next page' => 'Page 3',
		],

		'Page 3' => [
			'Users'     => ['Gustavo', 'Holger', 'Inge'],
			'Next page' => 'Page 4',
		],

		'Page 4' => [
			'Users'     => ['Julius', 'Kent', 'Lucifer'],
			'Next page' => null,
		],
	];

	public function getAllUsers() : \Iterator
	{
		$page = 'Page 1';

		do
		{
			foreach ( self::$pages[ $page ]['Users'] as $user )
			{
				yield $user;
			}

			$page = self::$pages[ $page ]['Next page'];
		}
		while ( null !== $page );
	}
}

$apiClient = new ApiClient();
foreach ( $apiClient->getAllUsers() as $user )
{
	echo $user . '.';
}

echo PHP_EOL;
echo PHP_EOL;
