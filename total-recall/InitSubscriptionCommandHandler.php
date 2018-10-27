<?php declare(strict_types=1);

final class InitSubscriptionCommandHandler
{
	/** @var SubscriptionRepository */
	private $repository;

	public function __construct( SubscriptionRepository $repository )
	{
		$this->repository = $repository;
	}

	public function handle( InitSubscriptionCommand $command ) : InitSubscriptionResult
	{
		try
		{
			$subscription = Subscription::fromIdFullNameAndEmail(
				SubscriptionId::generate(),
				$command->getFullName(),
				$command->getEmail()
			);

			$this->repository->add( $subscription );

			return InitSubscriptionResult::withSubscription( $subscription );
		}
		catch ( Throwable $e )
		{
			return InitSubscriptionResult::withErrorMessage( $e->getMessage() );
		}
	}
}