<?php

define('EXTENSION', $_POST['extension']);
define('ACTION', $_POST['action']);
define('REGULAR', $_POST['regexp']);

$paths = $_POST['paths'];

if (ACTION == 'b') {
	define('CUSTOM', $_POST['custom']);
}

foreach ($paths as $path) {
	checkDir($path);
}

function checkDir($dirName) 
{
	$files = scandir($dirName);

	foreach ($files as $key => $name) {
		if ($name == '.' || $name == '..') {
			continue;

		} else if (is_dir($dirName . $name)) {
			checkDir($dirName . $name . '/');

		} else {
			cleanFile($dirName . $name);
		}
	}
}

function cleanFile($fileName)
{
	if ( pathinfo($fileName)['extension'] === EXTENSION ) {
		$content = file_get_contents($fileName);
		if (ACTION == 'a')
		{
			if ( preg_match(REGULAR, $content) ) {
				if (is_writable($fileName)) {
					unlink($fileName);
					echo "<span style='color: green'>File removed - $fileName</span><hr>";
				} else {
					echo "<span style='color: red'>We catch something, but haven't permisstion to remove this file - $fileName</span><hr>";
				}
			}
		}
		if (ACTION == 'b')
		{
			if ( preg_match(REGULAR, $content) ) {
				if (is_writable($fileName)) {
					$content = preg_replace(REGULAR, CUSTOM, $content);
					file_put_contents($fileName, $content);
				    echo "<span style='color: green'>File rewrited - $fileName</span><hr>";
				} else {
					echo "<span style='color: red'>We catch something, but haven't permisstion to edit this file - $fileName</span><hr>";
				}
			}
		}
		if (ACTION == 'c')
		{
			if ( preg_match(REGULAR, $content) ) {
			    echo "<span style='color: red'>We catch something in $fileName</span><hr>";
			} else {
			    // echo "<span style='color: green'>$fileName cleary!</span><hr>";
			}
		}
	}
}