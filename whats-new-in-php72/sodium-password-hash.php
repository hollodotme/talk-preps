<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

$password = 'password';

// hash the password and return an ASCII string suitable for storage
$hashStr = sodium_crypto_pwhash_str(
	$password,
	SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
	SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
);

echo $hashStr, "\n";

if ( sodium_crypto_pwhash_str_verify( $hashStr, $password ) )
{
	echo "Verification: Password is valid.\n";
}
else
{
	echo "Verification: Password is valid.\n";
}

sodium_memzero( $password ); # wipe the plaintext password from memory

/**
 * @param string $password
 *
 * @return string
 * @throws \Exception
 */
function deriveKeyFromUserPassword( string $password, string $salt ) : string
{
	$outLength = SODIUM_CRYPTO_SIGN_SEEDBYTES;
	$seed      = sodium_crypto_pwhash(
		$outLength,
		$password,
		$salt,
		SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
		SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
	);

	return $seed;
}

/**
 * @param string $plainText
 * @param string $password
 *
 * @return string
 * @throws \Exception
 */
function encrypt( string $plainText, string $password ) : string
{
	$salt = random_bytes( SODIUM_CRYPTO_PWHASH_SALTBYTES );
	$key  = deriveKeyFromUserPassword( $password, $salt );

	$nonce      = random_bytes( SODIUM_CRYPTO_SECRETBOX_NONCEBYTES );
	$cipherText = sodium_crypto_secretbox( $plainText, $nonce, $key );

	return $salt . $nonce . $cipherText;
}

/**
 * @param string $cipherText
 * @param string $password
 *
 * @return string
 * @throws \Exception
 * @throws \InvalidArgumentException
 */
function decrypt( string $cipherText, string $password ) : string
{
	$salt          = substr(
		$cipherText,
		0,
		SODIUM_CRYPTO_PWHASH_SALTBYTES
	);
	$nonce         = substr(
		$cipherText,
		SODIUM_CRYPTO_PWHASH_SALTBYTES,
		SODIUM_CRYPTO_SECRETBOX_NONCEBYTES
	);
	$encryptedText = substr(
		$cipherText,
		SODIUM_CRYPTO_PWHASH_SALTBYTES
		+ SODIUM_CRYPTO_SECRETBOX_NONCEBYTES
	);

	$key       = deriveKeyFromUserPassword( $password, $salt );
	$plainText = sodium_crypto_secretbox_open(
		$encryptedText,
		$nonce,
		$key
	);

	if ( false === $plainText )
		throw new \InvalidArgumentException( 'Bad cipher text' );

	return $plainText;
}

$password = 'password';
$message   = 'Ho-Ho-Ho';
$encrypted = encrypt( $message, $password );

var_dump( $encrypted );

$decrypted = decrypt( $encrypted, $password );

var_dump( $decrypted );

# Remove plaintext password from memory
sodium_memzero( $password ); # wipe the plaintext password from memory
