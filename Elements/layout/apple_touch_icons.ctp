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

/**
 * Apple Touch Icons
 *
 * @link http://developer.apple.com/library/safari/#documentation/appleapplications/reference/safariwebcontent/ConfiguringWebApplications/ConfiguringWebApplications.html
 */
echo $this->Html->meta(array('rel' => 'apple-touch-icon', 'href' => $this->Html->assetUrl('/apple-touch-icon.png')));
echo $this->Html->meta(array('rel' => 'apple-touch-icon-precomposed', 'href' => $this->Html->assetUrl('apple-touch-icon-precomposed.png')));
echo $this->Html->meta(array('rel' => 'apple-touch-icon-precomposed', 'sizes'=>'57x57', 'href' => $this->Html->assetUrl('/apple-touch-icon-57x57-precomposed.png')));
echo $this->Html->meta(array('rel' => 'apple-touch-icon-precomposed', 'sizes'=>'72x72', 'href' => $this->Html->assetUrl('/apple-touch-icon-72x72-precomposed.png')));
echo $this->Html->meta(array('rel' => 'apple-touch-icon-precomposed', 'sizes'=>'114x114', 'href' => $this->Html->assetUrl('/apple-touch-icon-114x114-precomposed.png')));
echo $this->Html->meta(array('rel' => 'apple-touch-icon-precomposed', 'sizes'=>'144x144', 'href' => $this->Html->assetUrl('/apple-touch-icon-144x144-precomposed.png')));
