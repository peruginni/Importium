<?php

namespace CMS\Entity\Redaction;

use DateTime;
use CMS\Entity\Users\UserAccount;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Post entity
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Post
{
    /**
     * ------------------------------------------------------------------------
     * Attributes
     * ------------------------------------------------------------------------
     */
    
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="string") */
    private $title;

    /** @Column(type="string") */
    private $perex;

    /** @Column(type="text") */
    private $content;

    /** @Column(type="datetime") */
    private $dateCreated;

    /** @Column(type="datetime") */
    private $datePublished;

    /** @Column(type="datetime") */
    private $dateModified;

    /** @Column(type="string", unique=TRUE) */
    private $urlSlug;

    /** @ManyToOne(targetEntity="\CMS\Entity\User\UserAccount") */
    private $author;

    /** @ManyToMany(targetEntity="Category", mappedBy="posts") */
    private $categories;

    /**
     * ------------------------------------------------------------------------
     * Constructor
     * ------------------------------------------------------------------------
     */
    
    public function __construct()
    {
        $this->categories = new ArrayCollection;
    }

    /**
     * ------------------------------------------------------------------------
     * Getters and setters
     * ------------------------------------------------------------------------
     */

    /** @return int */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /** @return string */
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    /** @return string */
    public function getPerex()
    {
        return $this->perex;
    }
    
    public function setPerex($perex)
    {
        $this->perex = $perex;
    }

    /** @return string */
    public function getContent()
    {
        return $this->content;
    }
    
    public function setContent($content)
    {
        $this->content = $content;
    }

    /** @return DateTime */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }
    
    public function setDateCreated(DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    /** @return DateTime */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    public function setDatePublished(DateTime $datePublished)
    {
        $this->datePublished = $datePublished;
    }

    /** @return DateTime */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    public function setDateModified(DateTime $dateModified)
    {
        $this->dateModified = $dateModified;
    }

    /** @return string */
    public function getUrlSlug()
    {
        return $this->urlSlug;
    }

    public function setUrlSlug($urlSlug)
    {
        $this->urlSlug = $urlSlug;
    }

    /** @return UserAccount */
    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(UserAccount $author)
    {
        $this->author = $author;
    }

    /** @return ArrayCollection */
    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories(ArrayCollection $categories)
    {
        $this->categories = $categories;
    }

    public function addCategory(Category $category)
    {
        $this->categories->add($category);
        $category->setPost($this);
    }

    public function removeCategory(Category $category)
    {
        $this->categories->remove($category);
        $category->removePost($this);
    }

}

