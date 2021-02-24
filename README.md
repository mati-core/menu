# Mati-Core  | MENU

[![Latest Stable Version](https://poser.pugx.org/mati-core/menu/v)](//packagist.org/packages/mati-core/menu)
[![Total Downloads](https://poser.pugx.org/mati-core/menu/downloads)](//packagist.org/packages/mati-core/menu)
![Integrity check](https://github.com/mati-core/menu/workflows/Integrity%20check/badge.svg)
[![Latest Unstable Version](https://poser.pugx.org/mati-core/menu/v/unstable)](//packagist.org/packages/mati-core/menu)
[![License](https://poser.pugx.org/mati-core/menu/license)](//packagist.org/packages/mati-core/menu)

Install
-------

Comoposer command:
```bash
composer require mati-core/menu
```

Setting
-------

```neon
parameters:
	menu:
		menuName:
			group: menu-group-name
			position: 0
			rights:
				- menu-right
			items:
				menuItemName:
					title: itemTitle
					icon: itemIcon
					route: ':Homepage:default'
					position: 0
					badgeHandler: itemBadgeHandler
					rights:
						- item-right
                    items:
                    	menuSubItemName:
                    		title: subItemTitle
                    		...
```

Badge handler
-------------

```php
<?php


class MyBadgeHandler implements IMenuBadgeHandler
{

	/**
	 * @return array|MenuBadge[]
	 */
	public function getBadge(): array
	{
		
		$ret = [];

		$ret[] = new MenuBadge('Success', MenuBadge::TYPE_SUCCESS);
		$ret[] = new MenuBadge('Danger', MenuBadge::TYPE_DANGER);
		$ret[] = new MenuBadge('Info', MenuBadge::TYPE_INFO);
		$ret[] = new MenuBadge('Warning', MenuBadge::TYPE_WARNING);

		return $ret;
	}

}
```