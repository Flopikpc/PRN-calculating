<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>RPN calculating</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php 
	require "php/calculate.php";
	$string = $_POST["string"];
	if ($string != "") {
		$rpn = new RpnCalculate;
		$answer = $rpn->calculating($string);
	}
	?>
	<div class="wrapper">
		<form action="index.php" method="post">
			<label for="phrase">Выражение:</label>
			<input class="input" type="text" placeholder="Пример: '2 5 + 3 *'" name="string" id="phrase">
			<input class="button" type="submit" value="Отправить">
		</form>
		<span>Ответ: <?= $answer ?></span>
	</div>
</body>
</html>