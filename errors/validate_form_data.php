<?php
function get_form_error_product_code($code) {
	$error_message = '';
	if ($code == NULL) {
		$error_message = 'Please supply a product code.';
	} else if (strlen($code) < 2) {
		$error_message = 'Code must consist of 2 or more characters.';
	}
	return $error_message;
}

function get_form_error_product_name($name) {
	$error_message = '';
	if ($name == NULL) {
		$error_message = 'Please supply a product name.';
	}
	return $error_message;
}

function get_form_error_product_price($price) {
	$error_message = '';
	if ($price == NULL || $price == FALSE) {
		$error_message = 'Please supply a product price.';
	} else if ($price <= 0) {
		$error_message = 'The product price must be greater than $0.00.';
	}
	return $error_message;
}