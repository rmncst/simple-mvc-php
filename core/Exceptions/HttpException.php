<?php
/**
 * Created by PhpStorm.
 * User: rmncs
 * Date: 05/05/2019
 * Time: 21:19
 */

namespace Core\Exceptions;


use Throwable;

class HttpException extends \Exception
{
    private $_statusCode;

    public function __construct($message = "", $statusCode = 500, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->_statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->_statusCode;
    }



}