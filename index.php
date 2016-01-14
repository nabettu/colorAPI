<?php

define('CASPER', "/usr/local/bin/casperjs");
define('PERMIT', "http://local.com");

header("Access-Control-Allow-Origin:".PERMIT);
require_once 'simple_html_dom.php';
error_reporting(E_ALL & ~E_NOTICE);

if ($_GET['num'] !== null) {
    if($_GET['num'] > 20){
		$num = 20;
	}else{
		$num = $_GET['num'];
	}
} else {
    $num = 10;
}

$words = urlencode($_GET['words']);
$output = shell_exec(CASPER.' cas.js '.$words);
$html = str_get_html($output);

$return_value = "";
for ($i = 0;$i < $num;++$i) {
    $style = $html->find('.rg_l', $i)->attr["style"];
	$rgb = explode(")",explode("rgb(",$style)[1])[0];

	for ($j = 0;$j < 3; ++$j) {
		$tmp16 = dechex(explode(",",$rgb)[$j]);
		if(strlen($tmp16) < 2)$return_value .= "0";
		$return_value .= $tmp16;
	}

	if($i != $num - 1)$return_value .= ",";
}

echo $return_value;
