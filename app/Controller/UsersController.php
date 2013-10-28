<?php

class UsersController extends AppController {
	
    public $name = 'Users';
	// public $validate = array(
        // 'username' => array(
            // 'required' => array(
                // 'rule' => array('notEmpty'),
                // 'message' => 'A username is required'
            // )
        // ),
        // 'password' => array(
            // 'required' => array(
                // 'rule' => array('notEmpty'),
                // 'message' => 'A password is required'
            // )
        // ),
        // 'role' => array(
            // 'valid' => array(
                // 'rule' => array('inList', array('admin', 'author')),
                // 'message' => 'Please enter a valid role',
                // 'allowEmpty' => false
            // )
        // )
    // );
    public function beforeFilter() {
		$this->Auth->allow('login', 'logout', 'index');
		if($this->Security && $this->action == 'checkjson'){
			$this->Security->validatePost = false;
			$this->Security->csrfCheck = false;
		}
    }

    public function index() {
		$this->redirect("/");
    }
	public function login() {
		 if (!empty($this->request->data) && $this->request->is('ajax')) {
            if ($this->Auth->login()) {
                $this->set('err', false);
				$this->Session->write('logged', true);
            } else {
				$this->layout = 'ajax';
                $this->set('err', true);
				$this->set('data', $this->request->data);
            }
        }else{
			$this->redirect("/");
		}
	}
	
    public function admin_edit($id = null) {
        if (!empty($this->request->data)) {
            $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
        }
        parent::_admin_edit($id);
    }
    public function admin_login() {
        if (!empty($this->request->data)) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            } else {
                $this->__setError(__('Username or password is incorrect'));
            }
        }
    }
    public function logout() {
		if($this->Auth->logout()){
			$this->Session->delete('logged');
			$this->redirect($this->Auth->redirect());
		}
    }
    public function admin_logout() {
        $this->redirect($this->Auth->logout());
    }

}

?>
