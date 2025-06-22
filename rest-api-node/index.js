const express = require('express');
const cors = require('cors');
const app = express();

const productRoutes = require('./routes/productRoutes');

app.use(cors());
app.use(express.json());

app.use('/api/products', productRoutes);

app.listen(3000, () => console.log('REST API running at http://localhost:3000'));
