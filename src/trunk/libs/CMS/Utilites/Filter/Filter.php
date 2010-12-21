<?php

namespace CMS\Utilities;

use Doctrine\ORM\Query\Expr;


/**
 * Filter
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class Filter implements IFilter
{
	/** @var object */
	protected $expression = null;

	/** @var array */
	protected $parameters = array();



	public function __construct($expression, $parameters)
	{
		$this->expression = $expression;

		if(is_array($parameters)) {
			$this->parameters = $parameters;
		} else {
			$this->parameters = array(1 => $parameters);
		}
	}

	/** @return object */
	public function getExpression()
	{
		return $this->expression;
	}

	public function setExpression($expression)
	{
		$this->expression= $expression;
	}

	/** @return array */
	public function getParameters()
	{
		return $this->parameters;
	}

	public function setParameters(array $parameters)
	{
		$this->parameters= $parameters;
	}

	public function addParameter($index, $value)
	{
		$this->parameters[$index] = $value;
	}

	public function removeParameter($index)
	{
		unset($this->parameters[$index]);
	}

}
