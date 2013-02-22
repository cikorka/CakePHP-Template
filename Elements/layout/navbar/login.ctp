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

?>
<?php if (class_exists('AuthComponent') && AuthComponent::user()) :	?>

	<p class="navbar-text pull-right">

		<?php echo __('Logged in as'); ?>

		<?php echo $this->Html->link(AuthComponent::user('username'), array('controller' => 'users', 'action' => 'profile'), array('class' => 'navbar-link', 'onclick' => "_gaq.push(['_trackEvent', 'Videos', 'Play', 'Baby\'s First Birthday']);", 'escape' => false)); ?>

		<?php echo $this->Html->link('<i class="icon-off"></i>', array('controller' => 'users', 'action' => 'logout'), array('escape' => false, 'class' => 'navbar-link')); ?>

	</p>

<?php else : ?>

	<?php echo $this->Form->create('User', array('class' => 'navbar-form pull-right', 'url' => array('controller' => 'users', 'action' => 'login'))); ?>
	<?php echo $this->Form->input('username', array('class' => 'span2', 'div' => false, 'label' => false)); ?>
	<?php echo $this->Form->input('password', array('class' => 'span2','div' => false, 'label' => false)); ?>
	<?php echo $this->Form->submit(__d('app_users', 'Login'), array('class' => 'btn','div' => false, 'label' => false)); ?>
	<?php echo $this->Form->end(); ?>

<?php endif; ?>
