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

/**
 * If exist file logo.png in your theme webroot or app webroot, logo is render, otherwise domain name render
 *
 * You can force attach logo: `echo $this->element('layout/logo', array('logo' => 'path/to/your_logo'));`
 */

$root = isset($this->request->params['prefix']) ? $this->request->params['prefix'] : null;

$linkName = $this->request->domain();
if (
	file_exists(App::themePath($this->theme) . WEBROOT_DIR . DS . 'img' . DS . 'logo.png') ||
	file_exists(APP . WEBROOT_DIR . DS . 'img' . DS . 'logo.png') ||
	isset($logo)
) {
	if (isset($logo) && empty($logo) || !isset($logo)) {
		$logo = 'logo.png';
	}
	$linkName = $this->Html->image($logo, array('alt' => $linkName));
}

echo $this->Html->link($linkName, '/' . $root, array('escape' => false, 'class' => 'brand'));
