<?php

namespace AdminModule;

use Nette;
use Nette\Application\AppForm;
use Nette\Forms\Form;
use Om\Multimedia\IFolderBusiness;
use Om\Multimedia\IFileBusiness;
use Om\Multimedia\Folder;
use Om\Multimedia\File;



class FilePresenter extends AdminPresenter
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
	 * List files
	 */
	public function actionList()
	{
		$paginator = $this->createPaginator();

		$files = $this->fileBusiness->findAll($paginator);

		$this->template->files = $files;
		$this->template->paginator = $paginator;
	}



	/**
	 * Add file
	 */
	public function actionAdd()
	{

	}



	/**
	 * Edit file
	 */
	public function actionEdit($id)
	{
		// existence of id checked in form
	}



	/**
	 * Remove file
	 */
	public function actionRemove($id)
	{
		$file = $this->fileBusiness->findById($id);
		if(!$file) {
			$this->flashMessage('Invalid file id', 'error');
		} else {
			$this->fileBusiness->remove($file);
			$this->flashMessage('File was removed');
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
		$folderEntities = $this->folderBusiness->findAll();
		$folders = array();
		foreach($folderEntities as $folder) {
			$folders[$folder->getId()] = $folder->getTitle();
		}

		$form = new AppForm;
		$form->addText('title', 'Title:')
		     ->addRule(Form::FILLED, 'Please, provide a title.');

		$form->addFile('file', 'File:')
		     ->addRule(Form::FILLED, 'Please, provide a file.');
//		     ->addCondition(Form::FILLED)
//		     ->addRule(Form::MAX_FILE_SIZE, 'File size must not exceed 20MB', '20000');

		$form->addSelect('folder', 'Folder:', $folders)
		     ->addRule(Form::FILLED, 'Please, provide a folder.');

		$form->addSubmit('add', 'Add');

		$form->onSubmit[] = callback($this, 'addForm_submit');

		return $form;
	}

	public function addForm_submit(AppForm $form)
	{
		try {
			$file = new File();
			$file->setTitle($form['title']->getValue());

			$folder = $this->folderBusiness->findById($form['folder']->getValue());
			$file->setFolder($folder);

			$this->fileBusiness->upload($file, $form['file']->getValue());

			$this->flashMessage('New file was uploaded');
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
		$folderEntities = $this->folderBusiness->findAll();
		$folders = array();
		foreach($folderEntities as $folder) {
			$folders[$folder->getId()] = $folder->getTitle();
		}

		$file = $this->fileBusiness->findById($this->getParam('id'));
		if(!$file) {
			$this->flashMessage('Invalid file id', 'error');
			return null;
		}

		$form = new AppForm;
		$form->addText('title', 'Title:')
		     ->setDefaultValue($file->getTitle())
		     ->addRule(Form::FILLED, 'Please, provide a title.');

		$form->addSelect('folder', 'Folder:', $folders)
		     ->addRule(Form::FILLED, 'Please, provide a folder.');

		$form->addSubmit('edit', 'Save changes');

		$form->onSubmit[] = callback($this, 'editForm_submit');

		return $form;
	}

	public function editForm_submit(AppForm $form)
	{
		try {
			$file = $this->fileBusiness->findById($this->getParam('id'));

			$file->setTitle($form['title']->getValue());

			$folder = $this->folderBusiness->findById($form['folder']->getValue());
			$file->setFolder($folder);

			$this->fileBusiness->persist($folder);

			$this->flashMessage('File was changed');
			$this->redirect('default');

		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}
	
}
