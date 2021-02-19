<?php

declare(strict_types=1);


namespace MatiCore\Menu\Entity;


use Nette\SmartObject;

class Menu
{

	use SmartObject;

	/**
	 * @var string
	 */
	private string $callName;

	/**
	 * @var string|null
	 */
	private string|null $title;

	/**
	 * @var string|null
	 */
	private string|null $group;

	/**
	 * @var int|null
	 */
	private int|null $position;

	/**
	 * @var array<MenuItem>
	 */
	private array $items;

	/**
	 * @var string|null 
	 */
	private string|null $right;

	/**
	 * Menu constructor.
	 * @param string $callName
	 */
	public function __construct(string $callName)
	{
		$this->callName = $callName;
		$this->items = [];
	}

	/**
	 * @return string|null
	 */
	public function getTitle(): ?string
	{
		return $this->title;
	}

	/**
	 * @param string|null $title
	 */
	public function setTitle(?string $title): void
	{
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getCallName(): string
	{
		return $this->callName;
	}

	/**
	 * @param array<MenuItem> $items
	 */
	public function setItems(array $items): void
	{
		$this->items = $items;
	}

	/**
	 * @param MenuItem $item
	 */
	public function addItem(MenuItem $item): void
	{
		$this->items[] = $item;
	}

	/**
	 * @return array<MenuItem>
	 */
	public function getItems(): array
	{
		return $this->items;
	}

	/**
	 * @return int|null
	 */
	public function getPosition(): ?int
	{
		return $this->position;
	}

	/**
	 * @param int|null $position
	 */
	public function setPosition(?int $position): void
	{
		$this->position = $position;
	}

	/**
	 * @return string|null
	 */
	public function getGroup(): ?string
	{
		return $this->group;
	}

	/**
	 * @param string|null $group
	 */
	public function setGroup(?string $group): void
	{
		$this->group = $group;
	}

	/**
	 * @return string|null
	 */
	public function getRight(): ?string
	{
		return $this->right;
	}

	/**
	 * @param string|null $right
	 */
	public function setRight(?string $right): void
	{
		$this->right = $right;
	}

}