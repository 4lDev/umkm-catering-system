<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Full-Stack Catering Management System for MSMEs: The "Anti-Ribet" Solution



This portfolio project serves as a proof-of-concept for my **Unique Value Proposition (UVP): Building secure, modern, and highly efficient digital assets** for the growing Food & Beverage (F&B) MSME (Micro, Small, and Medium Enterprises) segment in Indonesia.

This system directly addresses the pain points of manual order processing by transforming chaotic WhatsApp/chat orders into a centralized, manageable digital system.

## Business Focus & Value Proposition (UVP)

This project solves the key problems faced by MSME Catering businesses (e.g., the 'Ibu Kos' scenario):

| Major Pain Point | Solution Provided | Business Value (Your UVP) |
| :--- | :--- | :--- |
| **Manual WhatsApp Dependency** | **24/7 Online Ordering:** Customers place orders directly via the web at any time. | **Modern:** Increases conversion rates and improves customer experience. |
| **Risk of Data Loss/Errors** | **Centralized Management System (Admin Panel):** All order data (items, price, customer info) is automatically logged in a secure database. | **Anti-Ribet (Hassle-Free):** Eliminates human error and saves up to **5 hours of manual recap time** daily. |
| **Payment Confirmation Risk** | **Structured Checkout Flow:** Ready for integration with Payment Gateways for instant, verified payment confirmation. | **Secure:** Eliminates the risk of fake proof-of-payment screenshots. |
| **Unclear Order Status** | **Order Status Update Feature (Pending, Processing, Complete).** | Operational efficiency and clear order tracking for the kitchen team. |

---

## Key Technical Features (Full-Stack)

### **Frontend (Customer View)**
* **Homepage & Menu:** Displays available menus dynamically, pulled from the database.
* **Shopping Cart & Checkout:** Uses Laravel Sessions for cart management leading to the final customer data entry.
* **Confirmation Flow:** Order success page with a clear Order Number.

### **Backend (Admin Panel for Management)**
* **Secure Authentication:** Admin login and register system (Laravel Breeze).
* **Menu Management (CRUD):** Admin can Create, Read, Update, and Delete menus, prices, and availability.
* **Order Management:**
    * **Order List:** Displays incoming orders in real-time.
    * **Order Detail View:** Provides itemized order breakdown, total cost, and customer contact/address details.
    * **Status Update:** Features a dedicated form to change order status (`pending`, `processing`, `completed`) using a secure `PATCH` request.

### **Technology Stack**
* **Core Framework:** **Laravel v12**
* **Frontend Styling:** **Tailwind CSS** & **Blade** (Minimal JavaScript)
* **Templating:** Laravel Breeze
* **Database:** **SQLite** (Used for portable demo deployment)

---

## Live Access & Installation

### 1. Access the Admin Panel (Post-Installation)

* **Admin Access:** Navigate to `/register` to create the first administrator account, then log in.
* **Start Here:** After logging in, use the "Manajemen Menu" link to add your first menu items. Orders placed via the homepage will appear under "Manajemen Pesanan."

### 2. Local Installation Guide

To run this project on your local machine:

```bash
# 1. Clone the Repository
git clone https://github.com/4lDev/umkm-catering-system.git
cd your-project-folder

# 2. Install Dependencies
composer install
npm install

# 3. Configuration
cp .env.example .env
php artisan key:generate
# Ensure DB_CONNECTION=sqlite in your .env file

# 4. Database Setup
touch database/database.sqlite
php artisan migrate

# 5. Run Servers
php artisan serve   # (For Backend API/Logic)
npm run dev         # (For Frontend Styling/Vite)/licenses/MIT).
