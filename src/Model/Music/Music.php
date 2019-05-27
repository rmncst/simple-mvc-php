<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Model\Music;

/**
 * Description of Music
 *
 * @author Aluno
 */
class Music {
    public $id;
    public $name;
    public $artist;
    public $duration;
    public $link;

    public $allMusics = [];
    public $errors = [];
}
