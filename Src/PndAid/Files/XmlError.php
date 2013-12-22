<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
 */

namespace PndAid\Files;


/**
 * Class XmlError
 * @package PndAid\Files
 */
class XmlError
{
    /**
     * @var int $column column number
     */
    public $column;
    /**
     * @var string $message error message
     */
    public $message;
    /**
     * @var int $line line number
     */
    public $line;

    /**
     * @param int $column
     * @param int $line
     * @param string $message
     */
    function __construct($column, $message, $line)
    {
        $this->column = $column;
        $this->message = $message;
        $this->line = $line;
    }

    public function __toString()
    {
        return $this->message . 'line: ' . $this->line . ' column: ' . $this->column;
    }

} 