<?php

class MenuItemsController extends AppController {
	
	public $name = 'MenuItems';
	public $humanizedName = 'Menu Items';

	public function admin_index(){
		$paginate = array(
			'fields' => array(
				'id',
				'menu_id',
				'title',
				'Menu.name',
				'module',
				'alias',
				'url',
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
			
		}
        parent::_admin_add(true);
    }
	public function admin_edit($id = null) {
        $this->viewPath = 'MenuItems';
		if (!empty($this->request->data)) {
			
		}
		parent::_admin_edit($id, true, null, 'MenuItems');
    }
}

?>