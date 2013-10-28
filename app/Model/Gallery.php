<?php
    class Gallery extends AppModel {

		public $name = 'Gallery';
		public $hasMany = 'Image';
		public function getGalleries($id = null) {
			$options = array(
				'conditions' => array(
					'Gallery.owner_id'=> $id
				),
				'recursive' => 1
			);
			$data = $this->find('all', $options);
			return $data;
		}
		public function getList($uid = null){
			if($uid){
				$options = array(
					'fields' => array('id', 'name'),
					'conditions' => array(
						'Gallery.owner_id'=> $uid
					),
					'recursive' => -1
				);
			}else{
				$options = array(
					'fields' => array('id', 'name'),
					'recursive' => -1
				);
			}
			$data = $this->find('list', $options);
			return $data;
		}
		public function saveImage($data){
			$this->Image->save($data);
		}
		public function loadActions(){
			$actions = array(
				'create_gallery' => array(
					'title' => 'Sukurti nauja galerija',
					'module' => 'galleries',
					'action' => 'create',
					'id' => 'create_gallery',
					'active' => 0
				),
				'add_image' => array(
					'title' => 'Prideti nuotrauka',
					'module' => 'galleries',
					'action' => 'add_image',
					'id' => 'add_image',
					'active' => 1
				),
				'user_data' => array(
					'title' => 'Paskyros nustatymai',
					'module' => 'users',
					'action' => 'edit',
					'id' => '',
					'active' => 0
				),
			);
			return $actions;
		}
    }
?>