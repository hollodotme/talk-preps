<?php declare(strict_types=1);

/**
 * @link https://nikic.github.io/2012/12/22/Cooperative-multitasking-using-coroutines-in-PHP.html
 */
final class Agent
{
	private $name, $coroutine, $sendValue;
	private                    $beforeFirstYield = true;

	public function __construct( string $name, Generator $coroutine )
	{
		$this->name      = $name;
		$this->coroutine = $coroutine;
	}

	public function getName() : string
	{
		return $this->name;
	}

	public function setSendValue( $sendValue ) : void
	{
		$this->sendValue = $sendValue;
	}

	public function fight()
	{
		if ( $this->beforeFirstYield )
		{
			$this->beforeFirstYield = false;

			return $this->coroutine->current();
		}

		$retval          = $this->coroutine->send( $this->sendValue );
		$this->sendValue = null;

		return $retval;
	}

	public function outOfMunitions() : bool
	{
		return !$this->coroutine->valid();
	}
}

final class TheFramework
{
	private $backup, $agents = [];

	public function __construct()
	{
		$this->backup = new SplQueue();
	}

	public function newAgent( string $agentName, Generator $coroutine ) : void
	{
		$agent = new Agent( $agentName, $coroutine );

		$this->agents[ $agentName ] = $agent;
		$this->sendToBattle( $agent );
	}

	public function sendToBattle( Agent $task ) : void
	{
		$this->backup->enqueue( $task );
	}

	public function fight() : void
	{
		while ( !$this->backup->isEmpty() )
		{
			$agent  = $this->backup->dequeue();
			$retval = $agent->fight();

			if ( $retval instanceof SystemCall )
			{
				$retval( $agent, $this );
				continue;
			}

			if ( $agent->outOfMunitions() )
			{
				unset( $this->agents[ $agent->getName() ] );
				continue;
			}

			$this->sendToBattle( $agent );
		}
	}
}

final class SystemCall
{
	private $callback;

	public function __construct( callable $callback )
	{
		$this->callback = $callback;
	}

	public function __invoke( Agent $agent, TheFramework $battleGround )
	{
		$callback = $this->callback;

		return $callback( $agent, $battleGround );
	}
}

function getAgentName()
{
	return new SystemCall(
		function ( Agent $agent, TheFramework $battleGround )
		{
			$agent->setSendValue( $agent->getName() );
			$battleGround->sendToBattle( $agent );
		}
	);
}

function agent( $max )
{
	$agentName = yield getAgentName();

	for ( $i = 1; $i <= $max; ++$i )
	{
		print "Agent {$agentName} fires shot {$i}." . PHP_EOL;
		yield;
	}

	print "Agent {$agentName} is out of munitions." . PHP_EOL;
}

$battleGround = new TheFramework();

$battleGround->newAgent( 'Coulson', agent( 12 ) );
$battleGround->newAgent( 'Mack', agent( 5 ) );

$battleGround->fight();

print 'Game Over' . PHP_EOL;
