<?php
    class Upload extends AppModel {
		var $name = 'Upload';
		var $useTable = false;

		public function afterPaginate($data, $slider_id=null){
			// App::import('model','Slider');
			// $Slider = new Slider();
			// if($slider_id){
				// $n_key=0;
				// foreach($data as $key=> $item){	
					// if($item['Frame']['slider_id']==$slider_id){
						// $item['Frame']['slider_id']=$Slider->getSliderName($item['Frame']['slider_id']);
						// unset($data[$key]);
						// $data[$n_key]=$item;
						// $n_key++;
					// }
					// else{
						// unset($data[$key]);
					// }
				// }
			// }
			// else{
				// foreach($data as $key=> $item){
					// $item['Frame']['slider_id']=$Slider->getSliderName($item['Frame']['slider_id']);
					// $data[$key]=$item;
				// }
			// }
			return $data;
		}
		public function getAddFields() {
			// App::import('model', 'Slider');
			// $Slider = new Slider();
			// $fields = array(
				// 'Frame.name' => array(
					// 'type' => 'text'
				// ),
				// 'Frame.slider_id'=> array(
					// 'type' => 'select',
					// 'options' => $Slider->getList()
				// ),
				// 'Frame.type' => array(
					// 'type' => 'select',
					// 'options' => array(
						// 'image' => 'image',
						// 'video' => 'video'
					// )
				// ),
				// 'Frame.image' => array(
					// 'type' => 'file',
					// 'class' => 'frame_image_upload edit_image_upload'
				// ),
				// 'Frame.src' => array(
					// 'type' => 'text',
					// 'class' => 'video_src'
				// ),
				// 'Frame.url' => array(
					// 'type' => 'text',
					// 'label' => 'Link'
				// ),
				// 'Frame.expiration' => array(
					// 'type' => 'date'
				// ),
			// );
			// $fields['published'] = array('type' => 'checkbox');
			// return $fields;
		}		
    }
    ?>