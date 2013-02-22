<?php

if (Configure::read('debug') > 0) {
	$url = urlencode(Router::url(null, true));
	echo $this->Html->link(__('Validate'), 'http://validator.w3.org/check?uri=' . $url, array('target' => 'validator'));	
}
