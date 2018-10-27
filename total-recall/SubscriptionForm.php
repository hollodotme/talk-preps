<?php declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class SubscriptionForm implements MiddlewareInterface
{
	/** @var SessionInterface */
	private $session;

	public function __construct( SessionInterface $session )
	{
		$this->session = $session;
	}

	public function process( ServerRequestInterface $request, RequestHandlerInterface $handler ) : ResponseInterface
	{
		return Page::fromTemplate( 'subscription-form' )
		           ->withErrors( $this->session->getErrors( 'initSubscription' ) );
	}
}