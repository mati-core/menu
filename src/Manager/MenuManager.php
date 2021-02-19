<?php

declare(strict_types=1);


namespace MatiCore\Menu;


use MatiCore\Menu\Entity\Menu;
use MatiCore\Menu\Entity\MenuItem;
use Nette\Caching\Cache;
use Nette\Caching\IStorage;
use Nette\DI\Container;
use Nette\DI\MissingServiceException;
use Tracy\Debugger;

/**
 * Class MenuManager
 * @package MatiCore\Menu
 */
class MenuManager
{

	/**
	 * @var string[]
	 */
	private $menuConfig;

	/**
	 * @var Menu[]
	 */
	private $menuList;

	/**
	 * @var Container
	 */
	private $container;
	
	/**
	 * MenuManager constructor.
	 * @param array $menuConfig
	 * @param Container $container
	 */
	public function __construct(array $menuConfig, Container $container, IStorage $storage)
	{
		$this->menuConfig = $menuConfig;
		$this->container = $container;
		$this->menuList = [];

		$cache = new Cache($storage, 'menu');
		$cachedMenuList = $cache->load('menuList');

		if($cachedMenuList === null){
			$this->initializeMenu();
			// TODO: implement cache!
			// $cache->save('menuList', $this->menuList);
		}else{
			$this->menuList = $cachedMenuList;
		}
	}

	private function initializeMenu(): void
	{
		foreach ($this->menuConfig as $callName => $menuData) {
			$menu = new Menu($callName);
			$menu->setTitle($menuData['title'] ?? null);
			$menu->setGroup($menuData['group'] ?? null);
			$menu->setPosition($menuData['position'] ?? null);
			$menu->setRight($menuData['right'] ?? null);

			if (isset($menuData['items']) && count($menuData['items']) > 0) {
				foreach ($menuData['items'] as $menuItemData) {
					$menuItem = $this->getMenuItem($menuItemData);
					$menu->addItem($menuItem);
				}

				$items = $menu->getItems();
				$items = $this->sortItems($items);
				$menu->setItems($items);
			}

			$this->menuList[$callName] = $menu;
		}

		usort($this->menuList, function (Menu $menuA, Menu $menuB) {
			$positionA = $menuA->getPosition();
			$positionB = $menuB->getPosition();

			if ($positionA === null && $positionB === null) {
				return strcmp($menuA->getTitle(), $menuB->getTitle());
			}

			if ($positionA !== null && $positionB === null) {
				return -1;
			}

			if ($positionA === null && $positionB !== null) {
				return 1;
			}

			if ($positionA === $positionB) {
				return 0;
			}

			return $positionA < $positionB ? -1 : 1;

		});
	}

	/**
	 * @param array $menuItemData
	 * @return MenuItem
	 */
	private function getMenuItem(array $menuItemData): MenuItem
	{
		$menuItem = new MenuItem($menuItemData['title'] ?? 'Unknown');
		$menuItem->setRoute($menuItemData['route'] ?? null);
		$menuItem->setIcon($menuItemData['icon'] ?? null);
		$menuItem->setPosition($menuItemData['position'] ?? null);

		if (isset($menuItemData['badgeHandler'])) {
			try {
				$handler = $this->container->getService($menuItemData['badgeHandler']);
				$menuItem->setBadgeHandler($handler);
			} catch (MissingServiceException $e) {
				Debugger::log($e);
			}
		}

		if (isset($menuItemData['rights']) && count($menuItemData['rights']) > 0) {
			foreach ($menuItemData['rights'] as $right) {
				$menuItem->addRight($right);
			}
		}

		if (isset($menuItemData['children']) && count($menuItemData['children']) > 0) {
			foreach ($menuItemData['children'] as $childMenuItemData) {
				$childItem = $this->getMenuItem($childMenuItemData);
				$menuItem->addChildren($childItem);
			}

			$items = $menuItem->getChildren();
			$items = $this->sortItems($items);
			$menuItem->setChildren($items);
		}

		return $menuItem;
	}

	/**
	 * @param array $items
	 * @return array
	 */
	private function sortItems(array $items): array
	{
		usort($items, function (MenuItem $itemA, MenuItem $itemB) {
			$positionA = $itemA->getPosition();
			$positionB = $itemB->getPosition();

			if ($positionA === null && $positionB === null) {
				return strcmp($itemA->getTitle(), $itemB->getTitle());
			}

			if ($positionA !== null && $positionB === null) {
				return -1;
			}

			if ($positionA === null && $positionB !== null) {
				return 1;
			}

			if ((int) $positionA === (int) $positionB) {
				return 0;
			}

			return (int) $positionA < (int) $positionB ? -1 : 1;
		});

		return $items;
	}

	/**
	 * @param string $name
	 * @return Menu
	 * @throws MenuException
	 */
	public function getMenu(string $name): Menu
	{
		if (isset($this->menuList[$name])) {
			return $this->menuList[$name];
		}

		MenuException::NotExists();
	}

	/**
	 * @param string $group
	 * @return array<Menu>
	 */
	public function getMenusByGroup(string $group): array
	{
		$menus = [];

		foreach ($this->menuList as $menu) {
			if ($menu->getGroup() === $group) {
				$menus[] = $menu;
			}
		}

		return $menus;
	}


}
