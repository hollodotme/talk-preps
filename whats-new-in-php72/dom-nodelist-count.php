<?php declare(strict_types=1);
/**
 * @author hollodotme
 */

$xml = <<<EOT
<PHP>
	<WHAT>
		<IS/>
		<NEW/>
	</WHAT>
	<WHAT>
		<IN/>
		<PHP72/>
	</WHAT>
</PHP>
EOT;

$dom = new \DOMDocument( '1.0', 'UTF-8' );
$dom->loadXML( $xml );
$nodeList = $dom->getElementsByTagName( 'WHAT' );

var_dump( $nodeList->count() );
var_dump( $nodeList instanceof Countable );

# Prints

$xml = <<<EOT
<PHP>
	<WHAT is="new" in="php72">
		<IS/>
		<NEW/>
	</WHAT>
	<WHAT>
		<IN/>
		<PHP72/>
	</WHAT>
</PHP>
EOT;

$dom = new \DOMDocument( '1.0', 'UTF-8' );
$dom->loadXML( $xml );
$namedNodeMap = $dom->getElementsByTagName( 'WHAT' )->item(0);

var_dump( $namedNodeMap->attributes->count() );
var_dump( $namedNodeMap->attributes instanceof Countable );

# Prints
