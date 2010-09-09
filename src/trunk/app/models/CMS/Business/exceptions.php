<?php

/**
 * Exceptions specific to CMS model
 */

namespace CMS;

class Exception extends \Exception {}
class LogicException extends \LogicException {}
    class InvalidArgumentException extends \InvalidArgumentException {}
class RuntimeException extends \RuntimeException {}
    class UnexpectedValueException extends \UnexpectedValueException {}
    class InvalidStateException extends \InvalidStateException {}

/**
 * Good reading
 *
 * http://latrine.dgx.cz/php-triky-standardni-vyjimky
 *
 * Useful SPL exceptions, other are ambigious
 * - LogicException
 * 	- InvalidArgumentException
 *  - LengthException
 * - RuntimeException
 *  - OutOfBoundsException
 *  - UnexpectedValueException
 *
 */
