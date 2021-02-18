<?php

declare(strict_types=1);


namespace MatiCore\Menu;


/**
 * Interface IMenuBadgeHandler
 * @package MatiCore\Menu
 */
interface IMenuBadgeHandler
{

	/**
	 * @return array<IMenuBadge>
	 */
	public function getBadge(): array;
	
}
