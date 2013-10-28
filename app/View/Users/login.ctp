<?php 
	$response = array();
	if($err){
		$html=$this->Form->input('username', array('label' => 'Vartoto vardas', 'id' => 'UserUsername', 'class' => 'err', 'name'=> 'data[User][username]','value' => $data['User']['username']));
		$html=$html.$this->Form->input('password', array('label' => 'Slaptazodis',  'id' => 'UserPassword', 'class' => 'err',  'name'=> 'data[User][password]', 'value' => $data['User']['password']));
		$response = array(
			'Auth' => 'false',
			'html' => $html
		);
	}else{
		$link = $this->Html->url(array('controller' =>  '/'));
		$response = array(
			'auth' => 'true',
			'link' => $link
		);
	}
	echo json_encode($response);
?>
