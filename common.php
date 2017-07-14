
<?php

	// масив матов
	define(FILE_SETTING, 'session.ini');

	function read($file_name) {

		$data = file_get_contents($file_name, true);
		return unserialize($data);
	}

	function write($file_name, $data) {

		//echo $data;   echo "<br>";

		$data = serialize($data);

		//echo $data;
		return file_put_contents($file_name, $data);
	}

	function rewrite($array, $mat, $task, &$comment) {

		$key = array_search($mat, $array); 

		// если нужно добавить
		if ($task == 1) {			
			
			if (!$key) {
				$array[] = $mat;
				$w = write(FILE_SETTING, $array);
				$comment = " <b>Мат <u>" . $mat . "</u> додан!</b> <br><hr>";
			}
			else {
				$comment = " <b>Мат <u>" . $mat . "</u> уже был в списке!</b> <br><hr>";
			}
			
		}

		//удалить
		if ($task == 2) {

			if ($key) {

				unset($array[$key]);

				// Переиндексация:
				$array = array_values($array);

				write(FILE_SETTING, $array);
				$comment = " <b>Мат <u>" . $mat . "</u> удален!</b> <br><hr>";
			}
			else {
				$comment = " <b>Мат <u>" . $mat . "</u> не найден в списке!</b> <br><hr>";
			}
		}
	}

	function test_file($file_name, $array, &$comment) {

		$file_str = file_get_contents($file_name);
		//$file_array = explode(" ", $file_str);

		foreach ($array as $key => $value) {

			// количество мата в файле
			$count_mat = substr_count($file_str, $value);

			if ($count_mat) {			
				$file_str = str_replace($value, "<u>" . $value . "</u>", $file_str);
				$comment = (string)$comment . " Мат <u>" . $value . "</u> встречается ". $count_mat ." раз <br>";
			}
		}

		return $file_str;
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
$file_str = '';

// Если нет данных
if (!$mat && !$file_name) {

	$result = array(
		'print_result' => '',
		'file_str' => '',
		'comment' => 'Нет данных!'
	);
	echo json_encode($result);
}

// //$array = ['mat1', 'mat2' ,'mat3', 'mat4', 'mat5'];
// // write(FILE_SETTING, $array);

 $array = read(FILE_SETTING);

if ($mat) {
	rewrite($array, $mat, $task, $comment);
}

if ($file_name) {
	$file_str = test_file($file_name, $array, $comment);
}


 $array = read(FILE_SETTING);
 $print_result = print_r($array, true);

$result = array(
	'print_result' => $print_result,
	'file_str' => $file_str,
	'comment' => $comment
);

echo json_encode($result);




