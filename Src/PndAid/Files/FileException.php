<?php
/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 08/12/13
 * Time: 16:42
 */

namespace PndAid\Files;

use Exception;

class FileException extends Exception
{

    /**
     * @var string $message exception message
     */
    protected $message = "Unknown Files Exception";
} 