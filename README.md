# 🛒 Online Shop Project (SQL + PHP)

This project is a simple **online shop system** built using **PHP and MySQL**.  
It allows users to browse products, and administrators to manage products (add, edit, delete).

---

## 📌 Features

### 👤 User Side
- View product list
- Browse product details

### 🔐 Admin Side
- Add new products
- Edit existing products
- Delete products
- View statistics

---

## 🧩 Project Structure


shop-project/
│
├── index.php # Homepage
├── products.php # Display all products
├── add_product.php # Add new product
├── edit_product.php # Edit product
├── delete_product.php # Delete product
├── login.php # Login page
├── logout.php # Logout
├── statistics.php # Statistics page
├── db.php # Database connection
├── init.sql # Database initialization
└── README.md


---

## ⚙️ Technologies Used

- PHP
- MySQL
- HTML / CSS
- (Optional) MAMP / XAMPP for local server

---

## 🚀 How to Run the Project

### 1. Clone the repository

```bash
git clone https://github.com/your-username/shop-project.git
2. Start local server
Use MAMP / XAMPP
Put project in htdocs folder
3. Import database
Open phpMyAdmin
Create a database (e.g. shop)
Import init.sql
4. Configure database connection

Edit db.php:

$host = "localhost";
$dbname = "shop";
$username = "root";
$password = "root"; // or your password
5. Open in browser
http://localhost:8888/shop-project/index.php
🧪 Example Pages
Homepage: /index.php
Products: /products.php
Admin Add Product: /add_product.php
💡 Challenges Faced
Handling form data with PHP
Connecting PHP with MySQL
Debugging SQL and syntax errors
Managing page navigation (add/edit logic)
🔧 Future Improvements
Add shopping cart functionality 🛒
User registration system
Better UI design (CSS framework)
Product categories filter
Responsive design for mobile