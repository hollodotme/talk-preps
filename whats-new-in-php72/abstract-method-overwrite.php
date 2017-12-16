<?php declare(strict_types=1);

/**
 * @author hollodotme
 */
class Lighter { }
class Match { }

interface CandleInterface
{
	public function fireUp( Match $fireSupply );
}

abstract class Candle implements CandleInterface
{
	abstract public function fireUp( Match $fireSupply );
}

final class TableCandle extends Candle
{
	public function fireUp( $fireSupply ) : void
	{
		echo "See the romance?\n";
	}
}

interface CandleCollectionInterface extends CandleInterface
{
	public function fireUp( $fireSupply ) : int;
}

abstract class CandleCollection extends Candle implements CandleCollectionInterface
{
	abstract public function fireUp( $fireSupply ) : int;
}


final class FairyLights extends CandleCollection
{
	public function fireUp( $fireSupply ) : int
	{
		return 42;
	}
}

$tableCandle = new TableCandle();
$tableCandle->fireUp( new Match() );

$fairyLights = new FairyLights();
$firedUp     = $fairyLights->fireUp( new Lighter() );
printf( 'Our tree has %d burning candles.', $firedUp );
