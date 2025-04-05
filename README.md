# Laravel Products REST API

A simple Laravel-based RESTful API for managing a collection of products.  
Implements full CRUD with modern PHP 8.2+ features, DTOs, repository pattern, and PostgreSQL.

---

## 🚀 Features

- ✅ REST API (CRUD) for products
- 📦 Data structure using UUID, JSONB, timestamps
- 🔒 PHP 8 Attributes for DTO validation (optional)
- 🧱 Repository Pattern + DTO
- 🧪 PHPUnit tests: unit & integration
- 🐘 PostgreSQL + Docker setup
- 🧰 PSR-4 autoloading & clean architecture

---

## ⚙️ Tech Stack

- **PHP 8.2+**
- **Laravel 12.x**
- **PostgreSQL**
- **Docker (optional)**
- **PHPUnit**

---

## 📦 Installation

```bash
git clone 
cd laravel-api

composer install
cp .env.example .env
php artisan key:generate

---

## 🐳 Docker Setup (Recommended)

This project includes a `Dockerfile` and `docker-compose.yml` for quick startup.

### ▶️ Run the app and PostgreSQL with one command:

```bash
docker-compose up 

for migrations -> docker-compose exec app php artisan migrate
