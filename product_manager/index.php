<?php
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');

$user_type = 'manager';
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}

if ($action == 'list_products') {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
    $category_name = get_category_name($category_id);
    $categories = get_categories();
    $products = get_products_by_category($category_id);
    include('product_list.php');

} else if ($action == 'delete_product') {
    $product_id = filter_input(INPUT_POST, 'product_id', 
            FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE ||
            $product_id == NULL || $product_id == FALSE) {
        $error = "Missing or incorrect product id or category id.";
        include('../errors/error.php');
    } else { 
        delete_product($product_id);
        header("Location: .?category_id=$category_id");
    }

} else if ($action == 'show_add_form') {
    $categories = get_categories();
    include('product_add.php');    

} else if ($action == 'add_product') {
    $category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price');
    if ($category_id == NULL || $category_id == FALSE || $code == NULL || 
            $name == NULL || $price == NULL || $price == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        add_product($category_id, $code, $name, $price);
        header("Location: .?category_id=$category_id");
    }

} else if ($action == 'list_categories') {
    $categories = get_categories();
    include('category_list.php');

} else if ($action == 'add_category') {
    $name = filter_input(INPUT_POST, 'name');
    // Validate inputs
    if ($name == NULL) {
        $error = "Invalid category name. Check name and try again.";
        include('view/error.php');
    } else {
        add_category($name);
        header('Location: .?action=list_categories');  // display the Category List page
    }

} else if ($action == 'delete_category') {
    $category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    delete_category($category_id);
    header('Location: .?action=list_categories');      // display the Category List page

} else if ($action == 'show_edit_product_form') {
	$product_id = filter_input(INPUT_POST, 'product_id',
			FILTER_VALIDATE_INT);
	$category_id = filter_input(INPUT_POST, 'category_id',
			FILTER_VALIDATE_INT);
	$categories = get_categories();
	$product = get_product($product_id);
	$error_message_product_code = '';
	$error_message_product_name = '';
	$error_message_product_price = '';
	include('product_edit.php');
	
} else if ($action == 'edit_product') {
	$product_id = filter_input(INPUT_POST, 'product_id',
			FILTER_VALIDATE_INT);
	$category_id = filter_input(INPUT_POST, 'category_id',
			FILTER_VALIDATE_INT);
	$code = filter_input(INPUT_POST, 'code');
	$name = filter_input(INPUT_POST, 'name');
	$price = filter_input(INPUT_POST, 'price');
	include('../errors/validate_form_data.php');
	$error_message_product_code = get_form_error_product_code($code);
	$error_message_product_name = get_form_error_product_name($name);
	$error_message_product_price = get_form_error_product_price($price);
	if ($category_id == NULL || $category_id == FALSE) {
		$error = "Invalid product data. Check all fields and try again.";
		include('../errors/error.php');
	} else if ($error_message_product_code == '' && $error_message_product_name == '' && $error_message_product_price == '') {
		edit_product($product_id, $category_id, $code, $name, $price);
		header("Location: .?category_id=$category_id");
	} else {	
		$action = 'show_edit_product_form';
		$categories = get_categories();
		$product = get_product($product_id);
		include('product_edit.php');	
	}
}
?>