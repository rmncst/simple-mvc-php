<?php
namespace Application\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MusicController
 *
 * @author Aluno
 */
class MusicController {
    public function index() {        
        $model = new \Application\Model\Music();
        $model->name = 'Take On Me !';
        $model->duration = 123.1;
        $model->artist = 'Aha';        
        return view('music',$model);       
    }
}
