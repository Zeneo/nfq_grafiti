<div class="gallery_menu">
	<?php if(!empty($gallery_menu)  && isset($gallery_menu)){
		foreach($gallery_menu as $action){
			if($action['active']){
				echo '<li>'.$this->Html->link($action['title'], array('controller' => $action['module'], 'action' => $action['action']), array('id' => $action['id'])).'</li>';
			}else{
				echo '<li>'.$this->Html->link($action['title'], '#', array('id' => $action['id'])).'</li>';
			}
		}
	}?>
</div>
<div class="galleries">
	<?php foreach($galleries as $gallery){
		echo '<div class="gallery_cnt1"><div class="gallery_title">'.$gallery['Gallery']['name'].'</div><div class="no-float"></div><div class="gallery_folder">';
		foreach($gallery['Image'] as $image){
			echo '<div class="gallery_img">'.$this->Html->image('uploads/'.$gallery['Gallery']['id'].'/small/'.$image['src'], array('alt' =>$image['name'])).'</div>';
		}
		echo '</div></div>';
	
	}?>
</div>