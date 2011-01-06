<?php

namespace AdminModule;

use Nette;
use Nette\Application\AppForm;
use Nette\Forms\Form;
use Nette\Security\AuthenticationException;
use Om\Users\UserAccount;
use Om\Users\IUserAccountBusiness;


class UserPresenter extends AdminPresenter
{

	/** @var IUserAccountBusiness */
	protected $userAccountBusiness;



	public function  __construct()
	{
		parent::__construct();
		$this->userAccountBusiness = $this->getBusiness('Om\Users\IUserAccountBusiness');
	}



	/**
	 * Default
	 */
	public function actionDefault()
	{
		if($this->getUser()->isLoggedIn()) {
			$id = $this->getUser()->getId();
			$user = $this->userAccountBusiness->findById($id);
			$this->template->user = $user;
		} else {
			$this->redirect('login');
		}
	}



	/**
	 * Log out current user
	 */
	public function actionLogout()
	{
		$this->getUser()->logout();
		$this->redirect('login');
	}



	/**
	 * Log in user
	 */
	public function actionLogin()
	{

	}



	/**
	 * Register user
	 */
	public function actionRegister()
	{

	}



	/**
	 * Settings user
	 */
	public function actionSettings()
	{

	}



	/**
	 *
	 *  Form factories
	 * 
	 */

	/**
	 * Login form factory
	 */
	protected function createComponentLoginForm()
	{
		$form = new AppForm;
		$form->addText('username', 'Username:')
		     ->addRule(Form::FILLED, 'Please, provide a username.');

		$form->addPassword('password', 'Password:')
		     ->addRule(Form::FILLED, 'Please, provide a password.');

		$form->addSubmit('login', 'Login');

		$form->onSubmit[] = callback($this, 'loginForm_submit');
		
		return $form;
	}

	public function loginForm_submit(AppForm $form)
	{
		try {

			$this->getUser()->setExpiration('+ 7 days', FALSE);
			$this->getUser()->login(
				$form['username']->getValue(),
				$form['password']->getValue()
			);

			$this->flashMessage('You were successfully logged in.');
			$this->redirect('default');
			
		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}



	/**
	 * Register form factory
	 */
	protected function createComponentRegisterForm()
	{
		$form = new AppForm;

		$form->addText('username', 'Username:')
		     ->addRule(Form::FILLED, 'Please, provide a username.');

		$form->addPassword('password', 'Password:')
		     ->addRule(Form::FILLED, 'Please, provide a password.');

		$form->addText('email', 'E-mail:')
		     ->addRule(Form::FILLED, 'Please, provide an e-mail.')
		     ->addRule(Form::EMAIL, 'E-mail has incorrect format.');

		$form->addText('realName', 'Real name:')
		     ->addRule(Form::FILLED, 'Please, provide a real name.');


		$form->addSubmit('register', 'Register');

		$form->onSubmit[] = callback($this, 'registerForm_submit');

		return $form;
	}

	public function registerForm_submit(AppForm $form) {
		try {

			$user = new UserAccount();
			$user->setEmail($form['email']->getValue());
			$user->setRealName($form['realName']->getValue());
			$user->setUsername($form['username']->getValue());
			$user->setPassword($form['password']->getValue());

			$this->userAccountBusiness->signUp($user);

			$this->flashMessage("You were registered. Please sign in.");
			$this->forward('login');

		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		} catch (\Om\InvalidArgumentException $e) {
			$form->addError($e->getMessage());
		}
	}



	/**
	 * Settings form factory
	 */
	protected function createComponentSettingsForm()
	{
		$user = $this->userAccountBusiness->findById($this->getUser()->getId());
		
		$form = new AppForm;

		$form->addText('email', 'E-mail:')
		     ->setDefaultValue($user->getEmail())
		     ->addRule(Form::FILLED, 'Please, provide an e-mail.')
		     ->addRule(Form::EMAIL, 'E-mail has incorrect format.');

		$form->addText('realName', 'Real name:')
		     ->setDefaultValue($user->getRealName())
		     ->addRule(Form::FILLED, 'Please, provide a real name.');

		$form->addSubmit('register', 'Change settings');

		$form->onSubmit[] = callback($this, 'settingsForm_submit');

		return $form;
	}

	public function settingsForm_submit(AppForm $form) {
		try {

			$user = $this->userAccountBusiness->findById($this->getUser()->getId());
			$user->setEmail($form['email']->getValue());
			$user->setRealName($form['realName']->getValue());

			$this->userAccountBusiness->saveChanges($user);

			$this->flashMessage("Settings updated.");
			$this->forward('default');

		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		} catch (\Om\InvalidArgumentException $e) {
			$form->addError($e->getMessage());
		}
	}



	/**
	 * Change password form factory
	 */
	protected function createComponentChangePasswordForm()
	{
		$form = new AppForm;

		$form->addPassword('password', 'Password:')
		     ->addRule(Form::FILLED, 'Please, provide a password.');

		$form->addPassword('password2', 'Once again:')
		     ->addRule(Form::FILLED, 'Please, provide a password confirmation.')
		     ->addRule(Form::EQUAL, 'Password and password confirmation do not match.', $form['password']);

		$form->addSubmit('change', 'Change password');

		$form->onSubmit[] = callback($this, 'changePasswordForm_submit');

		return $form;
	}

	public function changePasswordForm_submit(AppForm $form) {
		try {

			$user = $this->userAccountBusiness->findById($this->getUser()->getId());
			$this->userAccountBusiness->changePassword($user, $form['password']->getValue());

			$this->flashMessage("Password changed.");
			$this->forward('default');

		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		} catch (\Om\InvalidArgumentException $e) {
			$form->addError($e->getMessage());
		}
	}


}
