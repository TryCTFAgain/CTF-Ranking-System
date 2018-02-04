<?php 

function xsssafe($string){
	return htmlentities($string, ENT_QUOTES | ENT_HTML5, "UTF-8");
}

function isValidEmail($email = ''){
	if (empty($email)){
		return false;
	}
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
		return false;
	};
	return true;
}

function isValidDate($date){
	if (empty($date)){
		return false;
	}
	if(! DateTime::createFromFormat('yy-m-d', $date)){
		return false;
	};
	return true;
}

function isValidNumberic($number){
	$option = array("options"=>
                array(
                    "min_range"=>-1
                )
            );
	if (filter_var($number, FILTER_VALIDATE_INT, $option) === false){
		return false;
	}
	return true;
}

function isValidString($string){
	if (empty($string))
		return false;
	if (! preg_match('/^[\w\d!#$%&*+,.:;=?@\[\] ^_{|}~-]*$/i', $string)){
		return false;
	}
	return true;
}

function isValidClassName($classname){
	if (empty($classname))
		return false;
	if (! preg_match('/^at\d{2}\w$/i', $classname)){
		return false;
	}
	return true;
}

function isValidCategories($category){
	if (empty($category))
		return false;
	if (! preg_match('/^(Web Exploit|Reverse Engineer|Pwnable|Cryptography|Forensic|Misc)$/i', $category)){
		return false;
	}
	return true;
}

?>
