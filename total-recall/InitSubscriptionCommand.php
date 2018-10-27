<?php declare(strict_types=1);

final class InitSubscriptionCommand
{
	/** @var FullName */
	private $fullName;

	/** @var Email */
	private $email;

	private function __construct( FullName $fullName, Email $email )
	{
		$this->fullName = $fullName;
		$this->email    = $email;
	}

	public static function withFullNameAndEmail( FullName $fullName, Email $email ) : self
	{
		return new self( $fullName, $email );
	}

	public function getFullName() : FullName
	{
		return $this->fullName;
	}

	public function getEmail() : Email
	{
		return $this->email;
	}
}