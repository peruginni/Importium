<?php

namespace CMS\Redaction;

use CMS\Common\BaseDao;

/**
 * TemplateDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class TemplateDao extends BaseDao implements ITemplateDao
{
    protected $entityName = 'CMS\Redaction\Template';
}

