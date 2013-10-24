<?php
    class Basic extends AppModel {
		public $name = 'Basic';
		public function findBasicOptions() {
			$options = array(
				'recursive' => 1
			);
			$data = $this->find('first', $options);
			return $data;
		}
		public function setDefaultBasic(){
			$data= array(
			'Basic'=> array(
				'site_title' => 'Default')
			);
			return $data;
		}
    }
    ?>