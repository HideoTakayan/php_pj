# Project Workflow & Documentation

## 1. Project Overview
**Tech Stack:**
- **Backend:** Laravel 10 (PHP 8.1+)
- **Frontend:** Vite + Bootstrap 5 + Sass
- **Database:** MySQL

## 2. Setup & Installation
Follow these steps to set up the project locally:

1.  **Clone/Download Project** to your local machine.
2.  **Install Dependencies**:
    ```bash
    composer install
    npm install
    ```
3.  **Environment Configuration**:
    - Copy `.env.example` to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Update your database credentials in `.env` (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
4.  **Generate Key**:
    ```bash
    php artisan key:generate
    ```
5.  **Database Migration & Seeding**:
    - Create tables and insert sample data (Users, Products, etc.):
      ```bash
      php artisan migrate --seed
      ```
6.  **Run Application**:
    - Open two terminal tabs:
      - Term 1 (Frontend): `npm run dev`
      - Term 2 (Backend): `php artisan serve`
    - Access via: `http://localhost:8000`

## 3. Account Credentials (Default Seeding)
The `db:seed` command creates the following default accounts:

| Role  | Email | Password | Phone |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@example.com` | `123456` | `0123456789` |
| **User** | `user@example.com` | `123456` | `0987654321` |

## 4. Operational Workflows

### A. Customer Journey (End-User)
1.  **Browse Products**:
    - Visit Home Page (`/`) to see featured items and posts.
    - Visit **Shop** (`/shop`) to view all products.
    - Filter by Categories (e.g., Men's, Women's, Accessories).
2.  **Product Details**:
    - Click on any product to view details, description, and images.
3.  **Shopping Cart**:
    - Click **"Add to Cart"** on a product.
    - View Cart (`/list-cart`) to adjust quantities or remove items.
4.  **Checkout & Orders**:
    - Proceed to Checkout (Authentication required).
    - Fill in shipping address.
    - Confirm Order.
    - View Order History at **My Orders** (`/don-hang`).
5.  **User Dashboard**:
    - Manage Profile and Address Book at `/account-dashboard`.

### B. Admin Management
Access the Admin Panel at `/admin` (Log in with Admin credentials).

1.  **Dashboard Overview**: View key metrics (if implemented).
2.  **Manage Catalog**:
    - **Categories** (`/admin/danh_mucs`): Create, Edit, Delete product categories.
    - **Products** (`/admin/san_phams`): Add new products, update prices, stock, and descriptions.
3.  **Manage Content**:
    - **Posts** (`/admin/bai_viets`): Create and manage blog posts/news.

## 5. Directory Structure Key Points
- **Routes**: `routes/web.php` handles all web requests.
- **Controllers**:
    - `App\Http\Controllers\Admin`: Admin logic (Products, Categories, Posts).
    - `App\Http\Controllers\User`: User logic (Cart, Orders, Profile).
    - `App\Http\Controllers\ShopController`: Public facing product browsing.
- **Views**: `resources/views` contains all Blade templates.

## 6. Current Limitations / Notes
- **Admin Order Management**: Currently, there is explicit routing for Admin to manage Catalog and Content, but dedicated Admin Order Management routes (`admin/orders`) are not explicitly defined in `web.php` (Orders are primarily visible to Users).
