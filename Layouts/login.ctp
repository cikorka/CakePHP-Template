<?php

/**
 *
 * PHP 5
 *
 * Petr Jeřábek : CakePHP HTML5 Boilerplate Bootstrap Theme
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright	Copyright 2013, Petr Jeřábek  (http://github.com/cikorka)
 * @license		MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link		https://github.com/cikorka/CakePHP-Template
 */

?>
<!DOCTYPE html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>		    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>		    <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js"> <!--<![endif]-->
	<head>
		<?php
			echo $this->Html->tag('title', $title_for_layout);
			echo $this->Html->charset();
			echo $this->Html->meta(array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1'));
			echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width'));
			echo $this->Html->meta(array('name' => 'robots', 'content' => 'index,follow'));
			echo $this->fetch('meta');
			echo $this->Html->meta('icon');
			echo $this->element('layout/apple_touch_icons');

		/**
		 * If you would this template without FontAwesome, uncomment this line
		 */
			//echo $this->Html->css('bootstrap');

		/**
		 * Bootstrap with Font Awesome icons and IE7 Font Awesome stylesheets
		 */
			echo $this->Html->css('bootstrap-font-awesome');
			echo sprintf('<!--[if IE 7]>%s<![endif]-->', $this->Html->css('font-awesome-ie7'));

			echo $this->Html->css('bootstrap-responsive');
			echo $this->Html->css('main');
			echo $this->Html->css('splash');
			echo $this->Html->script('vendor/modernizr-2.6.2.min');

		?>
	</head>
	<body>

		<div class="container">
			<?php echo $this->fetch('content'); ?>
		</div>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<?php
			echo $this->Html->scriptBlock("window.jQuery || document.write('" . str_replace('/script', '\/script', $this->Html->script('vendor/jquery-1.9.1.min')) . "');");
			echo $this->Html->script('vendor/bootstrap.min');
			echo $this->Html->script('plugins');
			echo $this->Html->script('main');
			echo $this->fetch('css');
			echo $this->fetch('script');
			//echo $this->element('google/analytics', array('account' => 'UA-XXXXX-X'));
			echo $this->Js->writeBuffer();
		?>
	</body>
</html>