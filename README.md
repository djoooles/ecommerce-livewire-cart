# 🛒 E-commerce Shopping Cart

A complete e-commerce shopping cart system built with **Laravel**, **Livewire**, and **Tailwind CSS** as per the technical assessment requirements.

## 🚀 Live Demo
- **URL:** []
- **Admin Email:** admin@example.com
- **Admin Password:** password

## 📋 Requirements Checklist

| Requirement | Status | Implementation |
|------------|--------|----------------|
| Laravel starter kit (Livewire/React/Vue) | ✅ | Laravel Breeze with Livewire stack |
| User authentication | ✅ | Laravel Breeze built-in |
| Shopping cart associated with authenticated user | ✅ | Database storage (not session) |
| Low Stock Notification Job/Queue | ✅ | `LowStockNotification` job with email |
| Daily Sales Report scheduled task | ✅ | `DailySalesReport` command with cron |
| Tailwind CSS styling | ✅ | Full Tailwind implementation |
| Git/GitHub version control | ✅ | Clean commit history |

## 🏗️ Tech Stack

- **Backend:** Laravel 12, PHP 8.2
- **Frontend:** Livewire 3, Alpine.js, Tailwind CSS
- **Database:** SQLite (development), MySQL ready
- **Authentication:** Laravel Breeze
- **Queues:** Database queue driver
- **Scheduling:** Laravel Scheduler
- **Version Control:** Git/GitHub

## 📦 Installation

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- SQLite or MySQL

### Step-by-Step Setup

```bash
# 1. Clone repository
git clone https://github.com/djordjestojkovic/ecommerce-livewire-cart.git
cd ecommerce-livewire-cart

# 2. Install PHP dependencies
composer install

# 3. Install JavaScript dependencies
npm install

# 4. Setup environment
cp .env.example .env
php artisan key:generate

# 5. Setup database (SQLite)
touch database/database.sqlite

# 6. Run migrations and seeders
php artisan migrate --seed

# 7. Build assets
npm run build
