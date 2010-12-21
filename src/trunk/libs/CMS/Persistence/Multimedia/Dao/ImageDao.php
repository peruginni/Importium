<?php

namespace CMS\Multimedia;

use CMS\Common\BaseDao;



/**
 * ImageDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class ImageDao extends BaseDao implements IImageDao
{
    /** @var string */
    protected $entityName = 'CMS\Multimedia\Image';



    /** Core methods *******************************************************/



    /**
     * Returns images placed under given album
     * @return ArrayCollection
     */
    public function listImagesByAlbum(Album $album, IOrderRule $order = null, IPaginator $paginator = null)
    {
        $album = new Filter('album', $album);
        if($order === null) {
            $order = new AscendingOrder('order');
        }

        $allowedProperties = array('title', 'dateCreated', 'order');
        if(in_array($order->getProperty(), $allowedProperties)) {
            return $this->listResults($filter, $order, $paginator);
        } else {
            throw new InvalidArgumentException(
                'Sorting is allowed only on properties '.implode(',', $allowedProperties));
        }
    }

}

