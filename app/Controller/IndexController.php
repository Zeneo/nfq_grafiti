<?php
App::uses('Controller', 'Controller');

class IndexController extends AppController {

	public function beforeFilter() {
		$this->Auth->allow('index');
        parent::beforeFilter();
    }
	public function index(){
		$slider_images = array(
			'img/uploads/1.jpg',
			'img/uploads/2.jpg',
			'img/uploads/3.jpg',
			'img/uploads/4.jpg',
			'img/uploads/5.jpg',
			'img/uploads/6.jpg',
		);
		$this->set('slider', $slider_images);
	}
}
?>