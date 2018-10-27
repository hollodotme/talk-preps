<?php declare(strict_types=1);

final class InitSubscriptionResult
{
	/** @var bool */
	private $succeeded = false;

	/** @var string */
	private $errorMessage = '';

	/** @var Subscription */
	private $subscription;

	public static function withSubscription( Subscription $subscription ) : self
	{
		$result               = new self();
		$result->succeeded    = true;
		$result->subscription = $subscription;

		return $result;
	}

	public static function withErrorMessage( string $errorMessage ) : self
	{
		$result               = new self();
		$result->errorMessage = $errorMessage;

		return $result;
	}
}