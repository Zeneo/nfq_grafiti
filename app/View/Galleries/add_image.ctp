<?php
	$html = "<div class='fog'><div class='add_image_cnt'><div class='add_image_title'>Prideti nuotrauka</div><div class='close'></div>";
	if(isset($uid)){
		$html = $html.$this->Form->create('Gallery', array('type' => 'file', 'url' => array('controller' => 'galleries', 'action' => 'add_image')));
		if(isset($data['Gallery']['name']) && isset($errors) && !$errors['name']){
			$html = $html.$this->Form->input('name', array('label' => 'Pavadinimas', 'value' => $data['Gallery']['name'])); 
		}elseif(isset($errors) && $errors['name']){
			$html = $html.$this->Form->input('name', array('label' => 'Pavadinimas', 'class'=>'err')); 
		}else{
			$html = $html.$this->Form->input('name', array('label' => 'Pavadinimas')); 
		}
		if(isset($data['Gallery']['gallery_id']) && isset($errors) && !$errors['name']){
			$html = $html.$this->Form->input('gallery_id', array('options' => $options, 'default' => '0', 'value' => $data['Gallery']['gallery_id'])); 
		}elseif(isset($errors) && $errors['name']){
			$html = $html.$this->Form->input('gallery_id', array('options' => $options, 'default' => '0', 'class'=>'err')); 
		}else{
			$html = $html.$this->Form->input('gallery_id', array('options' => $options, 'default' => '0'));
		}
		$html = $html.$this->Form->input('file', array('type' => 'file', 'accept' => 'image/*', 'label' => 'Paveiklelis (800x600)'));
		$html = $html.$this->Form->end('Ikelti', array('class'=>'submit')); 
		
	}
	$html =$html.'</div></div>';
	if(!isset($err)){
		$err = null;
	}
	$response = array(
		'err' => $err,
		'html' => $html,
		'successful' => $successful,
		'link' => $this->Html->url(array('controller' => 'galleries', 'action' => 'user_gallery'))
	);
	echo json_encode($response);
?>