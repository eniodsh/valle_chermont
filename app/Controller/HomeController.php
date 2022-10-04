<?php

App::uses('AppController', 'Controller');

/**
 * Part Comunicação Online
 * Home Controller
 */
class HomeController extends AppController {

    public function admin_index() {
        // do nothing
    }

    public function index() {
        
        if ($this->request->is('post')) {

            $this->loadModel('Participante');
            $this->request->data['Participante']['foto'] = $this->request->data['Home']['foto']['file'];
            $this->Participante->create();
            if ($this->Participante->save($this->request->data)) {
                $this->Flash->set('Sua inscrição foi realizada!', array('element' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->set('Ops... Houve um erro ao realizar sua inscrição, tente novamente.', array('element' => 'alert'));
			}
        }
    }
}
