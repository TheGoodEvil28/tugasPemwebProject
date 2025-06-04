<!-- /views/edit_product.php -->
<h1>Edit Product</h1>
<form action="?c=Route&m=updateProduct&id=<?= htmlspecialchars($product['id']) ?>" method="post" enctype="multipart/form-data">
  <label>Brand</label>
  <input type="text" name="brand" value="<?= htmlspecialchars($product['brand']) ?>" required>

  <label>Price</label>
  <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

  <!-- ... other fields ... -->

  <button type="submit">Update Product</button>
</form>
