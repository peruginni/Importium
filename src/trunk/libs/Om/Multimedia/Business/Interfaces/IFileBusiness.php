<?php

namespace Om\Multimedia;

use Om\Core\IBaseBusiness;
use Om\Utilities\IPaginator;
use Nette\Web\HttpUploadedFile;

/**
 * Interface of business logic for files
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IFileBusiness extends IBaseBusiness
{
	
	/**#@+ error codes */
	const CANNOT_ENSURE_STORAGE = 11;
	const CANNOT_CREATE_UNIQUE_FILENAME = 12;
	/**#@-*/



	/**
	 * Get/set storage path, where all files are located
	 */
	public function getStoragePath();

	public function setStoragePath($storagePath);



	/**
	 * Get/set max file size
	 */
	public function getMaxFileSize();

	public function setMaxFileSize($maxFileSize);



	/**
	 * Get full storage path to file
	 */
	public function getFileFullPath(File $file);


	
	/**
	 * Unifies formating of filename path
	 */
	public function formatFilePath($path, $filename, $extension);



	/**
	 * Check existence of important directories for storage.
	 * And if they are not present, will try to create.
	 */
	public function ensureExistenceOfStorage();



	/**
	 * Handle uploaded file and store it according to information in given
	 * (not yet) stored entity.
	 */
	public function upload(File $file, HttpUploadedFile $httpFile);



	/**
	 * Create unique filename. Will test 10 times and then throw error.
	 */
	public function createUniqueFilename(File $file);



	/**
	 * Find all files under given folder
	 *
	 * @return ArrayCollection
	 */
	public function findFilesByFolder(Folder $folder, IPaginator $paginator = null);

}

