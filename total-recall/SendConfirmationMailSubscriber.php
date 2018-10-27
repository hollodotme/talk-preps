<?php declare(strict_types=1);

final class SendConfirmationMailSubscriber
{
	public function notify( SubscriptionInitialized $message ) : void
	{
		$subscription = $message->getSubscription();

		Email::fromTemplate( 'confirm-subscription' )
		     ->withData( ['subscription' => $subscription] )
		     ->to( $subscription->getEmail() )
		     ->send();
	}
}