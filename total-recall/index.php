<?php declare(strict_types=1);

$router = Router::withRoutes(
	Route::withMethodUriAndHandler(
		'GET',
		'/subscription-form',
		RequestHandler::withMiddlewares(
			new SubscriptionForm( Session::fromEnv() )
		)
	),
	Route::withMethodUriAndHandler(
		'POST',
		'/init-subscription',
		RequestHandler::withMiddlewares(
			new SubscriptionValidator( InputValidator::new(), Session::fromEnv() ),
			new SubscriptionInitializer(
				InitSubscriptionCommandHandler::new(
					SubscriptionRepository::new(Database::fromConfig())
				),
				MessageBroker::fromConfig()
			)
		)
	)
);

$request = ServerRequest::fromEnv();
Server::withRouter( $router )->handle( $request );