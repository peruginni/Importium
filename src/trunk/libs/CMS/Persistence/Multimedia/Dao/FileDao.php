<?php

namespace CMS\Multimedia;

use CMS\Common\BaseDao;
use CMS\Utilities\Filter;
use CMS\Utilities\AscendingOrder;



/**
 * FileDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class FileDao extends BaseDao implements IFileDao
{
    /** @var string */
    protected $entityName = 'CMS\Multimedia\File';



    /** Core methods *******************************************************/



    /**
     * Returns files placed under given folder
     * @return ArrayCollection
     */
    public function listFilesByFolder(Folder $folder, IOrderRule $order = null, IPaginator $paginator = null)
    {
        $filter = new Filter('folder', $folder);
        if($order === null) {
            $order = new AscendingOrder('title');
        }

        $allowedProperties = array('title', 'dateCreated');
        if(in_array($order->getProperty(), $allowedProperties)) {
            return $this->listResults($filter, $order, $paginator);
        } else {
            throw new InvalidArgumentException(
                'Sorting is allowed only on properties '.implode(',', $allowedProperties));
        }
    }

}

