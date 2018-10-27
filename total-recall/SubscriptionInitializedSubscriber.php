<?php declare(strict_types=1);

final class SubscriptionInitializedSubscriber
{
	public function notify( SubscriptionInitialized $message ) : void
	{
		$subscription = $message->getSubscription();

		Page::fromTemplate( 'thanks' )
		    ->withData( ['subscription' => $subscription] )
		    ->saveAsHtml( '/thanks-' . $subscription->getId() . '.html' );
	}
}