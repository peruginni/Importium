<?php

namespace CMS\Dao;

/**
 * Dao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class Dao
{
    private $instance;

    private $languageDao;
    private $metaDao;
    private $tagDao;

    private $menuDao;
    private $menuItemDao;
    private $pageDao;
    private $templateDao;

    private $albumDao;
    private $fileDao;
    private $folderDao;
    private $imageDao;

    private function __construct()
    {
        parent::__construct();
    }

    public function getInstance()
    {
        if($this->instance == null) {
            $this->instance = new self;
        }
        return $this->instance;
    }

    /** @return ILanguageDao */
    public function getLanguageDao()
    {
        if($this->languageDao == null) {
            $this->languageDao = new LanguageDao();
        }
        return $this->languageDao;
    }

    /** @return IMetaDao */
    public function getMetaDao()
    {
        if($this->metaDao == null)
        {
            $this->metaDao = \CMS\Dao\MetaDao();
        }
        return $this->metaDao;
    }

    /** @return ITagDao */
    public function getTagDao()
    {
        if($this->tagDao == null)
        {
            $this->tagDao = \CMS\Dao\TagDao();
        }
        return $this->tagDao;
    }


//    public function __call($methodName, $arguments)
//    {
//        if (substr($methodName, 0, 3) == 'get') {
//            $daoClassName = substr($methodName, 3, strlen($methodName));
//            if(empty($daoClassName)) {
//                $daoInstanceName = $daoClassName;
//                $daoInstanceName{0} = strtolower($daoInstanceName{0});
//                if(property_exists($this, $daoInstanceName)) {
//                    // if class exists
//                    if($this->{$daoInstanceName} == null) {
//                        $this->{$daoInstanceName} = new $daoClassName();
//                    }
//                    return $this->{$daoInstanceName};
//                }
//            }
//        }
//        throw new \BadMethodCallException(
//            "Undefined method '$methodName'."
//        );
//    }


}

