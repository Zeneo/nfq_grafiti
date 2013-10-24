<?php

class MenuItemsController extends AppController {
	
	public $name = 'MenuItems';
	public $humanizedName = 'Menu Items';

	public function admin_index(){
		$paginate = array(
			'fields' => array(
				'id',
				'menu_id',
				'parent_id',
				'img',
				'language',
				'title',
				'Menu.name',
				'module',
				'alias',
				'url',
				'mobile',
				'published',
				'order',
			),
            'limit' =>10000,
			'order' => 'order ASC'
        );
		$data=parent::_admin_index(null, array(), $paginate, array(), array(), false, -1, true);
	}
	public function admin_add() {
		if (!empty($this->request->data)) {
			unset($this->request->data['MenuItem']['url_type']);
			foreach($this->request->data['MenuItem']['parent_id'] as $val){
				$this->request->data['MenuItem']['parent_id']=$val;
			}
			if(isset($this->request->data['MenuItem']['img']) && is_array($this->request->data['MenuItem']['img'])){
				if($this->request->data['MenuItem']['img']['error']==0){
					$sizes = array(
						array(
							"ratio" => true,
							"type"=>"resize",
							"width"=>227, 
							"height"=>44, 
							"subfolder" => "very_small/menu/"
						), 
						array(
							"ratio" => true,
							"type"=>"resize",
							"width"=>60, 
							"height"=>30, 
							"subfolder" => "tiny/menu/"
						)
					);
					$image = $this->MenuItem->uploadImage($sizes, 'img');
					if($image){
						$this->request->data['MenuItem']['img']='menu/'.$image['name'];
					}
				}else{
					$this->request->data['MenuItem']['img'] = null;
				}
			}elseif(isset($this->request->data['MenuItem']['img_old']) && $this->request->data['MenuItem']['img_old']){
				$this->request->data['MenuItem']['img'] = $this->request->data['MenuItem']['img_old'];
			}else{
				$this->request->data['MenuItem']['img'] = null;
			}
		}
        parent::_admin_add(true);
    }
	public function admin_edit($id = null) {
        $this->viewPath = 'MenuItems';
		if (!empty($this->request->data)) {
			unset($this->request->data['MenuItem']['url_type']);
			foreach($this->request->data['MenuItem']['parent_id'] as $val){
				$this->request->data['MenuItem']['parent_id']=$val;
			}
			if(isset($this->request->data['MenuItem']['img']) && is_array($this->request->data['MenuItem']['img'])){
				if($this->request->data['MenuItem']['img']['error']==0){
					$sizes = array(
						array(
							"ratio" => true,
							"type"=>"resize",
							"width"=>227, 
							"height"=>44, 
							"subfolder" => "very_small/menu/"
						), 
						array(
							"ratio" => true,
							"type"=>"resize",
							"width"=>60, 
							"height"=>30, 
							"subfolder" => "tiny/menu/"
						)
					);
					$image = $this->MenuItem->uploadImage($sizes, 'img');
					if($image){
						$this->request->data['MenuItem']['img']='menu/'.$image['name'];
					}
				}else{
					$this->request->data['MenuItem']['img'] = null;
				}
			}elseif(isset($this->request->data['MenuItem']['img_old']) && $this->request->data['MenuItem']['img_old']){
				$this->request->data['MenuItem']['img'] = $this->request->data['MenuItem']['img_old'];
			}else{
				$this->request->data['MenuItem']['img'] = null;
			}
		}
		$item = $this->MenuItem->getItem($id);
		$this->set('Item_img', $item['MenuItem']['img']);
		parent::_admin_edit($id, true, null, 'MenuItems');
    }
	public function admin_mobile($id = null, $mobile = 1, $page = null) {
		$this->_admin_mobile($id, $mobile, $page);
	}

	protected function _admin_mobile($id, $mobile = 1, $page) {
		$this->{$this->modelClass}->mobile($id, $mobile);
		if($this->modelClass == "Menu"){
			$this->redirect(array('action' => 'index', 'controller' => 'MenuItems'));
		}
		elseif($page !=null){
			$this->redirect(array(
				'action' => 'index',
				'page' => $page
					
				)
			);
		}
		else
			$this->redirect(array('action' => 'index'));
	}
}

?>