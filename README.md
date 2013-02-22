# CakePHP HTML5 Boilerplate Bootstrap Theme

HTML5 Boilerplate Starter Template with Bootstrap stylesheets adapted for using as CakePHP Theme

* HTML5 Boilerplate v4.1.0
* Twitter Bootstrap v2.3.0
* Font Awesome v3.0.2
* jQuery v1.9.1
* modernizr v2.6.2


## Use

If you would use sidebar and aside features, extend your view file:

	$this->extend('/Common/layout');


Now you can assign sidebar blocks:

	$this->assign('sidebar.left', 'sidebar left block content');
	$this->assign('sidebar.right', 'sidebar right block content');


You can assign aside, header and footer blocks:
	
	$this->assign('header', 'header block content');
	
	$this->assign('aside.left', 'aside left block content');
	$this->assign('aside.right', 'aside right block content');
	
	$this->assign('footer', 'footer block content');

## Scaffolding

You can use advanced scaffolding features with [Batch plugin](http://github.com/cikorka/CakePHP-Batch).

	// in app/Controller/AppController.php
	
	/**
	 * This method should be overridden in child classes.
	 *
	 * @param string $method name of method called example index, edit, etc.
	 * @return boolean Success
	 * @link http://book.cakephp.org/2.0/en/controllers.html#callbacks
	 */
		public function beforeScaffold($method) {
			if ($this->Components->enabled('Batch')) {
				$associations = array('belongsTo', 'hasAndBelongsToMany');
				foreach ($associations as $assoc) {
					if (isset($this->{$this->modelClass}->{$assoc})) {
						$models = array_keys($this->{$this->modelClass}->{$assoc});
						foreach ($models as $model) {
							$this->set(
								Inflector::variable(Inflector::pluralize($model)),
								$this->{$this->modelClass}->{$model}->find('list')
							);
						}
					}
				}
			}
			return true;
		}
