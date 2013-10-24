<?php
    class Menu extends AppModel {

		public $name = 'Menu';
		public $hasMany = 'MenuItem';
		public function findAllItems() {
			$options = array(
				'conditions' => array(
					'Menu.published'=> 1
				),
				'recursive' => -1
			);
			$data = $this->find('all', $options);
			return $data;
		}
		public function getList() {
			 $options = array(
				'fields' => array(
					'id',
					'name'					
				),
				'recursive' => -1
			);
			$data = $this->find('list', $options);
			return $data;
		}
		public function getMenuItems($name = null){
			if($name){
				$data = $this->MenuItem->getMenuPages($name);
				return $data;
			}else{
				return false;
			}
		}
    }
?>