<?php

declare(strict_types=1);


namespace MatiCore\Menu;


/**
 * Class MenuException
 * @package MatiCore\Menu
 */
class MenuException extends \Exception
{

	/**
	 * @param string $callName
	 * @throws MenuException
	 */
	public static function NotExists(string $callName): void
	{
		throw new self('Menu callname: ' . $callName . ' does\'t exists.');
	}

}