<?php

namespace CMS\Entity\Redaction;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category entity
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Category
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

    /** @Column(type="text") */
    private $description;

    /** @ManyToMany(targetEntity="Post", inversedBy="categories") */
    private $posts;

    /** @ManyToOne(targetEntity="Category") */
    private $parentCategory;

    /**
     * ------------------------------------------------------------------------
     * Constructor
     * ------------------------------------------------------------------------
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection;
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
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    /** @return ArrayCollection */
    public function getPosts()
    {
        return $this->posts;
    }

    public function setPosts(ArrayCollection $posts)
    {
        $this->posts = $posts;
    }

    public function addPost(Post $post)
    {
        $this->posts->add($post);
    }

    public function removePost(Post $post)
    {
        $this->posts->remove($post);
    }

    /** @return Category */
    public function getParentCategory()
    {
        return $this->parentCategory;
    }

    public function setParentCategory(Category $parentCategory)
    {
        $this->parentCategory = $parentCategory;
    }
    
}

