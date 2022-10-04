<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @property    Pagina $Pagina
 * @property    Parametro $Parametro
 * @property    Texto $Texto
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $uses = array('Pagina', 'Parametro', 'Texto');

    public $components = array(
        'DebugKit.Toolbar',
        'Auth' => array(
            'loginAction' => "/admin/usuarios/login",
            'loginRedirect' => array('controller' => 'home', 'action' => 'index'),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuario',
                    'fields' => array('username' => 'usuario', 'password' => 'senha')
                )
            ),
            'authError' => 'Acesso restrito',
            'flash' => array('key' => 'auth', 'element' => 'alert', 'clear' => true)
        ),
        'Cookie',
        'Flash'
    );

    public $helpers = array('Html', 'Form', 'Number', 'Flash', 'Text','PartUpload.Upload');

    public function beforeFilter()
    {
        date_default_timezone_set('America/Sao_Paulo');

        if ($this->params['prefix'] == 'admin') {
            $this->helpers = array(
                // CakePHP
                'Number',
                'Flash',
                'Text',

                // Twitter Bootstrap
                'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
                'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
                'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),

                // Part
                'Part.Menu',
                'PartUpload.Upload',
                'Banner',
                'Noticia',
            );

            $this->layout = 'admin';
//            $this->Auth->allow();
        } else {
            $this->Auth->allow();
        }
    }

    public function beforeRender()
    {
        if ($this->name == 'CakeError') {
            $this->beforeFilter();
        }
    }
}
