<?php declare(strict_types=1);

/**
 * @author h.woltersdorf
 */
class Test
{
	public function getClassName()
	{
		return get_class(null);
	}
}

echo (new Test)->getClassName();
