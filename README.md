# 🛒 ShopSphere — PHP E-Commerce Platform

A full-stack e-commerce web application with a complete shopping experience for customers and a full-featured management dashboard for admins.


---

## 📋 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Architecture](#-architecture)
- [Folder Structure](#-folder-structure)
- [Installation](#-installation)
- [Usage](#-usage)
- [Screenshots](#-screenshots)
- [Results](#-results)
- [Future Improvements](#-future-improvements)
- [Learning Outcomes](#-learning-outcomes)
- [Contributors](#-contributors)
- [License](#-license)

---

## 📖 Overview

**ShopSphere** is a full-stack e-commerce website built with **PHP**, **MySQL**, **Bootstrap**, and **JavaScript**. It provides an end-to-end online shopping experience — from browsing and searching products to checkout, order tracking, and invoicing — alongside a secure admin panel for managing products, categories, and orders.

---

## ✨ Features

### 👤 User Features

| Feature | Description |
|---|---|
| 🔐 Authentication | User registration & login with secure password hashing |
| 🛍️ Product Browsing | Browse, search, filter by category, and sort by price |
| 📄 Product Details | Dedicated product detail pages with reviews & ratings |
| 🛒 Shopping Cart | Add, update, and remove items from the cart |
| 💖 Wishlist | Save products for later |
| 🏠 Shipping Address | Manage delivery address at checkout |
| 💵 Cash on Delivery | Place orders with COD payment |
| 📦 Order Management | View "My Orders" and track order status |
| 🧾 Invoicing | Generate order invoices |
| 👤 Profile Management | Update personal profile information |
| ⭐ Reviews & Ratings | Rate and review purchased products |
| 📱 Responsive Design | Fully responsive across devices |

### 🔑 Admin Features

<details>
<summary><b>Click to expand admin capabilities</b></summary>

- Secure admin login
- Analytics dashboard with key statistics
- Add, edit, and delete products
- Manage product categories
- View and manage all customer orders
- Update order status
- Full CRUD control over the product catalog

</details>

---

## 🛠️ Tech Stack

<table>
<tr>
<td valign="top" width="25%">

**Frontend**
- HTML5
- CSS3
- Bootstrap 5
- JavaScript

</td>
<td valign="top" width="25%">

**Backend**
- PHP 8

</td>
<td valign="top" width="25%">

**Database**
- MySQL

</td>
<td valign="top" width="25%">

**Tools**
- XAMPP
- phpMyAdmin
- Git & GitHub

</td>
</tr>
</table>

---

## 🏗️ Architecture

ShopSphere follows a classic **LAMP-style, procedural PHP architecture**, with shared UI components and centralized database access:

```
┌──────────────┐      ┌───────────────┐      ┌──────────────┐
│   Browser    │ ───▶ │  Apache + PHP │ ───▶ │  MySQL DB    │
│ (HTML/CSS/JS)│ ◀─── │  (ShopSphere) │ ◀─── │ ecommerce_db │
└──────────────┘      └───────────────┘      └──────────────┘
        │                     │
        │                     ├── includes/  → shared header, navbar, footer, helper functions
        │                     ├── config/    → database connection (db.php)
        │                     ├── admin/     → admin-only pages & controllers
        │                     └── uploads/   → uploaded product images
        │
        └── Responsive UI rendered with Bootstrap 5 & custom CSS/JS
```

- **Presentation layer:** PHP-rendered pages using shared `includes/header.php`, `includes/navbar.php`, and `includes/footer.php` for consistent layout.
- **Application logic:** Individual PHP scripts per feature (cart, wishlist, checkout, orders, etc.), with reusable helpers in `includes/functions.php`.
- **Data layer:** A single MySQL connection (`config/db.php`) shared across the app, backed by the `ecommerce_db` schema.
- **Admin module:** A self-contained `admin/` directory with its own authentication, dashboard, and order/product management pages.

---

## 📂 Folder Structure

```
ShopSphere-Ecommerce-main/
│
├── admin/                     # Admin panel
│   ├── add-product.php
│   ├── dashboard.php
│   ├── login.php
│   ├── logout.php
│   ├── order_details.php
│   ├── orders.php
│   └── update-order-status.php
│
├── config/
│   └── db.php                 # Database connection config
│
├── database/
│   └── ecommerce_db.sql       # SQL schema/import file
│
├── includes/                  # Shared components
│   ├── header.php
│   ├── navbar.php
│   ├── footer.php
│   └── functions.php
│
├── screenshots/                # Project screenshots (for this README)
├── uploads/                     # Uploaded product images
│
├── index.php
├── login.php
├── register.php
├── products.php
├── product-details.php
├── cart.php
├── wishlist.php
├── checkout.php
├── payment.php
├── profile.php
├── orders.php
├── invoice.php
├── add-to-cart.php
├── add-to-wishlist.php
├── remove-cart.php
├── remove-wishlist.php
├── update-quantity.php
├── dashboard.php
└── README.md
```

---

## ⚙️ Installation

1. **Install [XAMPP](https://www.apachefriends.org/)** (or any Apache + MySQL + PHP stack).

2. **Copy the project** into your `htdocs` folder:

   ```
   htdocs/ShopSphere-Ecommerce-main
   ```

3. **Start services** in the XAMPP control panel:
   - Apache
   - MySQL

4. **Open phpMyAdmin** at `http://localhost/phpmyadmin`.

5. **Create a database** named:

   ```
   ecommerce_db
   ```

6. **Import the SQL file** from `database/ecommerce_db.sql` into the newly created database.

7. **Configure the database connection** (if needed) in `config/db.php`:

   ```php
   $host     = "localhost";
   $username = "root";
   $password = "";
   $database = "ecommerce_db";
   ```

8. **Launch the app** in your browser:

   ```
   http://localhost/ShopSphere-Ecommerce-main
   ```

---

## 🚀 Usage

- **As a customer:** Register an account, browse or search products, filter by category, add items to your cart or wishlist, check out with a shipping address using Cash on Delivery, and track your orders with downloadable invoices.
- **As an admin:** Log in through the admin panel to view dashboard statistics, manage the product catalog (add/edit/delete), organize categories, and process customer orders by updating their status.

---

## 🖼️ Screenshots


### 🏠 Homepage
![Homepage — landing page showing featured products and navigation](screenshots/Homepage.png)
*Landing page with navigation, hero banner, and a "Shop Now" call-to-action.*

### 🔑 Login Page
![Login page — user authentication form](screenshots/Login_page.png)
*Secure login form for registered users, with a link to register.*

### 📦 Orders Page
![Orders page — order history and status](screenshots/Orders_page.png)
*Customer order history showing product, price, quantity, total, and shipment status.*

### 📊 Admin Dashboard
![Admin dashboard — statistics and management overview](screenshots/Admin_dashboard.png)
*Admin dashboard with total users, products, and orders, plus quick actions.*


---

## 🎯 Results

ShopSphere delivers a working, end-to-end e-commerce flow — from product discovery to order placement and invoicing — with a separate, secure admin panel for full catalog and order management, all built on a lightweight PHP + MySQL stack without any external frameworks.

---

## 🔮 Future Improvements

- [ ] Razorpay payment gateway integration
- [ ] Email notifications
- [ ] Forgot password functionality
- [ ] PDF invoice download
- [ ] Sales analytics dashboard
- [ ] Product recommendations
- [ ] Live deployment

---

## 📚 Learning Outcomes

This project was a hands-on deep dive into:

- PHP CRUD operations
- MySQL database design
- Authentication & session management
- Password hashing
- SQL JOIN queries
- File uploads
- Shopping cart logic
- Order management workflows
- Responsive web design
- Git & GitHub version control

---

## 👨‍💻 Contributors

**Sharan Yadav**
B.Tech, Computer Science Engineering

- GitHub: _(add your GitHub profile link)_
- LinkedIn: _(add your LinkedIn profile link)_

---

## 📄 License

This project is developed for **educational and placement purposes**.
