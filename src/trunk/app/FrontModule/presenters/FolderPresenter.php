<?php

namespace FrontModule;

use Nette;
use Om\Utilities\Paginator;

/**
 * Folder presenter in front module is responsible mainly for displaying
 * folders stored in system.
 */
class FolderPresenter extends \BasePresenter
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
		$paginator->setResultsPerPage(2);

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

}
