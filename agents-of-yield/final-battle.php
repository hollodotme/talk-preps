<?php declare(strict_types=1);
/**
 * @link https://nikic.github.io/2012/12/22/Cooperative-multitasking-using-coroutines-in-PHP.html
 */

final class Agent
{
	private $taskId;
	private $coroutine;
	private $sendValue;
	private $beforeFirstYield = true;

	public function __construct( $taskId, Generator $coroutine )
	{
		$this->taskId    = $taskId;
		$this->coroutine = $coroutine;
	}

	public function getTaskId()
	{
		return $this->taskId;
	}

	public function setSendValue( $sendValue ) : void
	{
		$this->sendValue = $sendValue;
	}

	public function run()
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

	public function isFinished() : bool
	{
		return !$this->coroutine->valid();
	}
}

final class TheFramework
{
	private $maxTaskId = 0;
	private $taskMap   = []; // taskId => task
	private $backup;

	public function __construct()
	{
		$this->backup = new SplQueue();
	}

	public function newAgent( Generator $coroutine ) : int
	{
		$tid                   = ++$this->maxTaskId;
		$task                  = new Task( $tid, $coroutine );
		$this->taskMap[ $tid ] = $task;
		$this->schedule( $task );

		return $tid;
	}

	public function schedule( Task $task ) : void
	{
		$this->backup->enqueue( $task );
	}

	public function run() : void
	{
		while ( !$this->backup->isEmpty() )
		{
			$task   = $this->backup->dequeue();
			$retval = $task->run();

			if ( $retval instanceof SystemCall )
			{
				$retval( $task, $this );
				continue;
			}

			if ( $task->isFinished() )
			{
				unset( $this->taskMap[ $task->getTaskId() ] );
				continue;
			}

			$this->schedule( $task );
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

	public function __invoke( Task $task, TheFramework $scheduler )
	{
		$callback = $this->callback; // Can't call it directly in PHP :/

		return $callback( $task, $scheduler );
	}
}

function getTaskId()
{
	return new SystemCall(
		function ( Task $task, TheFramework $scheduler )
		{
			$task->setSendValue( $task->getTaskId() );
			$scheduler->schedule( $task );
		}
	);
}

function task( $max )
{
	$tid = yield getTaskId(); // <-- here's the system call!

	for ( $i = 1; $i <= $max; ++$i )
	{
		echo "This is task $tid iteration $i.\n";
		yield;
	}
}

$battleGround = new TheFramework();

$battleGround->newAgent( task( 10 ) );
$battleGround->newAgent( task( 5 ) );

$battleGround->run();
