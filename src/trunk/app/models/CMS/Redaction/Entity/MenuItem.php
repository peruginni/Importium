<?php

namespace CMS\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use CMS\Entity\Language;

/**
 * Menu item entity
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class MenuItem
{
    /**#@+ menu item */
    const TYPE_PAGE = 1;
    const TYPE_CATEGORY = 2;
    const TYPE_LINK = 3;
    /**#@-*/

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="string") */
    private $title;

    /** @Column(type="int") */
    private $type;

    /** @Column(type="int") */
    private $order;

    /** @ManyToOne(targetEntity="\CMS\Entity\Language") */
    private $language;

    /** @OneToMany(targetEntity="\CMS\Entity\MenuItem", mappedBy="parentItem") */
    private $childrenItems;

    /** @ManyToOne(targetEntity="\CMS\Entity\MenuItem", inversedBy="childrenItems") */
    private $parentItem;

    /** @OneToOne(targetEntity="\CMS\Entity\Page") */
    private $page;
   
    public function __construct()
    {
        $this->metas = new ArrayCollection;
        $this->childrenItems = new ArrayCollection;
    }

    /** @return int */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /** @return string */
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = (string) $title;
    }

    /** @return int */
    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = (int) $type;
    }

    /** @return int */
    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder($order)
    {
        $this->order = (int) $order;
    }

    /** @return Language */
    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage(Language $language)
    {
        $this->language = $language;
    }

    /** @return ArrayCollection */
    public function getChildrenItems()
    {
        return $this->childrenItems;
    }

    public function setChildrenItems(ArrayCollection $childrenItems)
    {
        $this->childrenItems = $childrenItems;
    }

    public function addChildItem(MenuItem $childItem)
    {
        $this->childrenItems->add($image);
        $childItem->setParentItem($this);
    }

    public function removeChildItem(MenuItem $childItem)
    {
        $this->childrenItems->remove($childItem);
        $childItem->setParentItem(null);
    }

    /** @return MenuItem */
    public function getParentItem()
    {
        return $this->parentItem;
    }

    public function setParentItem(MenuItem $parentItem)
    {
        $this->parentItem = $parentItem;
    }

    /** @return Page */
    public function getPage()
    {
        return $this->page;
    }

    public function setPage(Page $page)
    {
        $this->page = $page;
    }
    
}
