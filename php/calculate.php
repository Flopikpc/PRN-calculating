<?php 
class RpnCalculate {
	//разделитель элементов в строке
	var $separator = " "; 
	//математические операции. Для добавления операции добавить запись в этот массив по примеру.
	var $operations = [
						'+' => '$a + $b', 
						'-' => '$a - $b', 
						'*' => '$a * $b', 
						'/' => '$a / $b', 
						'^' => 'pow($a, $b)'];

	private function strToArray($str){
		$array = explode($this->separator, $str);
		return $array;
	}
	private function calculate($a, $b, $instruction)
	{
		$string = '$rezult=' . $instruction . ';';
		eval($string);
		return $rezult;
	}
	public function calculating($str){
		$array = $this->strToArray($str);
		$stack = [];
		foreach ($array as $token) {
			if (array_key_exists($token, $this->operations)) {
				if (count($stack) < 2) {
					throw new Exeption("Недостаточно данных для операции '$token'");
				}
				$b = array_pop($stack);
				$a = array_pop($stack);
				$rezult = $this->calculate($a, $b, $this->operations[$token]);
				array_push($stack, $rezult);
			}
			elseif (is_numeric($token)) {
				array_push($stack, $token);
			}
			else {
				throw new Exception("Недопустимый символ: $token");
			}
		}
		if (count($stack) > 1) {
			throw new Exception("Количество операторов не соответствует количеству операндов");
		}
		return array_pop($stack);
	}

}