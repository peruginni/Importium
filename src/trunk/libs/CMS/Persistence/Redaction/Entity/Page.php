<?php

namespace CMS\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use CMS\Users\UserAccount;
use CMS\Common\Language;
use CMS\Common\Meta;
use CMS\Common\Tag;

/**
 * Page entity
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 *
 * @Entity
 */
class Page
{
    /** @Id @Column(type="integer") @GeneratedValue */
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

    /** @ManyToOne(targetEntity="\CMS\Users\UserAccount") */
    private $author;

    /** @ManyToOne(targetEntity="\CMS\Common\Language") */
    private $language;

    /** @ManyToMany(targetEntity="\CMS\Common\Tag") */
    private $tags;
    
    /** @ManyToOne(targetEntity="\CMS\Redaction\Template") */
    private $pageTemplate;
    
    /** @ManyToOne(targetEntity="\CMS\Redaction\Template") */
    private $subpagesTemplate;

    /** @OneToOne(targetEntity="\CMS\Security\SharingSettings") */
    private $sharingSettings;

    /**
     * @ManyToMany(targetEntity="\CMS\Common\Meta")
     * @JoinTable(inverseJoinColumns={@JoinColumn(unique=true)})
     */
    private $metas;
   
    public function __construct()
    {
        $this->tags = new ArrayCollection;
        $this->metas = new ArrayCollection;
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

    /** @return string */
    public function getPerex()
    {
        return $this->perex;
    }
    
    public function setPerex($perex)
    {
        $this->perex = (string) $perex;
    }

    /** @return string */
    public function getContent()
    {
        return $this->content;
    }
    
    public function setContent($content)
    {
        $this->content = (string) $content;
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

    /** @return UserAccount */
    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(UserAccount $author)
    {
        $this->author = $author;
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
    public function getTags()
    {
        return $this->tags;
    }

    public function setTags(ArrayCollection $tags)
    {
        $this->tags = $tags;
    }

    /** @return Tag */
    public function addTag(Tag $tag)
    {
        $this->tags->add($tag);
    }

    public function removeTag(Tag $tag) 
    {
        $this->tags->remove($tag);
    }

    /** @return Template */
    public function getPageTemplate()
    {
        return $this->pageTemplate;
    }

    public function setPageTemplate(Template $pageTemplate)
    {
        $this->pageTemplate = $pageTemplate;
    }

    /** @return Template */
    public function getSubpagesTemplate()
    {
        return $this->subpagesTemplate;
    }

    public function setSubpagesTemplate(Template $subpagesTemplate)
    {
        $this->subpagesTemplate = $subpagesTemplate;
    }
    
    /** @return SharingSettings */
    public function getSharingSettings()
    {
        return $this->sharingSettings;
    }
    
    public function setSharingSettings(SharingSettings $sharingSettings)
    {
        $this->sharingSettings = $sharingSettings;
    }

    /** @return ArrayCollection */
    public function getMetas()
    {
        return $this->metas;
    }

    public function setMetas(ArrayCollection $metas)
    {
        $this->metas = $metas;
    }

    public function addMeta(Meta $meta)
    {
        $this->metas->add($meta);
    }

    public function removeMeta(Meta $meta)
    {
        $this->metas->remove($meta);
    }

}
