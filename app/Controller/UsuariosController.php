<?php

App::uses('AppController', 'Controller');

/**
 * Part Comunicação Online
 * Controller Textos
 *
 * @property Usuario $Usuario
 */
class UsuariosController extends AppController
{
    /**
     * @return CakeResponse|false
     */
    public function admin_login()
    {
		$this->layout = false;
		if ($this->request->is('post')) {

			if ($this->Auth->login()) {
				return $this->redirect( $this->Auth->redirectUrl() );
			} else {
                $this->Flash->set('Usuário ou senha inválidos. Tente novamente.', array(
                    'key' => 'auth',
                    'element' => 'alert',
                    'clear' => true
                ));
			}
		}

		return false;
	}

    /**
     * @return void
     */
	public function admin_logout()
    {
		$this->redirect($this->Auth->logout());
	}

    /**
     * @return void
     */
	public function admin_index()
    {
		if (isset($this->request->query['busca'])) {
			$this->paginate = array('conditions'=>array('or' => array(
				"Usuario.usuario LIKE '%{$this->request->query['busca']}%'",
				"Usuario.nome LIKE '%{$this->request->query['busca']}%'",
				"Usuario.email LIKE '%{$this->request->query['busca']}%'",
			)));
		}

		$this->set('usuarios', $this->paginate());
	}

    /**
     * @param int $id
     * @return void
     */
	public function admin_view($id = null)
    {
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
			throw new NotFoundException('Usuário inválido.');
		}

		$this->set('usuario', $this->Usuario->read(null, $id));
	}

    /**
     * @return void
     */
	public function admin_add()
    {
		if ($this->request->is('post')) {
			$this->Usuario->create();
			if ($this->Usuario->save($this->request->data)) {
                $this->Flash->set('O usuário foi salvo com sucesso.', array('element' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
                $this->Flash->set('O usuário não pode ser salvo. Tente novamente.', array('element' => 'alert'));
			}
		}
	}

    /**
     * @param int $id
     * @return void
     */
	public function admin_edit($id = null)
    {
		$this->Usuario->id = $id;

		if (!$this->Usuario->exists()) {
			throw new NotFoundException('Usuário inválido.');
		}

		if ($this->request->is('post') || $this->request->is('put')) {

		    // altera a senha apenas quando o campo for preenchido
		    if (empty($this->request->data['Usuario']['senha'])) {
		        unset($this->request->data['Usuario']['senha']);
            }

			if ($this->Usuario->save($this->request->data)) {
                $this->Flash->set('O usuário foi editado com sucesso.', array('element' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
                $this->Flash->set('O usuário não pode ser editado. Tente novamente.', array('element' => 'alert'));
			}
		} else {
			$this->request->data = $this->Usuario->read(null, $id);
		}
	}

    /**
     * @param int $id
     * @return void
     */
	public function admin_delete($id = null)
    {
	    if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$this->Usuario->id = $id;

		if (!$this->Usuario->exists()) {
			throw new NotFoundException('Usuário inválido.');
		}

		if ($this->Usuario->delete()) {
            $this->Flash->set('O usuário foi excluído com sucesso.', array('element' => 'success'));
			$this->redirect(array('action' => 'index'));
		}

        $this->Flash->set('O usuário não pode ser excluído. Tente novamente.', array('element' => 'alert'));
		$this->redirect($this->referer());
	}
}
