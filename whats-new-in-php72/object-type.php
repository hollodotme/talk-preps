<?php declare(strict_types=1);

dl('redis.so');

/**
 * @author hollodotme
 */
class Child
{
	private $status = 'I am hungry!';

	public function eat() : Child
	{
		echo "K: Mhh nom nom nom\n";

		$this->status = 'I am full up.';

		return $this;
	}

	public function getStatus() : string
	{
		return $this->status;
	}
}

class Baby
{
	private $status = 'I am hungry!';

	public function eat() : string
	{
		echo "B: Mhh nom nom nom\n";

		return 'I want m`00´re...';
	}

	public function getStatus() : string
	{
		return $this->status;
	}
}

class GrandMother
{
	public function howAboutFood( object $child ) : void
	{
		echo "G: What about food?\nB: {$child->getStatus()}\n";
	}

	public function feed( object $child ) : object
	{
		echo "G: I've got some cookies for you!\n";

		return $child->eat();
	}
}

$kiddo  = new Child();
$granny = new GrandMother();

$granny->howAboutFood( $kiddo );

$fatKiddo = $granny->feed( $kiddo );

$granny->howAboutFood( $fatKiddo );

$baby = new Baby();
$granny = new GrandMother();

$granny->howAboutFood( $baby );

$fatBaby = $granny->feed( $baby );

$granny->howAboutFood( $fatBaby );

