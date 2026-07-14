# 🛒 ShopSphere — PHP E-Commerce Platform

A full-stack e-commerce web application built with **PHP**, **MySQL**, **Bootstrap**, and **JavaScript**. ShopSphere delivers a complete online shopping experience — product browsing, cart, wishlist, checkout, and order tracking on the customer side, paired with a dedicated admin panel for managing products, categories, and orders.


---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Database Schema](#database-schema)
- [Getting Started](#getting-started)
- [Default Admin Login](#default-admin-login)
- [Screenshots](#screenshots)
- [Roadmap](#roadmap)
- [Author](#author)
- [License](#license)

---

## Overview

ShopSphere is a self-contained e-commerce web app built with core PHP and MySQL — no frameworks required. It's designed to demonstrate a real-world shopping flow end-to-end: user registration and authentication, product discovery, cart and wishlist management, checkout with cash-on-delivery, order history with invoices, and a separate admin dashboard for store management.

## Features

### 👤 Customer

- Registration and login with secure password hashing
- Product browsing with search, category filters, and price sorting
- Detailed product pages with reviews and ratings
- Shopping cart with quantity updates
- Wishlist
- Checkout with shipping address and Cash on Delivery (COD)
- Order history with viewable invoices
- Profile management
- Responsive, mobile-friendly UI

### 🔑 Admin

- Secure, separate admin login
- Dashboard with store statistics
- Product management (add / edit / delete)
- Category management
- Order management with status updates
- Customer order visibility

## Tech Stack

| Layer      | Technology                          |
|------------|--------------------------------------|
| Frontend   | HTML5, CSS3, Bootstrap 5, JavaScript |
| Backend    | PHP 8 (procedural, `mysqli`)         |
| Database   | MySQL / MariaDB                      |
| Tooling    | XAMPP, phpMyAdmin, Git               |

## Project Structure

```
ShopSphere-Ecommerce/
├── admin/                  # Admin panel (dashboard, product & order management)
│   ├── login.php
│   ├── dashboard.php
│   ├── add-product.php
│   ├── orders.php
│   ├── order_details.php
│   ├── update-order-status.php
│   └── logout.php
├── config/
│   └── db.php               # Database connection settings
├── database/
│   └── ecommerce_db.sql     # Full schema + seed data
├── includes/                # Shared layout partials
│   ├── header.php
│   ├── navbar.php
│   ├── footer.php
│   └── functions.php
├── uploads/                  # Product images
├── screenshots/              # App screenshots used in this README
├── dashboard.php             # User home / dashboard
├── login.php / register.php
├── products.php / product-details.php
├── cart.php / add-to-cart.php / remove-cart.php / update-quantity.php
├── wishlist.php / add-to-wishlist.php / remove-wishlist.php
├── checkout.php / payment.php
├── orders.php / invoice.php
├── profile.php
└── logout.php
```

## Database Schema

The database (`ecommerce_db`) consists of the following tables:

| Table         | Purpose                                   |
|---------------|--------------------------------------------|
| `admins`      | Admin accounts                            |
| `users`       | Customer accounts                         |
| `products`    | Product catalog                           |
| `categories`  | Product categories                        |
| `cart`        | Items in each user's cart                 |
| `wishlist`    | Items in each user's wishlist             |
| `orders`      | Order records                             |
| `order_items` | Line items per order                      |
| `reviews`     | Product reviews and ratings               |

The full schema with seed data is provided in [`database/ecommerce_db.sql`](database/ecommerce_db.sql).

## Getting Started

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (or any Apache + PHP 8 + MySQL/MariaDB stack)
- A web browser

### Installation

1. **Clone or download** this repository into your local server's web root:
   ```
   htdocs/shopsphere
   ```

2. **Start Apache and MySQL** from the XAMPP control panel.

3. **Create the database.** Open phpMyAdmin and create a database named:
   ```
   ecommerce_db
   ```

4. **Import the schema.** In phpMyAdmin, select the `ecommerce_db` database and import:
   ```
   database/ecommerce_db.sql
   ```

5. **Configure the database connection**, if needed, in [`config/db.php`](config/db.php):
   ```php
   $host     = "localhost";
   $username = "root";
   $password = "";
   $database = "ecommerce_db";
   ```

6. **Launch the app** in your browser:
   ```
   http://localhost/shopsphere
   ```
   Admin panel:
   ```
   http://localhost/shopsphere/admin/login.php
   ```

## Default Admin Login

A seed admin account is included in the SQL dump:

```
Email: admin@gmail.com
```

The password is hashed in the seed data — set your own by inserting a new row into `admins` with a `password_hash()`-generated value, or update the existing row via phpMyAdmin.

> ⚠️ Change or remove this seed account before deploying anywhere beyond local development.

## Screenshots

| Homepage | Products |
|---|---|
| ![Homepage](screenshots/Homepage.png) | ![Products](screenshots/Products%20page.png) |

| Login | Register |
|---|---|
| ![Login](screenshots/Login%20page.png) | ![Register](screenshots/Register%20page.png) |

| Cart | Wishlist |
|---|---|
| ![Cart](screenshots/Cart%20page.png) | ![Wishlist](screenshots/Wishlist%20page.png) |

| Admin Dashboard | Orders |
|---|---|
| ![Admin Dashboard](screenshots/Admin%20dashboard.png) | ![Orders](screenshots/Orders%20page.png) |

## Roadmap

- [ ] Online payment gateway integration (Razorpay / Stripe)
- [ ] Email notifications (order confirmation, status updates)
- [ ] Forgot password / password reset flow
- [ ] Downloadable PDF invoices
- [ ] Sales analytics dashboard
- [ ] Product recommendations
- [ ] Live deployment

## Author

**Sharan Yadav**
B.Tech, Computer Science Engineering

- GitHub: _add your profile link_
- LinkedIn: _add your profile link_

## License

This project was developed for educational and portfolio purposes.
