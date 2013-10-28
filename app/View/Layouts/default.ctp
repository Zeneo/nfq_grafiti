<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $basic['site_title']; ?>
	</title>
	<?php
	
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('basic', 'main', 'slider'));
	?>
</head>
<body>
	<div class="container">
		<div class="main">
			<div class="lamp">
				<div class="lamp_on"></div>
				<div class="lamp_off"></div>
			</div>
			<div class="top">
				<div class="login_cnt1">
					<?php if(!$logged){ ?>
					<div class="login_cnt2">
						<div class="login_cnt3">
							<div class="login_menu_invisible">
								<div class="login_form">
									<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))); ?>
									<?php echo $this->Form->input('username', array('label' => 'Vartoto vardas')); ?>
									<?php echo $this->Form->input('password', array('label' => 'Slaptazodis')); ?>
									<?php echo $this->Form->end(); ?>
								</div>
								<a class="register" href="#">Registracija</a>
								<a class="login" href="#">Prisijungti</a>
								<div class="no-float"></div>
							</div>
						</div>
						<div class="login_light">
						</div>
						<div class="login_menu2">
							<a class="register" href="#">Registracija</a>
							<a class="login" href="#">Prisijungti</a>
						</div>
					</div>
					<?php }else{ ?>
						<div class="login_cnt2">
						<div class="login_cnt3">
							<div class="login_menu_invisible">
								<?php echo $this->Html->link($user, array('controller' => 'users', 'action' => 'logout'), array('class' => 'logged'));?>
								<div class="no-float"></div>
							</div>
						</div>
						<div class="login_light">
						</div>
						<div class="login_menu2">
							<?php echo $this->Html->link($user, array('controller' => 'users', 'action' => 'logout'), array('class' => 'logged'));?>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="main_menu_cnt1">
					<div class="main_menu_l"></div>
					<div class="main_menu_cnt2">
					<?php if(!empty($topmenu) && isset($topmenu)){ ?>
						<ul class="main_menu">
							<?php foreach($topmenu as $item){
								if($item['MenuItem']['active']){
									if($item['MenuItem']['module']){
										echo '<li>'.$this->Html->link($item['MenuItem']['title'], array('controller' => $item['MenuItem']['module'], 'action' => $item['MenuItem']['alias'])).'</li>';
									}elseif($item['MenuItem']['url']){
										echo '<li>'.$this->Html->link($item['MenuItem']['title'], $item['MenuItem']['url']).'</li>';
									}else{
										echo '<li>'.$item['MenuItem']['title'].'</li>';
									}
								}else{
									echo '<li>'.$this->Html->link($item['MenuItem']['title'], '#').'</li>';
								}
							 } 
							 if($logged){
								echo '<li>'.$this->Html->link('Mano galerija', array('controller' => 'galleries', 'action' => 'user_gallery'), array('class' => 'logged')) .'<li>';
							 }
							 ?>
						</ul>
					<?php } ?>					
					</div>
					<div class="main_menu_r"></div>
				</div>
			</div>
			<div class="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<div class="footer">
			<div class="ft_l">&nbsp;</div>
			<div class="ft_cnt">
				<?php if(!empty($footermenu) && isset($footermenu)){ ?>          
					<ul class="ft_menu">
					<?php foreach($footermenu as $item){ ?>
							<?php 
							if($item['MenuItem']['active']){
								if(isset($item['MenuItem']['module']) && !empty($item['MenuItem']['module'])){
									if($item['MenuItem']['module'] == 'rights'){
										echo  '<li class="rights">'.$item['MenuItem']['title'].'</li>';
									}else{
										echo  '<li>'.$this->Html->link($item['MenuItem']['title'], '/'.$item['MenuItem']['module'].'/'.$item['MenuItem']['alias']).'</li>';
									}
								}
								elseif($item['MenuItem']['url']!=null && isset($item['MenuItem']['url'])){
									echo '<li>'.$this->Html->link($item['MenuItem']['title'], $item['MenuItem']['url']).'</li>'; 
								}else{
									echo '<li>'.$item['MenuItem']['title'].'</li>';
								}
							}else{
								echo '<li>'.$this->Html->link($item['MenuItem']['title'], '#').'</li>';
							}
							?>
					<?php }?>
					</ul>
				<?php } ?>
			</div>
			<div class="ft_r">&nbsp;</div>
		</div>
	</div>
	<?php
		echo $this->Html->script(array('jquery', 'js','bxslider.min'));
	?>
</body>
</html>
