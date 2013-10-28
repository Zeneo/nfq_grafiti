<?php
App::uses('Controller', 'Controller');

class GalleriesController extends AppController {
	public $components = array('Auth' => array('authorize' => 'Controller'), 'Cookie', 'RequestHandler', 'Session');
	public $name = 'Galleries';
	public function beforeFilter() {
		// if(){
			$this->Auth->allow('index');
		// }else{
		
		// }
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
	public function  user_gallery(){
		if($this->Session->read('logged')){
			$user = $this->Session->read("Auth.User");
			if(isset($user['id'])){
				$uid =  $user['id'];
				$gallery_menu = $this->Gallery->loadActions();
				$this->set('gallery_menu', $gallery_menu);
				$galleries = $this->Gallery->getGalleries($uid);
				$this->set('galleries', $galleries);
			}else{
				$this->redirect("/");
			}
		}else{
			$this->redirect("/");
		}
	
	}
	public function add_image(){
		if($this->request->is('ajax')){
			if(!empty($this->request->data)){
				$user = $this->Session->read("Auth.User");
				$uid =  $user['id'];
				$this->set('uid', $uid);
				$err = array();
				if(isset($this->request->data['Gallery']['name']) && !empty($this->request->data['Gallery']['name']) && preg_match('/[^A-Za-z0-9]/', $this->request->data['Gallery']['name'])){
					$err['name'] = false;
				}else{
					$err['name'] = true;
				}
				$user_galleries = $this->Gallery->getList($uid);
				$this->set('options', $user_galleries);
				if(isset($this->request->data['Gallery']['gallery_id']) && !empty($this->request->data['Gallery']['gallery_id']) && isset($user_galleries[$this->request->data['Gallery']['gallery_id']]) && !empty($user_galleries[$this->request->data['Gallery']['gallery_id']])){
					$err['gallery_id'] = false;
				}else{
					$err['gallery_id'] = true;
				}
				$err['image'] = false;
				if(!$err['name'] && !$err['gallery_id']){
					if(isset($this->request->data['Gallery']['file']) && !empty($this->request->data['Gallery']['file']) && preg_match('/^image/', $this->request->data['Gallery']['file']['type'])){
						$info = pathinfo($this->data['Gallery']['file']['name']);
						$new_name = time().strtolower($info['extension']);
						move_uploaded_file(
							$this->data['Gallery']['file']['tmp_name'],
							WWW_ROOT . 'img'.DS.'uploads' . DS .$this->request->data['Gallery']['gallery_id'] .DS.'small'.DS.$new_name
						);
						unset($this->request->data['Gallery']['file']);
						$this->request->data['Gallery']['src'] = $new_name;
						$this->Images->save($this->request->data);
						$this->set('successful', true);
					}else{
						$err['image'] = true;
					}
				}
				$this->set('errors', $err);
				$this->set('successful', false);
				$this->set('data', $this->request->data);
				$this->layout = 'ajax';
			}else{
				$this->set('successful', false);
				$user = $this->Session->read("Auth.User");
				$uid =  $user['id'];
				$this->set('uid', $uid);
				$user_galleries = $this->Gallery->getList($uid);
				$this->set('options', $user_galleries);
				$this->layout = 'ajax';
			}
		
		//   Saving without AJAX
		}elseif(!empty($this->request->data)){
			$user = $this->Session->read("Auth.User");
			$uid =  $user['id'];
			$this->set('uid', $uid);
			$err = array();
			if(isset($this->request->data['Gallery']['name']) && !empty($this->request->data['Gallery']['name'])){
				if(preg_match('/[A-Za-z0-9]+/', $this->request->data['Gallery']['name'])){
					$err['name'] = false;
				}else{
					$err['name'] = 'pregmatch';
				}
			}else{
				$err['name'] = true;
			}
			$user_galleries = $this->Gallery->getList($uid);
			$this->set('options', $user_galleries);
			if(isset($this->request->data['Gallery']['gallery_id']) && !empty($this->request->data['Gallery']['gallery_id']) && isset($user_galleries[$this->request->data['Gallery']['gallery_id']]) && !empty($user_galleries[$this->request->data['Gallery']['gallery_id']])){
				$err['gallery_id'] = false;
			}else{
				$err['gallery_id'] = true;
			}
			$err['image'] = false;
			if(!$err['name'] && !$err['gallery_id']){
				if(isset($this->request->data['Gallery']['file']) && !empty($this->request->data['Gallery']['file'])){
					$info = pathinfo($this->data['Gallery']['file']['name']);
					$new_name = time().'.'.strtolower($info['extension']);
					move_uploaded_file(
						$this->data['Gallery']['file']['tmp_name'],
						WWW_ROOT . 'img'.DS.'uploads' . DS .$this->request->data['Gallery']['gallery_id'] .DS.'small'.DS.$new_name
					);
					unset($this->request->data['Gallery']['file']);
					$data['Image']=$this->request->data['Gallery'];
					$data['Image']['src'] = $new_name;
					$this->loadModel('Image');
					$this->Image->save($data);
					$this->redirect("/galleries/user_gallery");
				}else{
					$err['image'] = true;
				}
			}
			echo 'Jus suklydote ivesdami informacija. Nuotraukos pavadinimas turi buti be tarpu, tik lotyniskos raides ir skaitmenys. ';
			debug($this->request->data);
			echo 'Klaidos. True - padaryta toje vietoje klaida.';
			debug($err);
			$this->set('successful', false);
			$this->set('errors', $err);
			$this->set('data', $this->request->data);
			$this->layout = 'ajax';
			$this->autoRender = false;
		}else{
			$this->redirect("/");
		}
	}
}
?>