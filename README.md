# Tes Inagata - Blog API (Laravel + JWT)

Project ini merupakan implementasi REST API Blog menggunakan Laravel dengan autentikasi JWT sesuai dengan spesifikasi tes teknis.

---

## 🚀 Tech Stack

- PHP 8+
- Laravel 10
- MySQL
- JWT Authentication (tymon/jwt-auth)
- Postman (API Testing)

---

## ⚙️ Cara Menjalankan Project

### 1️⃣ Clone Repository

```bash
git clone https://github.com/saifullahisnanramadhani/tes-inagata.git
cd tes-inagata
```

---

### 2️⃣ Install Dependencies

```bash
composer install
```

---

### 3️⃣ Copy File Environment

```bash
cp .env.example .env
```

Lalu atur konfigurasi database di file `.env`:

```
DB_DATABASE=blog_magang
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

### 5️⃣ Generate JWT Secret

```bash
php artisan jwt:secret
```

---

### 6️⃣ Jalankan Migration

```bash
php artisan migrate
```

---

### 7️⃣ Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di:
```
http://127.0.0.1:8000
```

---

# 🔐 Autentikasi

API menggunakan JWT Authentication.

Setelah login, gunakan token pada header:

```
Authorization: Bearer {token}
```

---

# 👤 Role & Authorization

| Role  | Akses |
|-------|-------|
| Public | Melihat artikel & kategori |
| User | Login & Logout |
| Admin | CRUD Artikel & Kategori |

- Logout dapat dilakukan oleh semua user yang sudah login.
- Create, Update, Delete artikel hanya dapat dilakukan oleh Admin.

---

# 📌 Endpoint API

## 🔑 Auth

| Method | Endpoint | Keterangan |
|--------|----------|------------|
| POST | /api/register | Register user |
| POST | /api/login | Login dan mendapatkan JWT |
| POST | /api/logout | Logout user (auth required) |

---

## 📂 Categories

| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | /api/categories | List kategori |
| POST | /api/categories | Tambah kategori (Admin Only) |

---

## 📝 Articles

| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | /api/articles | List artikel (pagination) |
| GET | /api/articles/{id} | Detail artikel |
| POST | /api/articles | Tambah artikel (Admin Only) |
| PUT | /api/articles/{id} | Update artikel (Admin Only) |
| DELETE | /api/articles/{id} | Hapus artikel (Admin Only) |
| GET | /api/articles/search | Filter pencarian |

---

# 🔎 Filter Pencarian

Endpoint:
```
GET /api/articles/search
```

Query Parameter yang tersedia:

- `category_id`
- `keyword` (judul artikel)
- `content` (isi artikel)
- `date` (YYYY-MM-DD)
- `start_date`
- `end_date`

Contoh penggunaan:

```
/api/articles/search?keyword=laravel
/api/articles/search?category_id=1
/api/articles/search?date=2026-03-02
/api/articles/search?start_date=2026-03-01&end_date=2026-03-05
```

---

# ✅ Validasi Input

- Title wajib diisi
- Content wajib diisi
- Category harus valid (exists di database)

Jika validasi gagal, API akan mengembalikan status `422 Unprocessable Entity`.

---

# 📦 Dokumentasi API

Dokumentasi API tersedia dalam bentuk Postman Collection yang terdapat di repository ini.

File:
```
Blog-API-Postman-Collection.json
```

---

# 🎥 Video Demo

Link Video Demo:
(isi link Google Drive / YouTube di sini)

---

# 👤 Author

Nama: Saifullah Isnan Ramadhani 
Project: Tes Backend API Inagata  
Repository: https://github.com/saifullahisnanramadhani/tes-inagata
