<?php

namespace CMS\Dao;

use CMS\Entity\Redaction\Template;

/**
 * ITemplateDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface ITemplateDao
{
    public function persist(Template $template);
    public function remove(Template $template);
    public function findAll();
}

