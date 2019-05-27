<?php
/**
 * Created by PhpStorm.
 * User: rmncs
 * Date: 26/05/2019
 * Time: 21:28
 */

namespace Application\Data;


use Core\TableGateway;

class MusicData extends TableGateway
{
    public function __construct()
    {
        parent::__construct('music');
    }

}