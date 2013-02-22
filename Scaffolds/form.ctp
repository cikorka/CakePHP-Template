<?php

/**
 *
 * PHP 5
 *
 * Petr Jeřábek : CakePHP HTML5 Boilerplate Bootstrap Theme
 * Copyright 2013, Petr Jeřábek (http://github.com/cikorka)
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright   Copyright 2013, Petr Jeřábek  (http://github.com/cikorka)
 * @copyright   Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link        https://github.com/cikorka/CakePHP-Template
 * @link        http://cakephp.org CakePHP(tm) Project
 * @package     Cake.View.Scaffolds
 * @since       CakePHP(tm) v 0.10.0.1076
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Hash', 'Utility');

$this->extend('/Common/layout');

$lOpt = array('escape' => false);

?>

<?php $this->start('header'); ?>

<div class="page-header">
	<h1>
		<?php if (strpos($this->action, 'add') === false) : ?>
			<?php echo __d('cake', 'Edit %s', $singularHumanName); ?>
		<?php else : ?>
			<?php echo __d('cake', 'Add %s', $singularHumanName); ?>
		<?php endif; ?>
	</h1>
</div>

<div class="navbar subnav">
	<div class="navbar-inner">
		<ul class="nav">
			<?php
				echo "\t\t<li>";
				echo $this->Html->link('<i class="icon-list"></i>' . __d('cake', 'List %s', $pluralHumanName), array('action' => 'index'), $lOpt);
				echo " </li>\n";

				if (strpos($this->action, 'add') === false) {
					echo "\t\t<li>";
					echo $this->Form->postLink(__d('cake', 'Delete %s', $singularHumanName), array('action' => 'delete', $this->Form->value($modelClass . '.' . $primaryKey)), null, __d('cake', 'Are you sure you want to delete').' #' . $this->Form->value($modelClass . '.' . $primaryKey) . '?');
					echo " </li>\n";
				}
			?>
		</ul>

		<ul class="nav pull-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="icon-share-alt"></i>
					<?php echo __('Related'); ?>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<?php
						$done = array();
						foreach ($associations as $type => $data) {
							foreach ($data as $alias => $details) {
								if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) : ?>
									<li class="dropdown-submenu">
										<?php echo $this->Html->link(sprintf('%s %s', $this->Html->useTag(str_replace('_', null, strtolower($details['controller']))), __(Inflector::humanize($details['controller']))), array('controller' => $details['controller'], 'action' => 'index'), $lOpt); ?>
										<ul class="dropdown-menu">
											<li>
												<?php echo $this->Html->link(sprintf('%s %s', $this->Html->useTag('icon', 'list'), __('List ' . Inflector::humanize($details['controller']))), array('controller' => $details['controller'], 'action' => 'index'), $lOpt); ?>
											</li>
											<li>
												<?php echo $this->Html->link(sprintf('%s %s', $this->Html->useTag('icon', 'plus-sign'), __('New ' . Inflector::humanize(Inflector::underscore($alias)))), array('controller' => $details['controller'], 'action' => 'add', 'redirect' => urlencode($this->Html->url())), $lOpt); ?>
											</li>
										</ul>
									</li>
								<?php endif;
							}
						}
					?>
				</ul>
			</li>
		</ul>
	</div>
</div>
<?php $this->end(); ?>


<?php
$exclude = array('created', 'modified', 'deleted', 'lft', 'rght');

$scaffoldFields = Hash::normalize($scaffoldFields);
foreach ($scaffoldFields as $name => $value) {
	$scaffoldFields[$name] = array('empty' => true);
}

echo $this->Form->create(null, array('class' => 'form-horizontal'));
echo $this->Form->inputs($scaffoldFields, $exclude);
echo $this->Form->end(__('Submit'));

?>
