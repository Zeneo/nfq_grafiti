<?php

App::uses('Model', 'Model');
class AppModel extends Model {
	public $actsAs = array('Order');
	public $uploadDir = 'img/gallery/';
	public function getItem($id, $recursive = -1) {
        $options['conditions'] = array(
            $this->name . '.id' => $id
        );
        $options['recursive'] = $recursive;
        $data = $this->find('first', $options);
        return $data;
    }
	public function getAll($recursive = -1) {
        $options['recursive'] = $recursive;
        $data = $this->find('all', $options);
        return $data;
    }
	 public function getList() {
         $options = array(
            'fields' => array(
                'id',
                'name'
            )
        );
        $data = $this->find('list', $options);
        return $data;
    }
	/*   Usefull functions */
	public function validDate($date=null){
		if($date!=null){
			$now = date('Y-m-d'); 
			$now = strtotime($now); 
			$date = strtotime($date); 
			if ($date >= $now) {
				return true;
				} 
			else { 
				return false;
				}
		}
		return false;
	}
	public function checkDateFrom($date=null){
		if($date!=null){
			$now = date('Y-m-d'); 
			$now = strtotime($now); 
			$date = strtotime($date); 
			if ($date > $now) {
				return false;
				} 
			elseif($date == $now){
				return true;
			}
			elseif($date < $now){ 
				return true;
				}
			else return false;
		}
		return false;
	}
	public function checkDateExp($date=null){
		if($date!=null){
			$now = date('Y-m-d'); 
			$now = strtotime($now); 
			$date = strtotime($date); 
			if ($date < $now) {
				return false;
				} 
			elseif($date == $now){
				return true;
			}
			elseif($date > $now){ 
				return true;
				}
			else return false;
		}
		return false;
	}
}
