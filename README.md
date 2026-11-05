# ♻️ EcoRecycle - Scrap Management & Recycling Web Application

[![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5%20%26%203-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Razorpay](https://img.shields.io/badge/Razorpay-Payment%20Gateway-02042B?style=for-the-badge&logo=razorpay&logoColor=3399CC)](https://razorpay.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

An end-to-end **Scrap Collection, Recycling, and Finished Product E-Commerce Platform** built with PHP and MySQL. The system bridges the gap between scrap sellers, recycling administrators, and buyers of processed recycled materials, promoting sustainable circular economies and responsible waste management.

---

## 📌 Table of Contents

- [Project Overview](#-project-overview)
- [Key Features by Role](#-key-features-by-role)
  - [1. Scrap Seller Module](#1-scrap-seller-module)
  - [2. Recycled Product Buyer Module](#2-recycled-product-buyer-module)
  - [3. Admin Dashboard & Operations](#3-admin-dashboard--operations)
- [Technology Stack](#-technology-stack)
- [Future Enhancements & Best Practices](#-future-enhancements--best-practices)

---

## 📖 Project Overview

Rapid industrialization and consumer waste pose severe environmental challenges. **EcoRecycle** streamlines the scrap recycling pipeline through a unified web interface:

1. **Sellers** can sell different kinds of scrap materials (Plastic, Metal, E-waste, Cables, Construction scrap, Office paper) at transparent slab rates.
2. **Administrators** track incoming scrap supplies, manage user accounts, trigger recycling transformations with automated conversion formulas, and oversee finances.
3. **Buyers** can browse processed, eco-friendly inventory (such as recycled plastic bottles, metal rods, circuit boards, bricks), purchase items online via **Razorpay**, and automatically receive downloadable **PDF receipts/invoices** generated on the fly.


## ✨ Key Features by Role

### 1. Scrap Seller Module
- **Role-Based Authentication**: Secure login and registration tailored specifically for sellers.
- **Categorized Scrap Submission**: Dedicated portals with dynamic pricing slabs for:
  - 🖥️ **E-Scrap**: Obsolete electronic equipment, motherboards, circuit assemblies.
  - 🔩 **Metal**: Ferrous and non-ferrous discarded metals.
  - 🍶 **Plastic**: Bottles, containers, packaging polymers.
  - 🔌 **Cables**: Wires and electrical conduits.
  - 🧱 **Construction**: Concrete and masonry debris.
  - 📄 **Office Waste**: Bulk papers, cardboard, and files.
- **Pricing Calculation**: Automatically calculates quotation based on weight brackets (e.g. 100–199 kg, 200–299 kg, 300–450 kg).
- **Profile Management**: Update email, username, and change security credentials with old-password verification.
- **Feedback & Rating**: Modal feedback submission with ratings (`Very Good`, `Good`, `Mediocre`, `Bad`, `Very Bad`).

### 2. Recycled Product Buyer Module
- **Live Recycled Inventory**: View processed, ready-to-use materials with real-time stock balance.
- **Dynamic Price Evaluation**: Real-time quantity selector that updates total payable amount dynamically using JavaScript.
- **Razorpay Payment Gateway**: Seamless and secure digital checkout (`checkout.js`) supporting Card, UPI, Netbanking, and Wallets.
- **Automated Instant PDF Invoice**: Instant receipt generated via `jsPDF` after payment confirmation with date, payment ID, purchased quantity, and breakdown.
- **Inventory Safeguard**: Checks stock before initiating payment to prevent overselling.

### 3. Admin Dashboard & Operations
- **Interactive KPI Cards**: Real-time summary statistics:
  - 💰 **Total Profit (Revenue)** from buyer sales.
  - ♻️ **Total Recycled Waste** processed (kg).
  - 👥 **Total Registered Users** count.
  - 💵 **Total Scrap Payments** committed to sellers.
- **Visual Analytics**: Interactive bar chart powered by **Chart.js** comparing buyer revenue against seller scrap procurement costs.
- **Recycling Conversion Engine**: Translates raw scrap weight into manufactured eco-products:
  - `Plastic`: 1 kg ➔ 5 Recycled Bottles
  - `Metal`: 1 kg ➔ 3 Metal Rods
  - `Cable`: 1 kg ➔ 2 Meters of Wire
  - `E-scrap`: 1 kg ➔ 1 Recycled Circuit Board
  - `Construction`: 1 kg ➔ 4 Bricks
  - `Office Paper`: 1 kg ➔ 20 Recycled Paper Sheets
- **Seller Payment Tracker**: Mark seller payouts as `Paid` upon delivery verification.
- **User Administration**: View and remove registered user accounts.
- **Feedback Review**: Inspect submitted user reviews and ratings.

---

## 💻 Technology Stack

| Layer | Technologies Used |
| :--- | :--- |
| **Backend** | PHP 7.4 / 8.0+ |
| **Database** | MySQL / MariaDB (via phpMyAdmin) |
| **Frontend** | HTML5, CSS3, JavaScript (ES6+), jQuery 3.6 |
| **CSS Framework** | Bootstrap 5.3 & Bootstrap 3.4 (Hybrid styling) |
| **Data Visualization** | Chart.js |
| **Payment Gateway** | Razorpay Checkout API |
| **Document Export** | jsPDF (Client-side PDF generation) |
| **Icons & Fonts** | Font Awesome 4.7 / 5.x |
| **Server Environment** | WampServer / XAMPP / LAMP / Docker |



## 🛡️ Future Enhancements & Best Practices

- [ ] **Password Security**: Upgrade plain-text passwords to secure hashes using `password_hash()` and `password_verify()`.
- [ ] **Prepared Statements**: Standardize parameterized queries across all legacy queries to prevent SQL Injection vulnerabilities.
- [ ] **Centralized DB Connection**: Consolidate database credentials into a single `config/db.php` file included across scripts.
- [ ] **Environment Variables**: Store sensitive third-party credentials (like Razorpay Key ID and Secret) in a `.env` file outside version control.
- [ ] **Responsive Navigation**: Merge Bootstrap 3 and Bootstrap 5 dependencies to a single unified modern framework for improved mobile responsiveness.
- [ ] **Order Tracking & Notifications**: Integrate automated SMS / Email notifications for pickup dates and shipping confirmations.

