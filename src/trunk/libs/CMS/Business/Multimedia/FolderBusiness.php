<?php

namespace CMS\Multimedia;

use CMS\Multimedia\IFolderDao;
use CMS\Common\BaseBusiness;
use CMS\Common\IOrderable;

/**
 * FolderBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class FolderBusiness extends BaseBusiness implements IFolderBusiness
{
    /** @var IFolderDao */
    protected $folderDao;



    /** Getters and setters *************************************************/



    /** @return IFolderDao */
    public function getFolderDao()
    {
        if($this->folderDao === null) {
            $this->getDao('CMS\Multimedia\IFolderDao');
        }
        return $this->folderDao;
    }



    public function setFolderDao(IFolderDao $folderDao)
    {
        $this->folderDao= $folderDao;
    }



    /** Core methods ********************************************************/



    public function create(Folder $folder)
    {
        $this->getFolderDao()->persist($folder);
    }



    public function remove(Folder $folder)
    {
        $this->getFolderDao()->remove($folder);
    }



    public function edit(Folder $folder)
    {
        $this->getFolderDao()->persist($folder);
    }


    /**
     * @return Folder
     */
    public function findById($id)
    {
        return $this->getFolderDao()->findById($id);
    }



    /**
     * Returns list of folders
     * @return ArrayCollection
     */
    public function listFolders(IOrderRule $order = null, IPaginator $paginator = null)
    {
        return $this->getFolderDao()->listFolders($order, $paginator);
    }
    
}

