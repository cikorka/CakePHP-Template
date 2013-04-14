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

	$this->extend('/Common/container');

if ($this->fetch('sidebar.left')) {
	$this->extend('/Common/Sidebar/left');
} elseif ($this->fetch('sidebar.right')) {
	$this->extend('/Common/Sidebar/right');
}

if ($this->fetch('sidebar.left') && $this->fetch('sidebar.right')) {
	$this->extend('/Common/Sidebar/both');
}

?>
<section>

	<?php if ($this->fetch('header')) : ?>
	<header>
		<?php echo $this->fetch('header'); ?>
	</header>
	<?php endif; ?>

	<article>
		<?php echo $this->fetch('content'); ?>
	</article>

	<?php if ($this->fetch('footer')) : ?>
	<footer>
		<?php echo $this->fetch('footer'); ?>
	</footer>
	<?php endif; ?>

</section>