
<?php /*

	define(FILE_SETTING, 'session.ini');

	function read($file_name) {

		$data = file_get_contents($file_name, true);
		return unserialize($data);
	}

	function write($file_name, $data) {

		echo $data;   echo "<br>";

		$data = serialize($data);

		echo $data;
		return file_put_contents($file_name, $data);
	}

	function rewrite($array, $mat, $task) {

		$key = array_search($mat, $array); 

		// если нужно добавить
		if ($task = 1 && !$key) {			
			
			$array[] = $mat;
			write(FILE_SETTING, $array);
			
		}

		//удалить
		if ($task = 2 && $key) {

			unset($array[$key]);

			// Переиндексация:
			$array = array_values($array);

			write(FILE_SETTING, $array);

		}

	}


//Получаем переменные
if (isset($_POST['mat'])) {
	$mat = (string) $_POST['mat'];
}
else {
	$mat = '';
}

if (isset($_POST['task'])) {
	$task = (string) $_POST['task'];
}
else {
	$mat = '';
	$task = 0;
}

if (isset($_POST['file_name'])) {
	$file_name = (string) $_POST['file_name'];
}
else {
	$file_name = '';
}

$comment = '';

// Если нет данных
if (!$mat && !$file_name) {

	$result = array(
		'print_result' => '',
		'comment' => 'Нет данных!'
	);
	echo json_encode($result);
}

//$array = ['mat1', 'mat2' ,'mat3', 'mat4', 'mat5'];
// write(FILE_SETTING, $array);

$array = read($file_name);

if ($mat) {
	rewrite($array, $mat, $task);
}

if ($file_name) {
	check_file($file_name, $array);
}

$result = array(
	'print_result' => '',
	'comment' => ''
);

echo json_encode($result);

*/ ?>