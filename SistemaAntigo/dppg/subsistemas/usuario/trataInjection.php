<?php

	function protectorString($arg1) {
		$arr = array("-1","AND","../","/etc","/var","sysdate","XOR","csleep","sleep");
		foreach($arr as $valor) {
			if (strpos($arg1, $valor) !== false) {
				return true;
			}
		}
		return false;
	}

?>
