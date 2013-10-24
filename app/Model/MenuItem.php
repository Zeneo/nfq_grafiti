<?php
    class MenuItem extends AppModel {

	public $belongsTo = 'Menu';
	
	public function getMenuPages($name = null, $lang = null){
		$options=array(
			'conditions' => array(
				'Menu.name' => $name,
				'Menu.published' => 1,
				'MenuItem.language'=> $lang,
				'MenuItem.published'=> 1
			),
			'order' => 	'MenuItem.order ASC'
		);	
		$options['recursive'] = 1;
		$data = $this->find('all', $options);
		return $data;
		unset($data);
	}
	public function getItem($id, $recursive = -1) {
        $options['conditions'] = array(
            $this->name . '.id' => $id
        );
        $options['recursive'] = $recursive;
        $data = $this->find('first', $options);
        return $data;
    }
}
    ?>