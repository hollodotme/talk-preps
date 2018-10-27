<?php declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class SubscriptionValidator implements MiddlewareInterface
{
	/** @var ValidatorInterface */
	private $validator;

	/** @var SessionInterface */
	private $session;

	public function __construct( ValidatorInterface $validator, SessionInterface $session )
	{
		$this->validator = $validator;
		$this->session   = $session;
	}

	public function process( ServerRequestInterface $request, RequestHandlerInterface $handler ) : ResponseInterface
	{
		$this->validator->checkUserInput( $request );

		if ( $this->validator->failed() )
		{
			$this->session->addErrors(
				'initSubscription',
				$this->validator->getErrors()
			);

			return Redirect::to( '/subscription-form' );
		}

		return $handler->handle( $request );
	}
}