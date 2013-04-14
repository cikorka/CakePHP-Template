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

$batch = $this->Helpers->enabled('Batch');

if ($batch === true) {
	$this->Html->script('/batch/js/jquery', array('inline' => false));
	//$this->Html->css('/batch/css/batch', array(), array('inline' => false));
}

$this->extend('Common/layout');

$lOpt = array('escape' => false);

/**
 * Exlude fields for hasMany and hasAndBelongsToMany associated models
 */
	$exclude = array('created', 'modified', 'lft', 'rght');
	foreach ($exclude as $field) {
		${$singularVar} = Hash::remove(${$singularVar}, '{s}.{n}.' . $field);
	}
?>

<?php $this->start('header'); ?>
<div class="page-header">
	<h1>
		<?php echo __d('cake', 'View %s', $singularHumanName); ?>
	</h1>
</div>

<div class="navbar subnav">
	<div class="navbar-inner">
		<ul class="nav">
			<?php

				echo "\t\t<li>";
				echo $this->Html->link('<i class="icon-list"></i>' . __d('cake', 'List %s', $pluralHumanName), array('action' => 'index'), $lOpt);
				echo " </li>\n";

				echo "\t\t<li>";
				echo $this->Html->link('<i class="icon-edit"></i>' . __d('cake', 'Edit %s', $singularHumanName),   array('action' => 'edit', ${$singularVar}[$modelClass][$primaryKey]), $lOpt);
				echo " </li>\n";

				echo "\t\t<li>";
				echo $this->Form->postLink('<i class="icon-trash"></i>' . __d('cake', 'Delete %s', $singularHumanName), array('action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]), $lOpt, __d('cake', 'Are you sure you want to delete').' #' . ${$singularVar}[$modelClass][$primaryKey] . '?');
				echo " </li>\n";

				echo "\t\t<li>";
				echo $this->Html->link('<i class="icon-plus-sign"></i>' . __d('cake', 'New %s', $singularHumanName), array('action' => 'add'), $lOpt);
				echo " </li>\n";
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



<div class="<?php echo $pluralVar; ?> view">
	<dl class="dl-horizontal">
		<?php
		$i = 0;
		foreach ($scaffoldFields as $_field) {
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $_alias => $_details) {
					if ($_field === $_details['foreignKey']) {
						$isKey = true;
						echo "\t\t<dt>" . Inflector::humanize($_alias) . "</dt>\n";
						echo "\t\t<dd>\n\t\t\t";
						echo $this->Html->link(
							${$singularVar}[$_alias][$_details['displayField']],
							array('plugin' => $_details['plugin'], 'controller' => $_details['controller'], 'action' => 'view', ${$singularVar}[$_alias][$_details['primaryKey']])
						);
						echo "\n\t\t&nbsp;</dd>\n";
						break;
					}
				}
			}
			if ($isKey !== true) {
				echo "\t\t<dt>" . Inflector::humanize($_field) . "</dt>\n";
				echo "\t\t<dd>" . h(${$singularVar}[$modelClass][$_field]) . "&nbsp;</dd>\n";
			}
		}
		?>
	</dl>
</div>

<?php
if (!empty($associations['hasOne'])) :
foreach ($associations['hasOne'] as $_alias => $_details): ?>
<div class="related">
	<h3><?php echo __d('cake', "Related %s", Inflector::humanize($_details['controller'])); ?></h3>
<?php if (!empty(${$singularVar}[$_alias])): ?>
	<dl class="dl-horizontal">
<?php
		$i = 0;
		$otherFields = array_keys(${$singularVar}[$_alias]);
		foreach ($otherFields as $_field) {
			echo "\t\t<dt>" . Inflector::humanize($_field) . "</dt>\n";
			echo "\t\t<dd>\n\t" . ${$singularVar}[$_alias][$_field] . "\n&nbsp;</dd>\n";
		}
?>
	</dl>
<?php endif; ?>
	<div class="actions">
		<ul>
		<li><?php
			echo $this->Html->link(
				__d('cake', 'Edit %s', Inflector::humanize(Inflector::underscore($_alias))),
				array('plugin' => $_details['plugin'], 'controller' => $_details['controller'], 'action' => 'edit', ${$singularVar}[$_alias][$_details['primaryKey']])
			);
			echo "</li>\n";
			?>
		</ul>
	</div>
</div>
<?php
endforeach;
endif;

if (empty($associations['hasMany'])) {
	$associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
	$associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
$i = 0;
?>

<div class="tabbable<?php if (count($relations) > 6) echo ' tabs-left';?>">
	<ul class="nav nav-tabs">
		<?php
		$yi = 0;
		foreach ($relations as $_alias => $_details):
		$active = ($yi === 0) ? 'active' : '';
		$yi++;

		// remove alias foreign key
		${$singularVar}[$_alias] = Hash::remove(${$singularVar}[$_alias], '{n}.' . $_details['foreignKey']);
		?>
			<li class="<?php echo $active; ?>">
				<a href="#<?php echo Inflector::variable($_alias); ?>" data-toggle="tab">
					<?php echo $this->Html->useTag(str_replace('_', null, strtolower($_details['controller']))); ?>
					<?php echo Inflector::humanize($_alias); ?>
					<span class="badge badge-info<?php if (count($relations) > 6) echo ' pull-right';?>"><?php echo count(${$singularVar}[$_alias]); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>


	<div class="tab-content">
		<?php
		$yi = 0;
		foreach ($relations as $_alias => $_details):
		$otherSingularVar = Inflector::variable($_alias);
		$active = ($yi === 0) ? ' active' : '';
		$yi++;
		?>
		<div class="tab-pane<?php echo $active; ?>" id="<?php echo $otherSingularVar; ?>">
			<!-- <h3><?php echo __d('cake', "Related %s", Inflector::humanize($_details['controller'])); ?></h3> -->
		<?php if (!empty(${$singularVar}[$_alias])): ?>

			<?php if ($batch === true) echo $this->Batch->create($_alias); ?>

			<table class="table table-striped">
				<tr>

					<?php if ($batch === true) : ?>
						<th width="1">
							<?php echo $this->Batch->all(); ?>
						</th>
					<?php endif; ?>

					<?php
						$otherFields = array_keys(${$singularVar}[$_alias][0]);
						if (isset($_details['with'])) {
							$index = array_search($_details['with'], $otherFields);
							unset($otherFields[$index]);
						}
						foreach ($otherFields as $_field) {
							echo "\t\t<th>" . Inflector::humanize($_field) . "</th>\n";
						}
					?>
					<th width="10" class="actions">Actions</th>
				</tr>

				<?php

				if ($batch === true) {
					$batchFields = array(null => array());
					foreach ($otherFields as $field) {
						$options = array();
						if (isset($this->Form->fieldset[$_alias]['fields'][$field]['type'])) {
							switch ($this->Form->fieldset[$_alias]['fields'][$field]['type']) {
								case 'string':
								case 'text':
									$var = isset($_batch) ? $_batch : ${$singularVar}[$_alias];
									$source = Hash::normalize(Hash::extract($var, '{n}.' . $_alias . '.' . $field));
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

				<?php
					$i = 0;
					foreach (${$singularVar}[$_alias] as ${$otherSingularVar}):
						echo "\t\t<tr>\n";

						if ($batch === true) {
							echo "<td>" . $this->Batch->checkbox(${$otherSingularVar}[$primaryKey]) . "</td>";
						}

						foreach ($otherFields as $_field) {

							$cell = h(String::truncate(${$otherSingularVar}[$_field], 100));
							if (is_bool(${$otherSingularVar}[$_field])) {
								if (${$otherSingularVar}[$_field] === true) {
									$cell = '<div class="text-center text-success"><i class="icon-ok"></i></div>';
								} else {
									$cell = '<div class="text-center text-error"><i class="icon-remove"></i></div>';
								}
							}

							echo "\t\t\t<td>" . $cell . "</td>\n";
						}

						echo "\t\t\t<td class=\"actions\">\n";
						echo "\t\t\t\t";
						echo '<div class="btn-group">';
						echo $this->Html->link(
							'<i class="icon-eye-open"></i>', //__d('cake', 'View'),
							array('plugin' => $_details['plugin'], 'controller' => $_details['controller'], 'action' => 'view', ${$otherSingularVar}[$_details['primaryKey']]),
							array('escape' => false, 'class' => 'btn', 'title' => __d('cake', 'View'))
						);
						echo "\n";
						echo "\t\t\t\t";
						echo $this->Html->link(
							'<i class="icon-pencil"></i>', //__d('cake', 'Edit'),
							array('plugin' => $_details['plugin'], 'controller' => $_details['controller'], 'action' => 'edit', ${$otherSingularVar}[$_details['primaryKey']]),
							array('escape' => false, 'class' => 'btn', 'title' => __d('cake', 'Edit'))
						);
						echo "\n";
						echo "\t\t\t\t";
						echo $this->Form->postLink(
							'<i class="icon-trash"></i>', //__d('cake', 'Delete'),
							array('plugin' => $_details['plugin'], 'controller' => $_details['controller'], 'action' => 'delete', ${$otherSingularVar}[$_details['primaryKey']]),
							array('escape' => false, 'class' => 'btn', 'title' => __d('cake', 'Delete')),
							__d('cake', 'Are you sure you want to delete', true) .' #' . ${$otherSingularVar}[$_details['primaryKey']] . '?'
						);
						echo "\n";
						echo '</div>';
						echo "\t\t\t</td>\n";
					echo "\t\t</tr>\n";
					endforeach;
				?>

				<?php
					if ($batch === true) {
						if (array_search($primaryKey, $scaffoldFields) !== false) {
							unset($otherFields[array_search($primaryKey, $otherFields)]);
						}
						echo $this->Batch->batch(array_merge(array(null, null), $otherFields));
					}
				?>

			</table>

			<?php if ($batch === true) echo $this->Batch->end(); ?>

		<?php endif; ?>
			<div class="actions">
				<ul class="nav nav-pills">
					<li>
						<?php echo $this->Html->link(
							__d('cake', "List %s", Inflector::pluralize(Inflector::underscore($_alias))),
							array('plugin' => $_details['plugin'], 'controller' => $_details['controller'])
							); ?>
					</li>
					<li>
						<?php echo $this->Html->link(
							__d('cake', "New %s", Inflector::humanize(Inflector::underscore($_alias))),
							array('plugin' => $_details['plugin'], 'controller' => $_details['controller'], 'action' => 'add')
							); ?>
					</li>
				</ul>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
