<?php

namespace CMS\Common;

/**
 * IBaseBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IBaseBusiness
{
    public function getDaoType();
    public function setDaoType($daoType);
    
    public function persist($entity);
    public function remove($entity);
    public function findAll();
    public function findById($id);
}

