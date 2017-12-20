<?php declare(strict_types=1);
/**
 * @author h.woltersdorf
 */

function test()
{
	$a = 1;

	return 0;
}

function foo( string $s1, string $s2, string $s3, string $s4 )
{
	$x = ($s1 . $s2) . ($s3 . $s4);
	$x = 0;

	return $x;
}

$cc = 'no';

switch ( $cc )
{
	case 'de':
		echo 'Deutsch';
		break;
	case 'en':
		echo 'English';
		break;
	case 'nl':
		echo 'Nederlands';
		break;
	case 'no':
		echo 'Norsk';
		break;
	default:
		echo 'unknown';
		break;
}

if ( $cc === 'de' )
{
	echo 'Deutsch';
}
else
{
	if ( $cc === 'en' )
	{
		echo 'English';
	}
	else
	{
		if ( $cc === 'nl' )
		{
			echo 'Nederlands';
		}
		else
		{
			if ( $cc === 'no' )
			{
				echo 'Norsk';
			}
			else
			{
				echo 'unknown';
			}
		}
	}
}

$table = [ 'de' => 1, 'en' => 2, 'nl' => 3, 'no' => 4 ];

if ( gettype( $cc ) === 'string' )
{
	if ( array_key_exists( $cc, $table ) )
	{
		goto "jmp_{$table[$cc]}";
	}
	else
	{
		goto jmp_default;
	}
}
else
{
	/* do original if/else if/else sequence */
}
jmp_1: echo "DEUTSCH"; goto end;
jmp_2: echo "English"; goto end;
jmp_3: echo "Nederlands"; goto end;
jmp_4: echo "Norsk"; goto end;
jmp_default: echo "unknown";
end:
