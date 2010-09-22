<?php

namespace CMS\Redaction;

/**
 * IMenuItemDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IMenuItemDao extends \CMS\Common\IBaseDao
{   
    /**#@+ columns allowed for ordering */
    const TITLE = 'title';
    const ORDER = 'order';
    const LANGUAGE = 'language.tag';
    /**#@- */

    // použít not lazy querying, na root položky
    // kešovat, a invalidovat během persist a delete
    public function getTree(Menu $menu);
   

    /**
     * raději přesunout do business
     * @param MenuItem $menuItem item whose parent items will be returned
     * @return ArrayCollection found parent items
     */
    public function findParents(MenuItem $menuItem);
   
    /**
     * raději přesunout do business
     * @param MenuItem $menuItem item whose children will be returned
     * @param int $depth 0 = all children, 1+ = children up to $depth
     * @return ArrayCollection found children
     */
    public function findChildren(MenuItem $menuItem, $depth = 0);
}

