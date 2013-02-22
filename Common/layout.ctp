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

$this->extend('/Common/content');

if ($this->fetch('aside.left')) {
	$this->extend('/Common/Aside/left');
} elseif ($this->fetch('aside.right')) {
	$this->extend('/Common/Aside/right');
}

if ($this->fetch('aside.left') && $this->fetch('aside.right')) {
	$this->extend('/Common/Aside/both');
}

echo $this->fetch('content');