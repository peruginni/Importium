<?php

use Nette\Debug;
use Nette\Application\BadRequestException;
use Nette\Security\AuthenticationException;

class ErrorPresenter extends BasePresenter
{

	/**
	 * @param  Exception
	 * @return void
	 */
	public function renderDefault($exception)
	{
		if ($this->isAjax()) { // AJAX request? Just note this error in payload.
			$this->payload->error = TRUE;
            $this->terminate();

        } elseif ($exception instanceof AuthenticationException) {
			$this->setView('Authentication');

		} elseif ($exception instanceof BadRequestException) {
			$this->setView('404');

		} else {
			$this->setView('500'); 
			Debug::processException($exception); // and handle error by Nette\Debug

            throw $exception; // TODO remove in deploy
		}
	}
    
}
