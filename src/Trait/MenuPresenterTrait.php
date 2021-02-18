<?php

declare(strict_types=1);

namespace MatiCore\Menu;

use MatiCore\Menu\Entity\Menu;

/**
 * Trait MenuPresenterTrait
 * @package MatiCore\Menu
 */
trait MenuPresenterTrait
{

	/**
	 * @var MenuManager
	 * @inject
	 */
	public $menuManager;

	/**
	 * @param string $menuName
	 * @return Menu
	 */
	public function getMenu(string $menuName): Menu
	{
		return $this->menuManager->getMenu($menuName);
	}

	/**
	 * @param string $menuGroupName
	 * @return array<Menu>
	 */
	public function getMenuListByGroup(string $menuGroupName): array
	{
		return $this->menuManager->getMenusByGroup($menuGroupName);
	}

}