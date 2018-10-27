<?php declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class SubscriptionInitializer implements MiddlewareInterface
{
	/** @var InitSubscriptionCommandHandler */
	private $commandHandler;

	/** @var MessageBrokerInterface */
	private $messageBroker;

	public function __construct( InitSubscriptionCommandHandler $commandHandler, MessageBrokerInterface $publishermessageBroker )
	{
		$this->commandHandler = $commandHandler;
		$this->messageBroker  = $publishermessageBroker;
	}

	public function process( ServerRequestInterface $request, RequestHandlerInterface $handler ) : ResponseInterface
	{
		$command = InitSubscriptionCommand::withFullNameAndEmail(
			FullName::fromString( $request->getParsedBody()['fullName'] ),
			Email::fromString( $request->getParsedBody()['email'] )
		);

		$result = $this->commandHandler->handle( $command );

		$message = SubscriptionInitialized::withSubscription( $result->getSubscription() );
		$this->messageBroker->publish( $message );

		return Redirect::to( '/thanks-' . $result->getSubscription()->getId() . '.html' );
	}
}