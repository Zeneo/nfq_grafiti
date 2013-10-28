 <div id="slider" class="nivoSlider">
	<?php
	if(!empty($slider) && isset($slider)){
		foreach($slider as $slide){
			echo '<img src="'.$full_url.'/'.$slide.'" alt="works"/>';
		}	
	}
	?>
 </div>