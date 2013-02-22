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

$ga  = "var _gaq=[['_setAccount','$account'],['_trackPageview']];\n";
$ga .= "(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];\n";
$ga .= "g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';\n";
$ga .= "s.parentNode.insertBefore(g,s)}(document,'script'));";

echo $this->Html->scriptBlock($ga);