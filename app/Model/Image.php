<?php class Image extends AppModel {
		public $name = 'Image';
		public function getList($uid = null){
				$options = array(
					'fields' => array('id', 'name'),
					'recursive' => -1
				);
			$data = $this->find('list', $options);
			return $data;
		}
    }
?>