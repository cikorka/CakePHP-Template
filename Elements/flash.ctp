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
 * @copyright   Copyright 2013, Petr Jeřábek  (http://github.com/cikorka)
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link        https://github.com/cikorka/CakePHP-Template
 */

if ($this->Session->read('Message.flash.element') == 'default') {
	echo $this->Session->flash('flash', array('element' => 'flash/default'));
} else {
	echo $this->Session->flash();
}

echo $this->Session->flash('auth', array('element' => 'flash/default'));
