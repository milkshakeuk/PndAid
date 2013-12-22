<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
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