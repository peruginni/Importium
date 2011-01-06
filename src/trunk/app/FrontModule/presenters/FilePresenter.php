<?php

namespace FrontModule;

use Nette;
use Om\Utilities\Paginator;

/**
 * File presenter
 */
class FilePresenter extends \BasePresenter
{
	
	/** @var IFileBusiness */
	protected $fileBusiness;



	/**
	 * Construct and inject business object
	 */
	public function __construct()
	{
		parent::__construct();

		$this->fileBusiness = $this->getBusiness('Om\Multimedia\IFileBusiness');
	}



	/**
	 * Show file information
	 */
	public function actionShow($id)
	{
		$file = $this->fileBusiness->findById($id);
		
		$template = $this->getTemplate();
		$template->fileStoragePath = $template->basePath.'/data';
		$template->file = $file;
	}

}
