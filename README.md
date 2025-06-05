/
├── 📁 Controller
│   ├── controller.class.php
│   ├── profile.class.php
│   └── ... # other controllers
│
├── 📁 Model
│   ├── model.model.php
│   ├── account.model.php
│   ├── history.model.php
│   ├── product.model.php
│   └── order.model.php
│
├── 📁 View
│   ├── 📁 profile
│   │   ├── index.php
│   │   ├── purchases.php
│   │   ├── sales.php
│   │   └── styles.css
│   │
│   ├── 📁 editProfile
│   │   ├── index.php
│   │   └── styles.css
│   │
│   ├── 📁 productDetail
│   │   ├── index.php
│   │   └── styles.css
│   │
│   ├── 📁 updateOrder
│   │   ├── index.php
│   │   └── styles.css
│   │
│   └── 📁 updateProduct
│       ├── index.php
│       └── styles.css
│
├── 📁 public
│   ├── 📁 assets
│   ├── 📁 css
│   │   ├── navbar.css
│   │   └── footer.css
│   └── 📁 js
│       └── navbar.js
│
├── index.php
└── README.md

## Database Schema
## sql

📊 profiles
┌───────────────┬────────────────┬─────────────────┐
│ id            │ INT(11)        │ AUTO_INCREMENT  │
│ username      │ VARCHAR(50)    │ UNIQUE          │
│ display_name  │ VARCHAR(100)   │                 │
│ email         │ VARCHAR(100)   │ UNIQUE          │
│ phone         │ VARCHAR(20)    │                 │
│ profile_pic   │ VARCHAR(255)   │ DEFAULT         │
│ xp_points     │ INT(11)        │ DEFAULT 0       │
│ created_at    │ TIMESTAMP      │ DEFAULT NOW()   │
└───────────────┴────────────────┴─────────────────┘

📊 products
┌───────────────┬────────────────┬─────────────────┐
│ id            │ INT(11)        │ AUTO_INCREMENT  │
│ category      │ VARCHAR(100)   │                 │
│ brand         │ VARCHAR(100)   │                 │
│ condition     │ VARCHAR(50)    │                 │
│ color         │ VARCHAR(50)    │                 │
│ size          │ VARCHAR(50)    │                 │
│ fabric_type   │ VARCHAR(50)    │                 │
│ description   │ TEXT           │                 │
│ price         │ DECIMAL(10,2)  │ DEFAULT 0.00    │
│ created_at    │ DATETIME       │ DEFAULT NOW()   │
│ user_id       │ INT(11)        │ DEFAULT 1       │
└───────────────┴────────────────┴─────────────────┘

📊 product_images
┌───────────────┬────────────────┬─────────────────┐
│ id            │ INT(11)        │ AUTO_INCREMENT  │
│ product_id    │ INT(11)        │ FK → products   │
│ image_data    │ LONGBLOB       │                 │
│ image_type    │ VARCHAR(50)    │                 │
│ created_at    │ DATETIME       │ DEFAULT NOW()   │
└───────────────┴────────────────┴─────────────────┘

📊 orders
┌───────────────────┬───────────────────────────────────┐
│ id                │ INT(11) AUTO_INCREMENT            │
│ product_id        │ INT(11) FK → products             │
│ name              │ VARCHAR(255)                      │
│ phone_number      │ VARCHAR(50)                       │
│ address_search    │ VARCHAR(255)                      │
│ full_address      │ VARCHAR(255)                      │
│ additional_details│ VARCHAR(255)                      │
│ created_at        │ TIMESTAMP DEFAULT NOW()           │
│ user_id           │ INT(11) DEFAULT 1                 │
│ status            │ ENUM('pending','in transit',      │
│                   │        'delivered')               │
└───────────────────┴───────────────────────────────────┘

## Database Create

CREATE TABLE `profiles` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(50) NOT NULL,
`display_name` varchar(100) NOT NULL,
`email` varchar(100) NOT NULL,
`phone` varchar(20) DEFAULT NULL,
`profile_picture` varchar(255) DEFAULT 'https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg',
`xp_points` int(11) NOT NULL DEFAULT 0,
`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
PRIMARY KEY (`id`),
UNIQUE KEY `username` (`username`),
UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

CREATE TABLE `products` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`category` varchar(100) DEFAULT NULL,
`brand` varchar(100) DEFAULT NULL,
`condition` varchar(50) DEFAULT NULL,
`color` varchar(50) DEFAULT NULL,
`size` varchar(50) DEFAULT NULL,
`fabric_type` varchar(50) DEFAULT NULL,
`description` text DEFAULT NULL,
`price` decimal(10,2) DEFAULT 0.00,
`created_at` datetime DEFAULT current_timestamp(),
`user_id` int(11) NOT NULL DEFAULT 1,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

CREATE TABLE `product_images` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`product_id` int(11) NOT NULL,
`image_data` longblob NOT NULL,
`image_type` varchar(50) DEFAULT NULL,
`created_at` datetime DEFAULT current_timestamp(),
PRIMARY KEY (`id`),
KEY `product_id` (`product_id`),
CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

CREATE TABLE `orders` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`product_id` int(11) NOT NULL,
`name` varchar(255) NOT NULL,
`phone_number` varchar(50) NOT NULL,
`address_search` varchar(255) NOT NULL,
`full_address` varchar(255) NOT NULL,
`additional_details` varchar(255) DEFAULT NULL,
`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
`user_id` int(11) NOT NULL DEFAULT 1,
`status` enum('pending','in transit','delivered') NOT NULL DEFAULT 'pending',
PRIMARY KEY (`id`),
KEY `fk_orders_product_id` (`product_id`),
CONSTRAINT `fk_orders_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci