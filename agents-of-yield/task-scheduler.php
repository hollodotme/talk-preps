<?php declare(strict_types=1);

/**
 * @author  hollodotme
 * @license MIT (See LICENSE file)
 * @link    https://nikic.github.io/2012/12/22/Cooperative-multitasking-using-coroutines-in-PHP.html
 */
final class Task
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

final class Scheduler
{
	private $maxTaskId = 0;
	private $taskMap   = []; // taskId => task
	private $taskQueue;

	public function __construct()
	{
		$this->taskQueue = new SplQueue();
	}

	public function newTask( Generator $coroutine ) : int
	{
		$tid                   = ++$this->maxTaskId;
		$task                  = new Task( $tid, $coroutine );
		$this->taskMap[ $tid ] = $task;
		$this->schedule( $task );

		return $tid;
	}

	public function schedule( Task $task ) : void
	{
		$this->taskQueue->enqueue( $task );
	}

	public function run() : void
	{
		while ( !$this->taskQueue->isEmpty() )
		{
			$task   = $this->taskQueue->dequeue();
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

	public function __invoke( Task $task, Scheduler $scheduler )
	{
		$callback = $this->callback; // Can't call it directly in PHP :/

		return $callback( $task, $scheduler );
	}
}

function getTaskId()
{
	return new SystemCall(
		function ( Task $task, Scheduler $scheduler )
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

$scheduler = new Scheduler();

$scheduler->newTask( task( 10 ) );
$scheduler->newTask( task( 5 ) );

$scheduler->run();
