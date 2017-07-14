
<!DOCTYPE HTML>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Bootstrap -->
	<link href="stylesheet/bootstrap.min.css" rel="stylesheet">
	<link href="stylesheet/my.css" rel="stylesheet">
</head>

<html>
<body>


<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-10">
				<div class="converter-wrap">

					<h1>Фильтр мата</h1>					

					<form id="form" class="form-inline">

						<div class="form-group">

							<label class="control-label" for="mat">Слово:</label>
								<input id="mat" class="form-control" type="text" name="mat" placeholder="мат" value="" >

							<label class="control-label" for="task">Действие:</label>
							<select id="task" class="form-control" required size="1" name="task">
								<!--<option disabled>Валюта</option> -->
								<option selected value = "1">Додати в файл</option>
								<option value = "2">Видалити з файлу</option>
							</select>
						</div>	

					
						<br><br>
						<label class="control-label" for="file_name">Проверить файл:</label>
						
						<input id="file_name" class="form-control" type="text" name="file_name" placeholder="название файла" value="myfile.txt" >
						
						<br><br>
							<!-- <input type="file" name="uploadfile" value="myfile.txt"> -->
						<button type="submit" value="send" class="btn btn-success">Выполнить</button>
						<br><br>

					</form>

					<br><hr><br>

					<div id="file_str"></div>
					<br>
					<div id="comment"></div>
					<br>					
					<div id="result"></div>
					
					
				</div>
			</div>
		</div>
	</div>

	<script>


		$("#form").submit(function(e) {

			var mat = $("#mat").val();
			var task = $("#task").val();
			var file_name = $("#file_name").val();			
			//console.log(autoword);
			
			$.ajax({
				type: "POST",
				url: "common.php",
				data:{mat: mat,
					  task:task,
					  file_name:file_name
				},
				dataType: 'json',
					error: function(data) {
						$('#result').html('<p class="text-error" style="color:#f5345f">Ошибка чтения!</p>'); 
						$('#comment').html('');
					},
					success: function(data) {
 
						$('#result').html('<b>Массив матов: </b> <pre>' + data.print_result + '</pre>');
						$('#comment').html(' ' + data.comment);		

						if(data.file_str) {
							$('#file_str').html(' ' + data.file_str);	
						}			
					}
				});

			e.preventDefault();
		});


	</script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>


