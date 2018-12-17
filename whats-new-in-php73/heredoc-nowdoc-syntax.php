<?php declare(strict_types=1);

$var = 'PHPUGDD';

$heredoc = <<<HERE
	Here I am at $var!
	HERE;

$nowdoc = <<<'NOW'
	And now I am only a $var
	NOW;

echo "$heredoc\n";

echo "$nowdoc\n";

