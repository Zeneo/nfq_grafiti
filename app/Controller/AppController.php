<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

	// public $components = array('Auth' => array('authorize' => 'Controller'), 'Cookie', 'RequestHandler','Session');
	public $basic;
	public $paginate = array(
		'maxLimit' => 100000
	);
	/*public function isAuthorized($user = null) {
        // Any registered user can access public functions
        if (empty($this->request->params['admin'])) {
			$this->set('admin_menu', true);
            return true;
        }
        // Only admins can access admin functions
        if (isset($this->request->params['admin'])) {
			$this->set('admin_menu', true);
            return (bool)($user['status'] === 'active');
        }
        // Default deny
        return false;
    }*/
	public function beforeFilter() {
		// if ((isset($this->request->params['prefix'])) && ($this->request->params['prefix'])) {
            // $this->layout = 'admin';
		// }
		// else 
			// $this->Auth->allow('*');
		if($this->name == 'CakeError') {
			$this->layout = 'error';
			$this->view = 'errors/missing_controller.ctp';
			$this->loadModel('Basic');
			$basic=$this->Basic->findBasicOptions();
			if(empty($basic))
				$basic=$this->Basic->setDefaultBasic();
			$this->basic = $basic;
			$this->set('basic', $basic['Basic']);
		}else{
			$this->set('base_url', 'http://'.$_SERVER['SERVER_NAME']);
			$this->set('full_url', $this->selfURL());
			$this->loadModel('Basic');
			$basic=$this->Basic->findBasicOptions();
			if(empty($basic))
				$basic=$this->Basic->setDefaultBasic();
			$this->basic = $basic;
			$this->set('basic', $basic['Basic']);
			$this->loadModel('Menu');
			$topmenu = $this->Menu->getMenuItems('topmenu');
			$this->set('topmenu', $topmenu);
			$usermenu = $this->Menu->getMenuItems('usermenu');
			$this->set('usermenu', $usermenu);
			$footermenu = $this->Menu->getMenuItems('footermenu');
			$this->set('footermenu', $footermenu);
		}
	}
	private function selfURL() { 
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
		$protocol = $this->strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
	} 
	private function strleft($s1, $s2) { 
		return substr($s1, 0, strpos($s1, $s2)); 
	}
	
	
	
	/*  Admin section begining*/
	public function admin_index(){
		$this->_admin_index();
	}
	public function _admin_index($actions = array(), $itemActions = array(), $useCommonView = true) {
        if (empty($actions)) {
            $actions = $this->{$this->modelClass}->getIndexActions();
        }
        if (empty($itemActions)) {
            $itemActions = $this->{$this->modelClass}->getIndexItemActions();
        }
        $data = $this->paginate();
        if ($this->{$this->modelClass}->isOrderable()) {
            $this->set('orderable', true);
        }
		$data = $this->{$this->modelClass}->afterPaginate($data, $query);
		if(isset($this->params['named']['page'])){
			$this->set('page', $this->params['named']['page']);
		}
		else
			$this->set('page', 1);
        $this->set('data', $data);
        $this->set('actions', $actions);
        $this->set('itemActions', $itemActions);
		$this->set('name', $this->getHumanizedName());
		if ($useCommonView) {
            $this->viewPath = 'AdminCommon';
        }
    }
	public function _admin_add($path = false, $additionalData = array()) {
        $saved = false;
		$this->set('name', $this->getHumanizedName().' Add');
		if (!empty($this->request->data)) {
            // check if orderable
            if ($this->{$this->modelClass}->isOrderable()) {
                $this->request->data[$this->modelClass]['order'] = $this->{$this->modelClass}->getLastOrder() + 1;
            }
            $saved = $this->{$this->modelClass}->save($this->request->data);
            if ($saved) {
                $this->__setMessage($this->{$this->modelClass}->getAdminAddSuccessMsg());
            } else {
                $this->__setError($this->{$this->modelClass}->getAdminAddErrorMsg());
            }
        }
        $fields = $this->{$this->modelClass}->getAddFields($id_);
        $this->set('fields', $fields);
		if(!$path){
			$this->viewPath = 'AdminCommon';
		}
        $this->view = 'admin_add';
        return $saved;
    }
	public function admin_delete($id = null) {
        $this->_admin_delete($id);
    }

    public function _admin_delete($id = null, $cascade = true, $redirect = true) {
        $deleted = false;
        if (isset($id)) {
            $deleted = $this->{$this->modelClass}->delete($id, $cascade);
        }else {
            $this->__setError(__('Nera ID'));
        }
        if ($redirect) {
            $this->redirect($this->referer());
        }
        return $deleted;
    }
}








