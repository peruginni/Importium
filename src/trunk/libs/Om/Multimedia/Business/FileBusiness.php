<?php

namespace Om\Multimedia;

use Om\Core\BaseBusiness;
use Om\Utilities\IPaginator;
use Om\Exception;
use Om\Text;
use Nette\Web\HttpUploadedFile;

/**
 * Business class for files
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class FileBusiness extends BaseBusiness implements IFileBusiness
{

	/** @var IFileDao */
	protected $fileDao;

	/** @var string */
	protected $storagePath;

	/** @var int */
	protected $maxFileSize;
	

	/**
	 * Create new instance and initialize required daos
	 */
	public function  __construct()
	{
		$this->setMaxFileSize(10485760); // 10MB

		$this->setStoragePath(\WWW_DIR.'/data');

		// initialize daos
		$this->fileDao = $this->inject('Om\Multimedia\IFileDao');
	}



	/**
	 *
	 *  Implementation of IBaseBusiness
	 *
	 */



	/**
	 * Return default DAO object
	 */
	public function getDefaultDao()
	{
		return $this->fileDao;
	}



	/**
	 * Removes given entity
	 */
	public function remove($entity)
	{
		if(!unlink($this->getStoragePath().'/'.$entity->getFilename().'.'.$entity->getExtension())) {
			throw new \Om\LogicException('Cannot remove');
		}
		parent::remove($entity);
	}




	/**
	 *
	 *  Implementation of IFileBusiness
	 *
	 */


	/**
	 * Get/set storage path, where all files are located
	 */
	public function getStoragePath()
	{
		return $this->storagePath;
	}

	public function setStoragePath($storagePath)
	{
		$this->checkExistenceOfStorage($storagePath);
		$this->storagePath = $storagePath;
	}



	/**
	 * Get/set max file size
	 */
	public function getMaxFileSize()
	{
		return $this->maxFileSize;
	}

	public function setMaxFileSize($maxFileSize)
	{
		$this->maxFileSize = $maxFileSize;
	}



	/**
	 * Get full storage path to file
	 */
	public function getFileFullPath(File $file)
	{
		return $this->getStoragePath().'/'.$file->getBasename();
	}

	

	/**
	 * Handle uploaded file and store it according to information in given
	 * (not yet) stored entity.
	 */
	public function upload(File $file, HttpUploadedFile $httpFile)
	{
		// check existence of uploaded file
		if(!$httpFile || $httpFile->getError() == UPLOAD_ERR_NO_FILE) {
                        throw new UploadException('No file', UPLOAD_ERR_NO_FILE);
                }

		// check other errors
                switch($httpFile->getError()) {
                        case UPLOAD_ERR_OK:
                                if($httpFile->getSize() > $this->getMaxFileSize()) {
                                        throw new UploadException(
						'File size exceeded limit defined in business layer',
						UPLOAD_ERR_FORM_SIZE
					);
                                }
                                break;

			case UPLOAD_ERR_PARTIAL:
				throw new UploadException(
					'File partialy uploaded', 
					UPLOAD_ERR_PARTIAL
				);

                        case UPLOAD_ERR_INI_SIZE:
                                throw new UploadException(
					'File size exceeded limit defined in ini',
					UPLOAD_ERR_INI_SIZE
				);
                                //// Text::bytes(((int)ini_get('upload_max_filesize'))*1024*1024))

                        case UPLOAD_ERR_FORM_SIZE:
                                throw new UploadException(
					'File size exceeded limit defined in form',
					UPLOAD_ERR_FORM_SIZE
				);

                        default:
				throw new UploadException(
					'File upload error'
				);

                } // end of error checking

		// set title if necessary
		$title = $file->getTitle();
		if(empty($title)) {
			$file->setTitle(
				pathinfo($httpFile->getName(), PATHINFO_FILENAME)
			);
		}

		// set extension
		$file->setExtension(
			pathinfo($httpFile->getName(), PATHINFO_EXTENSION)
		);

		// set unique filename
		$this->createUniqueFilename($file);

		// set path
		$file->setPath($this->getStoragePath());

		// copy file to new directory
                $fullPath = $this->getFileFullPath($file);
                $httpFile->move($fullPath);

		// save entity
		$this->persist($file);
	}



	/**
	 * Find all files under given folder
	 *
	 * @return ArrayCollection
	 */
	public function findFilesByFolder(Folder $folder, IPaginator $paginator = null)
	{
		return $this->fileDao->findFilesByFolder($folder, $paginator);
	}




	/**
	 *
	 *  Helpers
	 *
	 */



	/**
	 * Check existence of important directories for storage.
	 * And if they are not present, will try to create.
	 */
	protected function checkExistenceOfStorage()
	{
		if(!file_exists($this->storagePath)) {
			if(!mkdir($this->storagePath)) {
				throw new LogicException(
					'Cannot create storage directory',
					self::CANNOT_CREATE_STORAGE
				);
			}
		}
	}



	/**
	 * Create unique filename. Will test 10 times and then throw error.
	 */
	protected function createUniqueFilename(File $file)
	{
		$urilizedTitle = Text::urilize($file->getTitle());
		$filename = $urilizedTitle;
		$extension = $file->getExtension();

		for($i = 0; $i < 10; $i++) {
                        $fullPath = $this->getStoragePath().'/'.$filename.'.'.$extension;

                        if(!file_exists($fullPath)) {
				$file->setFilename($filename);
                                return;
                        }

                        $filename = $urilizedTitle
			            .'-'.Text::random(Text::ALPHANUMERIC, 6);
                }

		throw new Exception(
			$message,
			self::CANNOT_CREATE_UNIQUE_FILENAME
		);
	}


    
}



/**
 * Exception dedicated for uploading files
 */
class UploadException extends \Om\Exception {}

