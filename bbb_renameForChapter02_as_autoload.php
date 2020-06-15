<?php
spl_autoload_register(function($className) {
	$file = 'C2_class' . $className . '.php';
	if (file_exists($file)) {
		include $file;
	}
});