<?php

use Nette\Application\Presenter;
use Nette\Environment;
use Om\Utilities\Paginator;

/**
 * Base presenter with functionality common to all his descendants
 * 
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
abstract class BasePresenter extends Presenter
{

	public function  __construct()
	{
		parent::__construct();
	}



	/**
	 * Retrieve business object from Nette's service repository
	 */
	public function getBusiness($businessInterfaceName)
	{
		return Environment::getService($businessInterfaceName);
	}



	/**
	 * Create new paginator. If possible fill it with current page number.
	 * 
	 * @return Paginator
	 */
	public function createPaginator()
	{
		$paginator = new Paginator();
		$params = $this->getRequest()->getParams();
		if(isset($params['page'])) {
			$paginator->setCurrentPage($params['page']);
		}
		
		return $paginator;
	}



	/**
	 * Before render setup
	 */
	public function beforeRender()
	{
		parent::beforeRender();

		$template = $this->getTemplate();
		$template->registerHelper('date', function($datetime) {
			if($datetime) {
				$datetime = $datetime->format('j. F Y H:i:s');
			}
			return $datetime;
 		});
	}
}
