<?php

namespace CMS\Common;

use CMS\InvalidArgumentException;

/**
 * LanguageBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class LanguageBusiness extends BaseBusiness implements ILanguageBusiness
{
    protected $daoType = 'CMS\Common\ILanguageDao';

    /** @var ILanguageDao */
    protected $dao;

    /** @return Language */
    public function findByTag($tag)
    {
        switch($tag) {
            case self::CZECH:
            case self::SLOVAK:
            case self::ENGLISH:
                break;
            default:
                throw new InvalidArgumentException();
        }
        return $this->dao->findByTag($tag);
    }
}

