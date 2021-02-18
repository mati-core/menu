<?php

declare(strict_types=1);


namespace MatiCore\Menu;


/**
 * Interface IMenuBadge
 * @package MatiCore\Menu
 */
interface IMenuBadge
{

	/**
	 * @return string
	 */
	public function getValue(): string;

	/**
	 * @return string
	 */
	public function getColor(): string;

}