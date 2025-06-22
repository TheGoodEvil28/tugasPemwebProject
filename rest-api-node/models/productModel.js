const db = require('../db');

const getAllProducts = async () => {
  const [rows] = await db.query(`
    SELECT p.*, pi.id AS image_id
    FROM products p
    LEFT JOIN product_images pi ON p.id = pi.product_id
  `);
  return rows;
};

const getProductById = async (id) => {
  const [rows] = await db.query(`
    SELECT p.*, pi.image_data, pi.image_type
    FROM products p
    LEFT JOIN product_images pi ON p.id = pi.product_id
    WHERE p.id = ?
  `, [id]);
  return rows[0];
};

const saveProduct = async (product, photo) => {
  const {
    description, category, brand, condition, color,
    size, fabric, user = 1
  } = product;

  const [result] = await db.execute(`
    INSERT INTO products (category, brand, \`condition\`, color, size, fabric_type, description, user, created_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
  `, [category, brand, condition, color, size, fabric, description, user]);

  const productId = result.insertId;

  if (photo) {
    await db.execute(`
      INSERT INTO product_images (product_id, image_data, image_type, created_at)
      VALUES (?, ?, ?, NOW())
    `, [productId, photo.data, photo.type]);
  }

  return productId;
};

const updatePrice = async (productId, price) => {
  await db.execute(`
    UPDATE products SET price = ? WHERE id = ?
  `, [price, productId]);
};


const deleteProduct = async (id) => {
  // Optionally delete image first if needed
  await db.execute(`DELETE FROM product_images WHERE product_id = ?`, [id]);
  
  // Then delete the product itself
  const [result] = await db.execute(`DELETE FROM products WHERE id = ?`, [id]);
  return result.affectedRows > 0;
};

module.exports = {
  // ... existing exports
  deleteProduct
};

module.exports = {
  getAllProducts,
  getProductById,
  saveProduct,
  updatePrice,
  deleteProduct
};
