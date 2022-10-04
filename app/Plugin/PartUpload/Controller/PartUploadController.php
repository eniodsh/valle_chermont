<?php
App::uses('AppController', 'Controller');
class PartUploadController extends AppController {
	
	public function admin_index() {
		if($this->request->is('post')) {
			
			$this->PartUpload->save($this->request->data);
			
		}
	}
}
