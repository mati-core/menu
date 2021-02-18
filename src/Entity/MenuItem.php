<?php

declare(strict_types=1);


namespace MatiCore\Menu\Entity;


use MatiCore\Menu\IMenuBadgeHandler;
use Nette\SmartObject;

/**
 * Class MenuItem
 * @package MatiCore\Menu\Entity
 */
class MenuItem
{

	use SmartObject;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string|null
	 */
	private $route;

	/**
	 * @var string|null
	 */
	private $icon;

	/**
	 * @var int|null
	 */
	private $position;

	/**
	 * @var IMenuBadgeHandler|null
	 */
	private $badgeHandler;

	/**
	 * @var string[]
	 */
	private $roles;

	/**
	 * @var string[]
	 */
	private $rights;

	/**
	 * @var MenuItem[]
	 */
	private $children;

	/**
	 * MenuItem constructor.
	 * @param string $title
	 */
	public function __construct(string $title)
	{
		$this->title = $title;
		$this->roles = [];
		$this->rights = [];
		$this->children = [];
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle(string $title): void
	{
		$this->title = $title;
	}

	/**
	 * @return string|null
	 */
	public function getRoute(): ?string
	{
		return $this->route;
	}

	/**
	 * @param string|null $route
	 */
	public function setRoute(?string $route): void
	{
		$this->route = $route;
	}

	/**
	 * @return string|null
	 */
	public function getIcon(): ?string
	{
		return $this->icon;
	}

	/**
	 * @param string|null $icon
	 */
	public function setIcon(?string $icon): void
	{
		$this->icon = $icon;
	}

	/**
	 * @return string|null
	 */
	public function getPosition(): ?int
	{
		return $this->position;
	}

	/**
	 * @param string|null $position
	 */
	public function setPosition(?int $position): void
	{
		$this->position = $position;
	}

	/**
	 * @return IMenuBadgeHandler|null
	 */
	public function getBadgeHandler(): ?IMenuBadgeHandler
	{
		return $this->badgeHandler;
	}

	/**
	 * @param IMenuBadgeHandler|null $badgeHandler
	 */
	public function setBadgeHandler(?IMenuBadgeHandler $badgeHandler): void
	{
		$this->badgeHandler = $badgeHandler;
	}

	/**
	 * @return string[]
	 */
	public function getRoles(): array
	{
		return $this->roles;
	}

	/**
	 * @param string[] $roles
	 */
	public function setRoles(array $roles): void
	{
		$this->roles = $roles;
	}

	/**
	 * @param string $role
	 */
	public function addRole(string $role): void
	{
		$this->roles[] = $role;
	}

	/**
	 * @return string|null
	 */
	public function getRight(): ?string
	{
		return $this->rights[0] ?? null;
	}

	/**
	 * @param string[] $rights
	 */
	public function setRights(array $rights): void
	{
		$this->rights = $rights;
	}

	/**
	 * @param string $right
	 */
	public function addRight(string $right): void
	{
		$this->rights[] = $right;
	}

	/**
	 * @return MenuItem[]
	 */
	public function getChildren(): array
	{
		return $this->children;
	}

	/**
	 * @param MenuItem[] $children
	 */
	public function setChildren(array $children): void
	{
		$this->children = $children;
	}

	/**
	 * @param MenuItem $item
	 */
	public function addChildren(MenuItem $item): void
	{
		$this->children[] = $item;
	}

	/**
	 * @return bool
	 */
	public function hasChildren(): bool
	{
		return count($this->children) > 0;
	}

}
