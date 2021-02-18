<?php

declare(strict_types=1);


namespace MatiCore\Menu\Entity;


use MatiCore\Menu\IMenuBadge;
use Nette\SmartObject;

/**
 * Class BaseMenuBadge
 * @package MatiCore\Menu\Entity
 */
class MenuBadge implements IMenuBadge
{

	use SmartObject;

	public const TYPE_INFO = 'badge-info';
	public const TYPE_SUCCESS = 'badge-success';
	public const TYPE_WARNING = 'badge-warning';
	public const TYPE_DANGER = 'badge-danger';
	public const TYPE_PRIMARY = 'badge-primary';
	public const TYPE_SECONDARY = 'badge-secondary';

	/**
	 * @var string
	 */
	private string $value;

	/**
	 * @var string
	 */
	private string $color;

	/**
	 * BaseMenuBadge constructor.
	 * @param string $value
	 * @param string $color
	 */
	public function __construct(string $value, string $color)
	{
		$this->value = $value;
		$this->color = $color;
	}

	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}

	/**
	 * @return string
	 */
	public function getColor(): string
	{
		return $this->color;
	}

}