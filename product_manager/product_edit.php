<?php include '../view/header.php'; ?>
<main>
	<h1>Edit Product</h1>
	<form action="index.php" method="post" id="edit_product_form">
		<input type="hidden" name="action" value="edit_product">
		<label>Category:</label> 
		<select name="category_id">
			<?php foreach ($categories as $category) : ?>
			<option value="<?php echo $category['categoryID']; ?> "
				<?php if ($category['categoryID'] == $category_id) {echo 'selected';} ?>>
				<?php echo $category['categoryName']; ?>
			</option>
			<?php endforeach; ?>
		</select> 
		<br> 
		<label>Code:</label> 
		<input 	type="text" 
				name="code"
				size="35" 
				value="<?php echo $product['productCode']; ?>"> 
		<span class="error_message"><?php echo $error_message_product_code?></span>
		<br> 
		<label>Name:</label>
		<input 	type="text" 
				name="name" 
				size="35"
				value="<?php echo $product['productName']; ?>"> 
		<span class="error_message"><?php echo $error_message_product_name?></span>
		<br> 
		<label>List Price:</label> 
		<input 	type="text" 
				name="price" 
				size="35"
				value="<?php echo $product['listPrice']; ?>"> 
		<span class="error_message"><?php echo $error_message_product_price?></span>
		<br> 
		<input	type="hidden" 
				name="product_id" 
				size="35"
				value="<?php echo $product['productID']; ?>"> 
		<label>&nbsp;</label> 
		<input	type="submit" 
				value="Edit Product">
		<br>
	</form>
	<p class="last_paragraph">
		<a href="index.php">View Product List</a>
	</p>
</main>
<?php include '../view/footer.php'; ?>