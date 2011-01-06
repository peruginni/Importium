<?php

namespace AdminModule;

use Nette;


abstract class AdminPresenter extends \BasePresenter
{

	protected $publicActions = array(
		':Admin:User:login',
		':Admin:User:register',
	);



	public function startup()
	{
		parent::startup();

		if(!in_array($this->getAction(true), $this->publicActions)) {
			if(!$this->getUser()->isLoggedIn()) {
				$this->redirect('User:login');
			}
		}
	}



	public function beforeRender()
	{
		$template = $this->getTemplate();

		if($this->getUser()->isLoggedIn()) {
			$template->loggedUser = $this->getUser();
		}
	}

}
