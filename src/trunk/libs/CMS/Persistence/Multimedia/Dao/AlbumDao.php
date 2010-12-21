<?php

namespace CMS\Multimedia;

use CMS\Common\BaseDao;



/**
 * AlbumDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class AlbumDao extends BaseDao implements IAlbumDao
{
    /** @var string */
    protected $entityName = 'CMS\Multimedia\Album';



    /** Core methods *******************************************************/



    /**
     * Returns list of albums
     * @return ArrayCollection
     */
    public function listAlbums(IOrderRule $order = null, IPaginator $paginator = null)
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

