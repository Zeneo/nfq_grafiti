<?php

class UsersController extends AppController {
	
    public $name = 'Users';

    public function beforeFilter() {
		$this->Auth->allow('admin_login');
        parent::beforeFilter();
    }

    public function index() {
		$this->redirect("/");
    }
	public function login() {
		$this->redirect("/");
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
			$this->redirect($this->Auth->redirect());
		}
    }
    public function admin_logout() {
        $this->redirect($this->Auth->logout());
    }

}

?>
