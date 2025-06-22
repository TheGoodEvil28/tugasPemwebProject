const express = require('express');
const controller = require('../controllers/productController');
const router = express.Router();

router.get('/', controller.getAll);
router.get('/:id', controller.getById);
router.post('/', controller.create);
router.put('/:id/price', controller.setPrice);
router.delete('/:id', controller.delete);

module.exports = router;
