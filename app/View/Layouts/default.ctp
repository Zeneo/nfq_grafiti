<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapclass Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapclass development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $basic['title']; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('basic', 'main'));
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
					<div class="login_cnt2">
						<div class="login_cnt3">
							<div class="login_menu_invisible">
								<a id="register" href="#">Registracija</a>
								<a id="login" href="#">Prisijungti</a>
								<div class="no-float"></div>
							</div>
						</div>
						<div class="login_light">
				
						</div>
						<div class="login_menu2">
							<a id="register" href="#">Registracija</a>
							<a id="login" href="#">Prisijungti</a>
						</div>
					</div>
				</div>
				<div class="main_menu_cnt1">
					<div class="main_menu_l"></div>
					<div class="main_menu_cnt2">
					<ul class="main_menu">
						<li><a href="#">Pagrindinis</a></li>
						<li><a href="#">Galerija</a></li>
						<li><a href="#">Naujienos</a></li>
						<li><a href="#">Renginiai</a></li>
					</ul>					
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
				
					<ul class="ft_menu">
					<li>Apie mus</li>
					<li>Kontaktai</li>
					<li class="rights">2013 Paulius Navickas. Visos teises saugomos</li>
					<?php 
				if(!empty($ft_menu) && isset($ft_menu)){ ?>          //Kol nera sukurtas pats listas
					<?php foreach($ft_menu as $menuitem){ ?>
						<li>
							<?php 
							if(isset($menuitem['MenuItem']['module']) && !empty($menuitem['MenuItem']['module'])){
								echo  $this->Html->link($menuitem['MenuItem']['title'], '/'.Configure::read('Config.languageSite').'/'.$menuitem['MenuItem']['module'].'/'.$menuitem['MenuItem']['alias']);
							}
							elseif($menuitem['MenuItem']['url']!=null && isset($menuitem['MenuItem']['url'])){
								echo $this->Html->link($menuitem['MenuItem']['title'], $menuitem['MenuItem']['url']); 
							}else{
								echo $menuitem['MenuItem']['title'];
							}
							?>
						</li>	
					<?php }?>
				<?php } ?>
					</ul>
			</div>
			<div class="ft_r">&nbsp;</div>
		</div>
	</div>
	<?php
		echo $this->Html->script('nivo');
	?>
</body>
</html>
