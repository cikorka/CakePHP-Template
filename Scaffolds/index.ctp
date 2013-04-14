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

$batch = $this->Helpers->enabled('Batch');

if ($batch === true) {
	$this->Html->script('/batch/js/jquery', array('inline' => false));
	//$this->Html->css('/batch/css/batch', array(), array('inline' => false));
}

$this->extend('Common/layout');

$lOpt = array('escape' => false);

$exclude = array('created', 'modified', 'deleted', 'lft', 'rght');
foreach ($exclude as $unset) {
	if ($key = array_search($unset, $scaffoldFields)) {
		unset($scaffoldFields[$key]);
	}
}

?>

<?php $this->start('header'); ?>
<div class="page-header">
	<h1>
		<?php echo __($pluralHumanName); ?>
	</h1>
	<span class="badge badge-info pull-right"><?php echo $this->Paginator->counter('{:count}'); ?></span>
</div>

<div class="navbar subnav">
	<div class="navbar-inner">
		<ul class="nav">
			<li>
				<?php echo $this->Html->link($this->Html->useTag('icon', 'plus-sign') . __('New %s', $singularVar), array('action' => 'add'), $lOpt); ?>
			</li>
		</ul>

		<?php if (!empty($associations)) : ?>
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
		<?php endif; ?>
	</div>
</div>
<?php $this->end(); ?>

<!--nocache-->
<?php echo $this->element('flash'); ?>
<!--/nocache-->

<ul class="inline muted pull-right">
	<li><i class="icon-reorder"></i><?php echo __('Show'); ?></li>
	<li><?php echo $this->Paginator->link(20, array('limit' => 20)); ?></li>
	<li><?php echo $this->Paginator->link(100, array('limit' => 100)); ?></li>
	<li><?php echo $this->Paginator->link(1000, array('limit' => 1000)); ?></li>
</ul>

<div class="clearfix"></div>

<?php if ($batch === true) echo $this->Batch->create($modelClass); ?>

<table class="table table-bordered table-striped">
	<tr>
		<?php if ($batch === true) : ?>
			<th width="1">
				<?php echo $this->Batch->all(); ?>
			</th>
		<?php endif; ?>
		<?php foreach ($scaffoldFields as $_field) : ?>
			<th <?php echo ($_field === $primaryKey) ? 'width="1"' : null; ?>>
				<?php echo $this->Paginator->sort($_field);?>
			</th>
		<?php endforeach;?>
		<th width="10">
			<?php echo __d('cake', 'Actions');?>
		</th>
	</tr>

<?php

if ($batch === true) {
	$batchFields = array(null => array());
	foreach ($scaffoldFields as $field) {
		$options = array();
		if (isset($this->Form->fieldset[$modelClass]['fields'][$field]['type'])) {
			switch ($this->Form->fieldset[$modelClass]['fields'][$field]['type']) {
				case 'string':
				case 'text':
					$var = isset($_batch) ? $_batch : ${$pluralVar};
					$source = Hash::normalize(Hash::extract($var, '{n}.' . $modelClass . '.' . $field));
					unset($source[""]);
					$source = array_keys($source);
					if (!empty($source)) {
						$options = array('data-provide' => 'typeahead', 'data-source' => json_encode($source));
					}
				break;
			}
		}
		$batchFields[$field] = $options;
	}
	echo $this->Batch->filter($batchFields);
}

?>
	<tbody>
		<?php if (empty(${$pluralVar})) : ?>
			<tr class="warning">
				<td colspan="<?php echo count(array_keys($scaffoldFields)) + 2; ?>">
					<div style="text-align: center;">
						<?php echo __('No results found'); ?>
					</div>
				</td>
			</tr>
		<?php endif; ?>

		<?php
		$i = 0;
		foreach (${$pluralVar} as ${$singularVar}):
			echo "<tr>";

			if ($batch === true) {
				echo "<td>" . $this->Batch->checkbox(${$singularVar}[$modelClass][$primaryKey]) . "</td>";
			}

			foreach ($scaffoldFields as $_field) {
				$isKey = false;
				if (!empty($associations['belongsTo'])) {
					foreach ($associations['belongsTo'] as $_alias => $_details) {
						if ($_field === $_details['foreignKey']) {
							$isKey = true;
							echo "<td>" . $this->Html->link(${$singularVar}[$_alias][$_details['displayField']], array('controller' => $_details['controller'], 'action' => 'view', ${$singularVar}[$_alias][$_details['primaryKey']])) . "</td>";
							break;
						}
					}
				}
				if ($isKey !== true) {
					$cell = h(String::truncate(${$singularVar}[$modelClass][$_field], 100));
					if (is_bool(${$singularVar}[$modelClass][$_field])) {
						if (${$singularVar}[$modelClass][$_field] === true) {
							$cell = '<div class="text-center text-success"><i class="icon-ok"></i></div>';
						} else {
							$cell = '<div class="text-center text-error"><i class="icon-remove"></i></div>';
						}
					}
					echo "<td>" . $cell . "</td>";
				}
			}

			echo '<td class="actions">';
			echo '<div class="btn-group pull-right">';
			echo $this->Html->link(
				'<i class="icon-eye-open"></i>',
				array('action' => 'view', ${$singularVar}[$modelClass][$primaryKey]),
				array('escape' => false, 'class' => 'btn', 'title' => __d('cake', 'View'))
			);
			echo $this->Html->link(
				'<i class="icon-pencil"></i>',
				array('action' => 'edit', ${$singularVar}[$modelClass][$primaryKey]),
				array('escape' => false, 'class' => 'btn', 'title' => __d('cake', 'Edit'))
			);
			if ($batch !== true) {
				echo $this->Form->postLink(
					'<i class="icon-trash"></i>',
					array('action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]),
					array('class' => 'btn', 'title' => __d('cake', 'Delete'), 'escape' => false),
					__d('cake', 'Are you sure you want to delete').' #' . ${$singularVar}[$modelClass][$primaryKey]
				);
			}
			echo '</div>';
			echo '</td>';
			echo '</tr>';
		endforeach;
		?>
	</tbody>
		<?php
			if ($batch === true) {
				if (array_search($primaryKey, $scaffoldFields) !== false) {
					unset($scaffoldFields[array_search($primaryKey, $scaffoldFields)]);
				}
				echo $this->Batch->batch(array_merge(array(null, null), $scaffoldFields));
			}
		?>
</table>

<?php if ($batch === true) echo $this->Batch->end(); ?>

<div class="pagination pagination-large">
	<?php echo $this->Paginator->numbers(array('first' => __('First page'), 'last' => __('Last page'))); ?>
</div>
<div class="muted">
	<?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}'))); ?>
</div>
