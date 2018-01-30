<?php

/**
 * Escapes HTML for output
 *
 */

function escape($html){
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

function merge_files ($content) {
	$begin = "templates/index_begin.html";
	$end = "templates/index_end.html";
	$file1 = file_get_contents("templates/index_begin.html");
	$file2 = file_get_contents($end);
	$file1 .= $content;
	$file1 .= $file2;
	console_log($file1);
	file_put_contents('templates/index.html', $file1);
}

