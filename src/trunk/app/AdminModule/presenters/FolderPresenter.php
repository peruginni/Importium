<?php

namespace AdminModule;

use Nette;
use Nette\Application\AppForm;
use Nette\Forms\Form;
use Om\Multimedia\IFolderBusiness;
use Om\Multimedia\IFileBusiness;
use Om\Multimedia\Folder;


class FolderPresenter extends AdminPresenter
{

	/** @var IFolderBusiness */
	protected $folderBusiness;

	/** @var IFileBusiness */
	protected $fileBusiness;



	/**
	 * Construct and inject business object
	 */
	public function __construct()
	{
		parent::__construct();

		$this->folderBusiness = $this->getBusiness('Om\Multimedia\IFolderBusiness');
		$this->fileBusiness = $this->getBusiness('Om\Multimedia\IFileBusiness');
	}



	/**
	 * Redirect to list
	 */
	public function actionDefault()
	{
		$this->redirect('list');
	}



	/**
	 * List folders
	 */
	public function actionList()
	{
		$paginator = $this->createPaginator();

		$folders = $this->folderBusiness->findAll($paginator);

		$this->template->folders = $folders;
		$this->template->paginator = $paginator;
	}



	/**
	 * Show content of folder. Will show files.
	 */
	public function actionShow($id)
	{
		$paginator = $this->createPaginator();

		$folder = $this->folderBusiness->findById($id);
		$files = $this->fileBusiness->findFilesByFolder($folder, $paginator);

		$this->template->folder = $folder;
		$this->template->files = $files;
		$this->template->paginator = $paginator;
	}



	public function actionAdd()
	{

	}



	public function actionEdit($id)
	{
		// existence of id checked in form
	}



	public function actionRemove($id)
	{
		$folder = $this->folderBusiness->findById($id);
		if(!$folder) {
			$this->flashMessage('Invalid folder id', 'error');
		} else {
			$this->folderBusiness->remove($folder);
			$this->flashMessage('Folder was removed');
		}
		$this->redirect('list');
	}


	/**
	 *
	 *  Form factories
	 *
	 */

	/**
	 * Add form factory
	 */
	protected function createComponentAddForm()
	{
		$form = new AppForm;
		$form->addText('title', 'Title:')
		     ->addRule(Form::FILLED, 'Please, provide a title.');

		$form->addTextArea('description', 'Description:');

		$form->addSubmit('add', 'Add');

		$form->onSubmit[] = callback($this, 'addForm_submit');

		return $form;
	}

	public function addForm_submit(AppForm $form)
	{
		try {
			$folder = new Folder();
			$folder->setTitle($form['title']->getValue());
			$folder->setDescription($form['description']->getValue());

			$this->folderBusiness->persist($folder);
			
			$this->flashMessage('New folder was created');
			$this->redirect('default');

		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}



	/**
	 * Edit form factory
	 */
	protected function createComponentEditForm()
	{
		$folder = $this->folderBusiness->findById($this->getParam('id'));
		if(!$folder) {
			$this->flashMessage('Invalid folder id', 'error');
			return null;
		}

		$form = new AppForm;
		$form->addText('title', 'Title:')
		     ->setDefaultValue($folder->getTitle())
		     ->addRule(Form::FILLED, 'Please, provide a title.');

		$form->addTextArea('description', 'Description:')
		     ->setDefaultValue($folder->getDescription());

		$form->addSubmit('edit', 'Save changes');

		$form->onSubmit[] = callback($this, 'editForm_submit');
		
		return $form;
	}

	public function editForm_submit(AppForm $form)
	{
		try {
			$folder = $this->folderBusiness->findById($this->getParam('id'));
			$folder->setTitle($form['title']->getValue());
			$folder->setDescription($form['description']->getValue());

			$this->folderBusiness->persist($folder);

			$this->flashMessage('Folder was changed');
			$this->redirect('default');

		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


}
