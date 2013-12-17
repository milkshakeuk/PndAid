<?php
/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 05/12/13
 * Time: 23:21
 */
namespace PndAid\Files;

use Exception;

class InvalidPndException extends Exception
{

    /**
     * @var string $message exception message
     */
    protected $message = "Invalid Pnd Exception";
} 