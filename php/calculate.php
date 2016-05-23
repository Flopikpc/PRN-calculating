<?php 
class RpnCalculate {
	//разделитель элементов в строке
	var $separator = " "; 
	//математические операции. Для добавления операции добавить запись в этот массив и функцию strToArray.
	var $operations = ['+',	'-', '*', '/', '^'];

	private function strToArray($str){
		//удаляем лишние пробелы
		$str = rtrim($str);
		$str = ltrim($str);
		$str = preg_replace('# {2,}#',' ',$str);
		$array = explode($this->separator, $str);
		var_dump($array);
		return $array;
	}
	private function calculate($a, $b, $instruction){
		switch ($instruction) {
			case '+':
				$rezult = $a + $b;
				break;
			case '-':
				$rezult = $a - $b;
				break;
			case '*':
				$rezult = $a * $b;
				break;
			case '/':
				$rezult = $a / $b;
				break;
			case '^':
				$rezult = pow($a, $b);
				break;
		}
		return $rezult;
	}
	public function calculating($str){
		$array = $this->strToArray($str);
		$stack = [];
		foreach ($array as $token) {
			if (in_array($token, $this->operations)) {
				if (count($stack) < 2) {
					throw new Exeption("Недостаточно данных для операции '$token'");
				}
				$b = array_pop($stack);
				$a = array_pop($stack);
				$rezult = $this->calculate($a, $b, $token);
				array_push($stack, $rezult);
			}
			elseif (is_numeric($token)) {
				array_push($stack, $token);
			}
			else {
				throw new Exception("Недопустимый символ: \"$token\"");
			}
		}
		if (count($stack) > 1) {
			throw new Exception("Количество операторов не соответствует количеству операндов");
		}
		return array_pop($stack);
	}

}