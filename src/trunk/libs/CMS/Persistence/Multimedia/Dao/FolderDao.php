<?php

namespace CMS\Multimedia;

use CMS\Common\BaseDao;
use CMS\Utilities\IPaginator;
use CMS\Utilities\IOrderRule;
use CMS\Utilities\AscendingOrder;
use CMS\Utilities\DescendingOrder;
use in_array;
use implode;

/**
 * FolderDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class FolderDao extends BaseDao implements IFolderDao
{
    /** @var string */
    protected $entityName = 'CMS\Multimedia\Folder';



    /** Core methods *******************************************************/



    /**
     * Returns list of folders
     * @return ArrayCollection
     */
    public function listFolders(IOrderRule $order = null, IPaginator $paginator = null)
    {
        if($order === null) {
            $order = new AscendingOrder('title');
        }

        $allowedProperties = array('title', 'dateCreated');
        if(in_array($order->getProperty(), $allowedProperties)) {
            return $this->listResults(null, $order, $paginator);
        } else {
            throw new InvalidArgumentException(
                'Sorting is allowed only on properties '.implode(',', $allowedProperties));
        }
    }
    
}

