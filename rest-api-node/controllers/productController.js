const productModel = require('../models/productModel');

exports.getAll = async (req, res) => {
  const products = await productModel.getAllProducts();
  res.json(products);
};

exports.getById = async (req, res) => {
  const product = await productModel.getProductById(req.params.id);
  if (product) res.json(product);
  else res.status(404).json({ error: 'Not found' });
};

exports.create = async (req, res) => {
  const product = req.body;
  // for image upload, implement multipart later
  const id = await productModel.saveProduct(product, null);
  res.status(201).json({ id });
};

exports.setPrice = async (req, res) => {
  const { price } = req.body;
  const { id } = req.params;

  if (price === undefined || !id) {
    return res.status(400).json({ error: 'Missing price or product ID' });
  }

  try {
    await productModel.updatePrice(id, price);
    res.json({ success: true });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

exports.delete = async (req, res) => {
  const { id } = req.params;

  try {
    const success = await productModel.deleteProduct(id);

    if (success) {
      res.json({ message: `Product ${id} deleted.` });
    } else {
      res.status(404).json({ error: `Product ${id} not found.` });
    }
  } catch (err) {
    console.error('DELETE failed:', err);
    res.status(500).json({ error: err.message });
  }
};



