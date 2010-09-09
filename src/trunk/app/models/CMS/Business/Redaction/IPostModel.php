<?php

namespace CMS\Redaction;

use CMS\Entity\Redaction\Post;

/**
 * IPostModel
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IPostModel
{
    /**#@+ Exception error code */
	/**#@-*/

    /**
     * Basic operations with entity
     */
    public function add(Post $post);
    public function edit(Post $post);
    public function delete(Post $post);
    public function get(Post $post);

    /**
     * Other operations
     */
    

}
