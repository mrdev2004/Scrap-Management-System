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
- [System Architecture & Workflow](#-system-architecture--workflow)
- [Key Features by Role](#-key-features-by-role)
  - [1. Scrap Seller Module](#1-scrap-seller-module)
  - [2. Recycled Product Buyer Module](#2-recycled-product-buyer-module)
  - [3. Admin Dashboard & Operations](#3-admin-dashboard--operations)
- [Technology Stack](#-technology-stack)
- [Database Schema & Architecture](#-database-schema--architecture)
- [Project Directory Structure](#-project-directory-structure)
- [Installation & Local Setup](#-installation--local-setup)
- [Default Demo Credentials](#-default-demo-credentials)
- [How to Upload This Project to GitHub](#-how-to-upload-this-project-to-github)
- [Future Enhancements & Best Practices](#-future-enhancements--best-practices)

---

## 📖 Project Overview

Rapid industrialization and consumer waste pose severe environmental challenges. **EcoRecycle** streamlines the scrap recycling pipeline through a unified web interface:

1. **Sellers** can sell different kinds of scrap materials (Plastic, Metal, E-waste, Cables, Construction scrap, Office paper) at transparent slab rates.
2. **Administrators** track incoming scrap supplies, manage user accounts, trigger recycling transformations with automated conversion formulas, and oversee finances.
3. **Buyers** can browse processed, eco-friendly inventory (such as recycled plastic bottles, metal rods, circuit boards, bricks), purchase items online via **Razorpay**, and automatically receive downloadable **PDF receipts/invoices** generated on the fly.

---

## 🔄 System Architecture & Workflow

```mermaid
flowchart TD
    subgraph Users ["Users (Public / Registered)"]
        S[Seller]
        B[Buyer]
        A[Admin]
    end

    subgraph Platform ["EcoRecycle Web Application"]
        Auth[Authentication & Role Routing\n(register.php / login.php)]
        
        subgraph SellerFlow ["Seller Workflow"]
            S_Cat[Scrap Categories Catalog\n(services.php)]
            S_Sell[Sell Inquiry & Weight Calculator\n(plastic.php, metal.php, E-scrap.php, etc.)]
            S_PayReq[Scrap Payment Request Recorded\n(scrap_payments table)]
        end

        subgraph AdminFlow ["Admin Operations"]
            A_Dash[Analytics Dashboard & Chart.js\n(adminhome.php)]
            A_Recycle[Recycle Scrap Processor\n(add_re.php)]
            A_Users[Manage Users & Feedback\n(deletereg.php, adminfeedback.php)]
            A_PayStatus[Seller Payment Settlement\n(pay.php)]
        end

        subgraph BuyerFlow ["Buyer Workflow"]
            B_Catalog[Recycled Products Store\n(show_recycled_data_buyer.php)]
            B_Pay[Razorpay Payment Integration]
            B_Invoice[jsPDF Invoice Generator]
            B_InvUpdate[Inventory Deduction & Sales Record\n(buyer_payments table)]
        end
    end

    subgraph DB [("MySQL Database: 'project'")]
        T_Reg[register]
        T_ScrapPay[scrap_payments]
        T_Recycled[recycled_scrap]
        T_BuyerPay[buyer_payments]
        T_Admin[admin]
        T_Feedback[feedback]
    end

    S --> Auth --> S_Cat --> S_Sell --> S_PayReq --> T_ScrapPay
    A --> A_Dash
    T_ScrapPay --> A_Recycle --> T_Recycled
    A_Dash --> A_Users --> T_Reg
    A_Dash --> A_PayStatus --> T_ScrapPay
    B --> Auth --> B_Catalog
    T_Recycled --> B_Catalog --> B_Pay --> B_Invoice
    B_Pay --> B_InvUpdate --> T_BuyerPay
```

---

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

---

## 🗄️ Database Schema & Architecture

The system uses a relational MySQL database named `project` containing 6 core tables:

```
project/
├── admin               # Stores administrative login credentials
├── register            # Stores registered user accounts (role: Buyer / Seller)
├── scrap_payments      # Seller scrap submissions, pickup address, weight & cost
├── recycled_scrap      # Processed inventory available for sale to buyers
├── buyer_payments      # Buyer transaction log with Razorpay payment IDs
└── feedback            # User reviews, satisfaction ratings, and messages
```

### Table Definitions

1. **`admin`**: Stores system administrator credentials (`username`, `password`).
2. **`register`**: Contains user credentials (`username`, `email`, `password`, `user_type` [Buyer, Seller]).
3. **`scrap_payments`**: Stores sell requests from users with `scrap_type`, `weight`, `amount`, contact information, and payment status.
4. **`recycled_scrap`**: Holds processed inventory ready for retail with `scrap_type`, `weight`, `recycled_output`, and `image`.
5. **`buyer_payments`**: Tracks completed orders with `scrap_type`, `recycled_output`, `quantity`, `total_price`, and `payment_id`.
6. **`feedback`**: Records user satisfaction ratings and comments linked to user identity.

---

## 📁 Project Directory Structure

```
scrap2/
│
├── Php project/
│   ├── project.sql                  # Complete MySQL database export
│   │
│   ├── admin.php                    # Admin login portal
│   ├── adminhome.php                # Admin dashboard with Chart.js & metrics
│   ├── adminheader.php              # Navigation header for admin
│   ├── adminfeedback.php            # View user feedback
│   ├── admindltpay.php              # Admin payment record deletion
│   ├── add_re.php                   # Recycling conversion interface
│   ├── show_recycled_data.php       # Admin inventory view
│   ├── pay.php                      # Admin view & settle seller payments
│   ├── deletereg.php                # Manage and delete registered users
│   │
│   ├── login.php                    # Multi-role user login (Buyer / Seller)
│   ├── register.php                 # User registration form
│   │
│   ├── seller_homepage.php          # Seller dashboard & welcome screen
│   ├── header_seller.php            # Seller navigation bar & feedback modal
│   ├── services.php                 # Scrap categories overview
│   ├── plastic.php                  # Plastic sell calculator & form
│   ├── metal.php                    # Metal sell calculator & form
│   ├── E-scrap.php                  # E-scrap sell calculator & form
│   ├── cable.php                    # Cable scrap sell calculator & form
│   ├── construction.php             # Construction waste sell calculator & form
│   ├── office.php                   # Office scrap sell calculator & form
│   ├── manage_profile_seller.php    # Seller account management
│   ├── seller_aboutus.php           # About Us page for sellers
│   ├── seller_contactus.php         # Contact information for sellers
│   │
│   ├── buyer_homepage.php           # Buyer landing screen
│   ├── header_buyer.php             # Buyer navigation bar & feedback modal
│   ├── show_recycled_data_buyer.php # Product catalog with Razorpay & PDF bill
│   ├── manage_profile_buyer.php     # Buyer account management
│   ├── buyer_aboutus.php            # About Us page for buyers
│   ├── buyer_contactus.php          # Contact information for buyers
│   │
│   ├── footer.php                   # Global footer template
│   ├── uploads/                     # Uploaded documents and product images
│   └── *.jpg / *.png / *.webp       # Category banners and system images
│
├── .gitignore                       # Ignored files for version control
└── README.md                        # Project documentation
```

---

## 🚀 Installation & Local Setup

Follow these steps to run the project locally on your machine using **WampServer** or **XAMPP**:

### Prerequisites
- [WampServer](https://www.wampserver.com/) or [XAMPP](https://www.apachefriends.org/) (with PHP 7.4 or PHP 8.x and MySQL / MariaDB).
- A web browser (Google Chrome, Microsoft Edge, Mozilla Firefox).

### Step 1: Copy Files to Web Root
- **For WAMP**: Place the project folder in `C:\wamp64\www\`
  ```
  C:\wamp64\www\scrap2\
  ```
- **For XAMPP**: Place the project folder in `C:\xampp\htdocs\`
  ```
  C:\xampp\htdocs\scrap2\
  ```

### Step 2: Start Apache and MySQL
- Launch **WampServer** (ensure the tray icon is green) or open **XAMPP Control Panel** and click **Start** next to Apache and MySQL.

### Step 3: Import the Database
1. Open your browser and navigate to [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Click **New** on the left sidebar to create a new database.
3. Set the database name to:
   ```sql
   project
   ```
   *(Collation: `utf8mb4_general_ci`)*.
4. Click on the newly created `project` database.
5. Go to the **Import** tab at the top.
6. Click **Choose File** and select `project.sql` located at:
   `scrap2/Php project/project.sql`
7. Scroll down and click **Import**.

### Step 4: Configure Database Connection (if needed)
The application connects via `mysqli_connect("localhost", "root", "", "project")`.
If your MySQL password is not blank, edit the connection line in the PHP files accordingly:
```php
$con = mysqli_connect("localhost", "your_mysql_username", "your_mysql_password", "project");
```

### Step 5: Launch the Application
Open your web browser and navigate to:
- **User Login (Buyer/Seller)**: [http://localhost/scrap2/Php%20project/login.php](http://localhost/scrap2/Php%20project/login.php)
- **Admin Login**: [http://localhost/scrap2/Php%20project/admin.php](http://localhost/scrap2/Php%20project/admin.php)

---

## 🔑 Default Demo Credentials

### 1. Admin Portal
- **URL**: `http://localhost/scrap2/Php%20project/admin.php`
- **Username**: `iamadmin`
- **Password**: `admin1234`

### 2. Sample Seller Account
- **Email**: `renny11@gmail.com`
- **Password**: `renny123`
- **Role**: `Seller`

### 3. Sample Buyer Account
- **Email**: `nikita@gmail.com`
- **Password**: `456325`
- **Role**: `Buyer`

*(You can also create new buyer and seller accounts anytime via `register.php`)*.

---

## 📤 How to Upload This Project to GitHub

Follow one of the methods below to publish this project to your GitHub account:

### Method 1: Using Git Command Line (Recommended)

1. **Install Git** (if not already installed) from [git-scm.com](https://git-scm.com/).
2. Open **Terminal** / **PowerShell** and navigate to your project directory:
   ```bash
   cd "C:\wamp64\www\renny project\scrap2 (2)"
   ```
3. Initialize the Git repository:
   ```bash
   git init
   ```
4. Stage all files for commit:
   ```bash
   git add .
   ```
5. Create your initial commit:
   ```bash
   git commit -m "Initial commit: Scrap Management & Recycling Web Application"
   ```
6. Rename the default branch to `main`:
   ```bash
   git branch -M main
   ```
7. Create a new repository on [GitHub](https://github.com/new) (e.g. `scrap-management-system`). **Do not** check "Initialize with README".
8. Link your local repository to GitHub:
   ```bash
   git remote add origin https://github.com/<YOUR-USERNAME>/<YOUR-REPOSITORY-NAME>.git
   ```
9. Push your code to GitHub:
   ```bash
   git push -u origin main
   ```

---

### Method 2: Using GitHub Desktop (Graphical Interface)

1. Download and install [GitHub Desktop](https://desktop.github.com/).
2. Log in with your GitHub account.
3. Click **File** ➔ **Add Local Repository...**
4. Choose the path: `C:\wamp64\www\renny project\scrap2 (2)`
5. If it says *"This directory does not appear to be a Git repository"*, click **Create a repository here**.
6. Type a repository name (e.g., `scrap-management-system`), select your `.gitignore` preference, and click **Create Repository**.
7. Write a summary (e.g. `Initial commit`) and click **Commit to main**.
8. Click **Publish repository** to push it directly to your GitHub profile.

---

### Method 3: Upload Directly via GitHub Website

1. Go to [GitHub](https://github.com/) and click **New Repository**.
2. Give it a name (e.g., `scrap-management-system`) and click **Create repository**.
3. On the repository page, click the **uploading an existing file** link.
4. Drag and drop your project files and folders into the browser.
5. Add a commit message like `Add project files and README` and click **Commit changes**.

---

## 🛡️ Future Enhancements & Best Practices

- [ ] **Password Security**: Upgrade plain-text passwords to secure hashes using `password_hash()` and `password_verify()`.
- [ ] **Prepared Statements**: Standardize parameterized queries across all legacy queries to prevent SQL Injection vulnerabilities.
- [ ] **Centralized DB Connection**: Consolidate database credentials into a single `config/db.php` file included across scripts.
- [ ] **Environment Variables**: Store sensitive third-party credentials (like Razorpay Key ID and Secret) in a `.env` file outside version control.
- [ ] **Responsive Navigation**: Merge Bootstrap 3 and Bootstrap 5 dependencies to a single unified modern framework for improved mobile responsiveness.
- [ ] **Order Tracking & Notifications**: Integrate automated SMS / Email notifications for pickup dates and shipping confirmations.

---

## 📄 License

This project is licensed under the [MIT License](LICENSE) - feel free to use, modify, and distribute it for academic and commercial purposes.

---

### 👨‍💻 Author & Contributions
Built as an academic and practical initiative for environmental sustainability and digital waste management. Contributions, issues, and feature requests are welcome!
