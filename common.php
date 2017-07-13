<?php 

define(FILE_SETTING, 'session.ini');

function read($file_name) {

	$data = file_get_contents($file_name, true);
	return unserialize($data);

}


function write($file_name, $data) {

	$data = serialize($data);
	return file_put_contents($file_name, data);
}


write(FILE_SETTING, ['setting' => ['lng' => 'ua']);


$lang = 'en';

$settings = [];
$settings = read(FILE_SETTING);

if (!$settings) {
	exit('file not found');
}

if (isset($_GET['lng'])) 
{
	$lang = $_GET['lng'];
	$settings['setting']['lng'] = $lang;
	write(FILE_SETTING, $settings);
} else {
	$lang = $settings['setting']['lng'];
}

switch ($lang) {
	case 'en':
		echo "en";
		break;
	
	default:
		echo "ua";
		break;
}