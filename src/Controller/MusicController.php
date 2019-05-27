<?php
namespace Application\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Application\Data\MusicData;
use Application\Model\Music\Music;

/**
 * Description of MusicController
 *
 * @author Aluno
 */
class MusicController {

    public function index() {        
        $musicData = new MusicData();
        $model = new Music();
        $model->allMusics = $musicData->query();

        return view('music/index',$model);
    }

    public function form() {
        return view('music/form', null);
    }

    public function save() {
        $model = new Music();
        $fields = post();
        if(!isset($fields['name']) || $fields['name'] == null) {
            $model->errors['name'] = 'Campo nome obargatório';
        }
        if(!isset($fields['duration']) || $fields['duration'] == null) {
            $model->errors['duration'] = 'Campo duração obargatório';
        }
        if(!isset($fields['link']) || $fields['link'] == null) {
            $model->errors['link'] = 'Campo link obargatório';
        }
        if(count($model->errors) > 0) {
            return view('music/form', $model);
        }
        $musicData = new MusicData();
        if(isset($fields['id']) && $fields['id'] !== '') {
           $fields['id'];
            $update = ['name' => $fields['name'], 'duration' => $fields['duration'], 'link' => $fields['link']];
            $musicData->update($update, 'id = ' . $fields['id']);
        } else {
            $musicData->insert($fields);
        }
        return $this->index();
    }

    public function edit($id) {
        $model = new Music();
        $data = (new MusicData())->find('id = '.$id);
        $model->id = $data['id'];
        $model->name = $data['name'];
        $model->duration = $data['duration'];
        $model->link = $data['link'];

        return view('music/form', $model);
    }

    public function delete($id) {
        $musicData = new MusicData();
        $musicData->delete('id = '.$id);

        return $this->index();
    }
}
